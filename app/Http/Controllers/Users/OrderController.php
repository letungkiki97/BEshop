<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\UserController;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Currency;
use App\Models\Supplier;
use App\Models\MovementType;
use App\Models\StockMovement;
use Yajra\Datatables\Datatables;
use Efriandika\LaravelSettings\Facades\Settings;
use Carbon\Carbon;
use Excel;
use DB;

class OrderController extends UserController
{
    protected $max;

    public function __construct()
    {
        // $this->middleware('authorized:purchase.list', ['only' => ['index']]);
        $this->middleware('authorized:order.add', ['only' => ['create']]);
        // $this->middleware('authorized:purchase.edit', ['only' => ['edit']]);

        parent::__construct();

        view()->share('type', 'order');
        view()->share('date', date(Settings::get('date_format'), time()));
    }

    public function index(Request $request)
    {
        switch ($request->status) {
            case 'Draft':
                $status = 'draft';
                break;
                
            case 'Active':
                $status = 'active';
                break;

            case 'Received':
                $status = 'received';
                break;

            case 'Paid':
                $status = 'paid';
                break;

            case 'Cancelled':
                $status = 'cancelled';
                break;
            
            default:
                $status = 'all';
                break;
        }
        if($request->status) {
            if(!$this->user->hasAccess(['purchase.'.$status]) && !$this->user->inRole('admin')) {
                return redirect('/')->withErrors(['message' => __('message.not_authorized')]);
            }
        } else {
            if(!$this->user->hasAccess(['purchase.list']) && !$this->user->inRole('admin')) {
                return redirect('/')->withErrors(['message' => __('message.not_authorized')]);
            }
        }
        $length = $request->length ?: 50;
        $order = Order::orderBy('order_date', 'desc');
        // if ($request->search) {
        //     if (strlen($request->search) == 10 && preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $request->search)) {
        //         $arraydate = @array_reverse(@explode("/", $request->search));
        //         $date = implode("-", $arraydate);
        //     }
        //     if (isset($date)) {
        //         $purchase = $purchase->whereDate('purchase_date', '=', $date)
        //             ->orWhereDate('receiving_date', '=', $date);
        //     } else {
        //         $purchase = $purchase->where(function ($item) use ($request) {
        //             $item->where('id', 'like', '%' . $request->search . '%')
        //                 ->orWhereHas('product', function ($q) use ($request) {
        //                     $q->where('product_sku', 'like', '%' . $request->search . '%')
        //                         ->orWhere('product_name', 'like', '%' . $request->search . '%');
        //                 })->orwhereHas('supplier', function ($q) use ($request) {
        //                     $q->where('name', 'like', '%' . $request->search . '%');
        //                 });
        //             $tien = str_replace(",", "", $request->search);
        //             if (is_numeric($tien)) {
        //                 $item->orWhere('nominate_price', 'like', '%' . $tien . '%')
        //                     ->orWhere('grand_total', 'like', '%' . $tien . '%');
        //             }
        //         });
        //     }

        // }
        if ($request->status) {
            $order = $order->where('status', $request->status);
        }
        $count = $order->count();
        $order = $order->paginate($length);
        $page_info = $this->pageInfo($request->page, $length, $count);
        $title = __('order.title');
        $request->session()->put('redirect_purchase', $request->fullUrl());
        $search_status = $request->status;
        return view('user.order.index', compact('title', 'order', 'page_info', 'search_status'));
    }

    public function create(Request $request)
    {
        $title = __('purchase.new');
        if ($request->quantity && $request->product) {
            $product = Product::find($request->product);
            $request->session()->flash('purchase_product', [
                'id' => $request->product,
                'img' => ($product->product_image && isset($product->image->name) && $product->image->name) ? asset('uploads/products') . '/thumb_' . $product->image->name : asset('img/no-img.png'),
                'name' => $product->product_sku . ' | ' . $product->product_name
            ]);
            $request->session()->flash('purchase_quantity', $request->quantity);
        }
        $this->generateParams();
        return view('user.purchase.create', compact('title'));
    }

    public function store(PurchaseRequest $request)
    {
        Purchase::create($request->all());

        return redirect("purchase");
    }

    public function show(Purchase $purchase)
    {
        
    }

    public function edit(Purchase $purchase, Request $request)
    {
        $tab = isset($request->tab) ? $request->tab : '';
        $title = __('purchase.edit') . ' (' . $purchase->id . ')';
        $this->generateParams();
        $stock_movement = $purchase->stock_movement;
        $max = $purchase->quantity - $purchase->getReceivedQuantity();
        $code = $purchase->currency->code;
        return view('user.purchase.edit', compact('title', 'purchase', 'stock_movement', 'tab', 'max', 'code'));
    }

    public function update(PurchaseRequest $request, Purchase $purchase)
    {
        $purchase->update($request->except('purchase_id'));
        return redirect($request->session()->get('redirect_purchase'));
    }
    
    public function destroy(Purchase $purchase)
    {
        $count = $purchase->stock_movement->count();
        if (!$count) {
            $purchase->delete();
            return 1;
        }
    }

    private function generateParams() {
        $purchase_status = [
            'Draft' => 'Draft',
            'Active' => 'Active', 
            'Received' => 'Received',
            'Paid' => 'Paid',
            'Cancelled' => 'Cancelled',
        ];
        $international_transport_rate_volume = Settings::get('international_transport_rate_volume');
        $international_transport_rate_kg = Settings::get('international_transport_rate_kg');
        $ordering_fee = Settings::get('ordering_fee') / 100;

        view()->share([
            'purchase_status' => $purchase_status,
            'international_transport_rate_volume' => $international_transport_rate_volume,
            'international_transport_rate_kg' => $international_transport_rate_kg,
            'ordering_fee' => $ordering_fee,
            'date' => date(Settings::get('date_format'), time())
        ]);
    }

    public function currency(Request $request) {
        return response()->json(Currency::find($request->id), 200);
    }

    public function move(Request $request) {
        Purchase::find($request->id)->update(['status' => $request->status]);
        return 1;
    }

    public function addStock(Request $request) {
        $purchase = Purchase::find($request->id);
        $movement_type = MovementType::where('name', $request->movement_type)->first();
        if (!$movement_type) {
            $movement_type = MovementType::create([
                'name' => $request->movement_type,
                'sign' => 1,
                'flag' => 0,
                'manual' => 0,
            ]);
        }
        $stock_movement = StockMovement::create([
            'manual' => 0,
            'date' => $request->date,
            'product_id' => $request->product_id,
            'type' => $movement_type->id,
            'storage_id' => $request->storage_id,
            'quantity' => $request->quantity,
            'reference' => $request->reference,
            'purchase_id' => $request->id,
            'performed_by' => $this->user->id
        ]);
        $purchase->status = 'Received';
        $purchase->save();
        return response()->json($stock_movement, 200);
    }

    public function import() {
        if (!$this->user->inRole('admin')) {
            return redirect('/')->withErrors(['message' => __('message.not_authorized')]);
        }
        $title = __('purchase.import');
        return view('user.purchase.import', compact('title'));
    }

    public function excelUpdate(Request $request) {
        $this->validate($request, [
            'import_file' => 'required|mimes:xlsx|max:'.Settings::get('max_upload_file_size'),
        ]);
        if($request->hasFile('import_file')){
            $result = [];
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
                $reader->formatDates(false);
                $reader->calculate();
            })->get();
            if(!empty($data) && $data->count()){
                $result = $data->map(function($item) {
                    $status = [];
                    $product = Product::where('product_sku', $item->product)->first();
                    $currency = Currency::find($item->currency_id);
                    if (!$product) {
                        $status[] = 'Cannot find product "' . $item->product . '"';
                    }
                    $supplier = Supplier::find($item->supplier_id);
                    if (!$supplier) {
                        $status[] = 'Cannot find supplier "' . $item->supplier_id . '"';
                    }
                    if (!$currency) {
                        if ($supplier) {
                            $currency = Currency::find($supplier->currency_id);
                        } else {
                            $status[] = 'Cannot find currency "' . $item->currency_id . '"';
                        }
                    }
                    if (!count($status)) {
                        $purchase_status = ['Draft', 'Active', 'Received', 'Paid', 'Cancelled'];
                        $item->quantity = $item->quantity ?: 1;
                        $exchange_rate = $currency->exchange_rate_value;
                        if (!$item->purchase_from) {
                            $price_per_order_unit = $item->item_price * $item->quantity;
                            $ordering_fee = $item->ordering_fee ?: $price_per_order_unit * (Settings::get('ordering_fee') / 100);
                            $internal_product_price = (($price_per_order_unit + $ordering_fee + $item->internal_transportation_fee) / $item->quantity) * $exchange_rate;
                            $total = ($price_per_order_unit + $ordering_fee + $item->internal_transportation_fee) * $exchange_rate;
                            $total_transport_rate = $item->international_transport_rate_kg * $item->box_weight;
                            $box1_volume = $item->box1_length * $item->box1_depth * $item->box1_height * $item->box1_quantity;
                            $box2_volume = $item->box2_length * $item->box2_depth * $item->box2_height * $item->box2_quantity;
                            $total_volume = $box1_volume + $box2_volume;
                            $volume = $total_volume * $item->international_transport_rate_volume;
                            $transportation_fee = $volume > $total_transport_rate ? $volume : $total_transport_rate;
                        } else {
                            $internal_product_price = $item->internal_product_price ?: 0;
                            $total = $internal_product_price * $item->quantity;
                            $transportation_fee = $item->transportation_fee ?: 0;
                        }
                        $grand_total = ($total + $transportation_fee) * (1 + ($item->vat/100)) * (1 - ($item->discount/100)) - $item->discount_amount;
                        $nominate_price = $grand_total / $item->quantity;
                        Purchase::create([
                            'product_id' => $product->id,
                            'supplier_id' => $item->supplier_id,
                            'currency_id' => $currency->id,
                            'exchange_rate' => $exchange_rate,
                            'purchase_from' => $item->purchase_from,
                            'purchase_date' => $item->date_purchase ? Carbon::createFromFormat('Y-m-d', $item->date_purchase)->format(Settings::get('date_format')) : Carbon::now()->format(Settings::get('date_format')),
                            'receiving_date' => $item->date_receiving ? Carbon::createFromFormat('Y-m-d', $item->date_receiving)->format(Settings::get('date_format')) : Carbon::now()->format(Settings::get('date_format')),
                            'status' => $item->status && in_array($item->status, $purchase_status) ? $item->status : 'Active',
                            'payment' => $item->payment ?: "",
                            'url' => $item->url ?: "",
                            'item_price' => $item->item_price ?: 0,
                            'quantity' => $item->quantity,
                            'price_per_order_unit' => isset($price_per_order_unit) ? $price_per_order_unit : 0,
                            'ordering_fee' => isset($ordering_fee) ? $ordering_fee : 0,
                            'internal_transportation_fee' => $item->internal_transportation_fee ?: 0,
                            'total' => $total,
                            'internal_product_price' => $internal_product_price,
                            'international_transport_rate_volume' => $item->international_transport_rate_volume ?: 0,
                            'international_transport_rate_kg' => $item->international_transport_rate_kg ?: 0,
                            'box_weight' => $item->box_weight ?: 0,
                            'total_transport_rate' => isset($total_transport_rate) ? $total_transport_rate : 0,
                            'box1_height' => $item->box1_height ?: 0,
                            'box1_depth' => $item->box1_depth ?: 0,
                            'box1_length' => $item->box1_length ?: 0,
                            'box1_volume' => isset($box1_volume) ? $box1_volume : 0,
                            'box1_quantity' => $item->box1_quantity ?: 0,
                            'box2_height' => $item->box2_height ?: 0,
                            'box2_depth' => $item->box2_depth ?: 0,
                            'box2_length' => $item->box2_length ?: 0,
                            'box2_quantity' => $item->box2_quantity ?: 0,
                            'box2_volume' => isset($box2_volume) ? $box2_volume : 0,
                            'total_volume' => isset($total_volume) ? $total_volume : 0,
                            'transportation_fee' => $transportation_fee,
                            'discount' => $item->discount ?: 0,
                            'discount_amount' => $item->discount_amount ?: 0,
                            'vat' => $item->vat ?: 0,
                            'grand_total' => $grand_total,
                            'nominate_price' => $nominate_price,
                            'handled_by' => $item->handled_by ?: "",
                            'assigned_to' => User::find($item->assigned_to) ? $item->assigned_to : null,
                            'note' => $item->note ?: "",
                        ]);
                        $item->grand_total = $grand_total;
                    } 
                    $item->status = $status;
                    return $item;
                });
            };
            return back()->with('purchase', $result);
        }
        return back();
    }
}

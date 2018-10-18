<?php
 
namespace App\Observers;
 
use App\Models\StockMovement;
use App\Models\StockReport;
use App\Helpers\WoocommerceApi;
use Efriandika\LaravelSettings\Facades\Settings;
 
class StockMovementObserver
{
    public function created(StockMovement $stock_movement)
    {
        if($stock_movement->production_id) {
            $order_id = $stock_movement->production->order_id;
        } else {
            $order_id = 0;
        }
    	$product = $stock_movement->product;
        // find the stock, if not create
        $stock_report = StockReport::where([
            'product_id' => $stock_movement->product_id,
            'storage_id' => $stock_movement->storage_id,
            'order_id' => $order_id,
        ])->get()->first();
        if (!$stock_report) {
            $stock_report = StockReport::create([
                'product_id' => $stock_movement->product_id,
                'storage_id' => $stock_movement->storage_id,
                'order_id' => $order_id,
                'quantity' => 0
            ]);
        }
        // get qty of product in all stocks
    	$quantity = StockReport::getQty($stock_movement->product_id, $order_id);
        $total = $product->total_value;
        // if movement is purchase, update unit value
        if($stock_movement->purchase_id) {
            $product->unit_value = ($product->unit_value * $quantity + $stock_movement->purchase->nominate_price * $stock_movement->quantity) / ($quantity + $stock_movement->quantity);
            $product->save();
        }
        // if movement is production, update unit value
        if($stock_movement->production_id) {
            $product->unit_value = ($product->unit_value * $quantity + $stock_movement->production->nominate_price * $stock_movement->quantity) / ($quantity + $stock_movement->quantity);
            $product->save();
            $stock_report->order_id = $stock_movement->production->order_id;
        }
        // check sign of movement then add or sub
        $stock_report->quantity += $stock_movement->movement_type->sign ? $stock_movement->quantity : -$stock_movement->quantity;
        $stock_report->save();
        // move stock if movement is move
        if ($stock_movement->to_storage) {
            $stock_report = StockReport::where([
                'product_id' => $stock_movement->product_id,
                'storage_id' => $stock_movement->to_storage,
                'order_id' => $order_id,
            ])->get()->first();
            if (!$stock_report) {
                $stock_report = StockReport::create([
                    'product_id' => $stock_movement->product_id,
                    'storage_id' => $stock_movement->to_storage,
                    'order_id' => $order_id,
                    'quantity' => 0,
                ]);
            }
            $stock_report->quantity += $stock_movement->quantity;
            $stock_report->save();
        }
        // update Wordpress price
        if (Settings::get('endpoint_url') && Settings::get('consumer_key') && Settings::get('consumer_secret')) {
            $client = WoocommerceApi::client(Settings::get('endpoint_url'), Settings::get('consumer_key'), Settings::get('consumer_secret'));
            $item = $client->products->get_by_sku($product->product_sku);
            if (isset($item->product)) {
                $newQty = 0;
                StockReport::where(['product_id' => $product->id])->whereHas('storage', function($q) {
                    $q->where('available', 1);
                })->get()->map(function($s) use (&$newQty) {
                    $newQty += $s->quantity;
                });
                $status = $product->status == 1;
                $client->products->update_stock($item->product->id, $newQty, $status);
            }
        }
        // get qty of product in all stocks after move
        $quantity = StockReport::getQty($stock_movement->product_id, $order_id);
        // get new total and unit value then save to product
        $newTotal = $quantity * $product->unit_value;
        $newTotal = $newTotal <= 0 ? 0 : $newTotal;
        if ($total != $newTotal) {
            $product->total_value = $newTotal;
            $product->save();
        }
        // save new unit value and total value of stock movement
        if($stock_movement->purchase_id) {
            $stock_movement->unit_value = $stock_movement->purchase->nominate_price;
        } elseif ($stock_movement->production_id) {
            $stock_movement->unit_value = $stock_movement->production->nominate_price;
        } else {
            $stock_movement->unit_value = $product->unit_value;
        }
        $stock_movement->total_value = $stock_movement->unit_value * $stock_movement->quantity;
        $stock_movement->save();
    }
}
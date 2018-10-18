<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Efriandika\LaravelSettings\Facades\Settings;

class Delivery extends Model
{
    use HistoryTrait;
    protected $guarded  = array('id');
    protected $table = 'deliveries';
    public $timestamps = false;

    public function date_format()
    {
        return Settings::get('date_format');
    }

    public function order() {
    	return $this->belongsTo(Saleorder::class, 'order_id');
    }

    public function product() {
        return $this->hasMany(DeliveryProduct::class, 'delivery_id');
    }

    public function product_list() {
        return $this->belongsToMany(Product::class, 'deliveries_products', 'delivery_id', 'product_id');
    }

    public function return_delivery() {
        return $this->hasMany(ReturnDelivery::class, 'delivery_id');
    }

    public function agency() {
        return $this->belongsTo(DeliveryAgency::class, 'delivery_agency');
    }

    public function getTotal() {
        $sum = $this->order->shipping_fee;
        $this->product->map(function($item) use (&$sum) {
            $temp = SaleorderProduct::where([
                'order_id' => $item->order_id,
                'product_id' => $item->product_id,
            ])->first();
            $ratio = $this->order->total != 0 ? $temp->sub_total / $this->order->total : 0;
            $order_discount = $ratio * $this->order->discount_amount;
            $after_discount = (($temp->sub_total * (100 - $this->order->discount)) / 100) - $order_discount;
            // $vat = ($after_discount * $this->order->tax) / 100;
            // $sum += (($after_discount + $vat) / $temp->quantity) * $item->quantity;
            $sum += ($after_discount / $temp->quantity) * $item->quantity;
        });
        return $sum;
    }

    public function setDateAttribute($date)
    {
        $this->attributes['date'] = $date ? Carbon::createFromFormat($this->date_format(),$date)->format('Y-m-d') : null;
    }

    public function getDateAttribute($date)
    {
        if ($date == "0000-00-00" || $date == "") {
            return "";
        } else {
            return date($this->date_format(), strtotime($date));
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Efriandika\LaravelSettings\Facades\Settings;

class Order extends Model
{
    use HistoryTrait;
    protected $guarded  = array('id');
    protected $table = 'orders';

    public function date_format()
    {
        return Settings::get('date_format');
    }

    public function setPurchaseDateAttribute($date)
    {
        $this->attributes['purchase_date'] = $date ? Carbon::createFromFormat($this->date_format(),$date)->format('Y-m-d') : null;
    }

    public function getPurchaseDateAttribute($date)
    {
        if ($date == "0000-00-00" || $date == "") {
            return "";
        } else {
            return date($this->date_format(), strtotime($date));
        }
    }

    public function setReceivingDateAttribute($date)
    {
        $this->attributes['receiving_date'] = $date ? Carbon::createFromFormat($this->date_format(),$date)->format('Y-m-d') : null;
    }

    public function getReceivingDateAttribute($date)
    {
        if ($date == "0000-00-00" || $date == "") {
            return "";
        } else {
            return date($this->date_format(), strtotime($date));
        }
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id'); 
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id'); 
    }

    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id'); 
    }

    public function user() {
        return $this->belongsTo(User::class, 'assigned_to'); 
    }

    public function stock_movement() {
        return $this->hasMany(StockMovement::class, 'purchase_id')->orderBy('date', 'desc'); 
    }

    public function getReceivedValue() {
        return $this->stock_movement->sum('total_value');
    }

    public function getReceivedQuantity() {
        return $this->stock_movement->sum('quantity');
    }
}

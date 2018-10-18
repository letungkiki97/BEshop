<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HistoryTrait;
    protected $guarded = array('id');
    protected $table = 'colors';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color', 'color_id', 'product_id');
    }

    public function supplier_price()
    {
        return $this->belongsToMany(SupplierPrice::class, 'supplier_color', 'color_id', 'supplier_id');
    }

    public function property() {
        return $this->hasMany(Property::class, 'color_id');
    }
}

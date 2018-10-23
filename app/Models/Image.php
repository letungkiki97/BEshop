<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded  = array('id');
    protected $table = 'images';

    protected $appends = ['full_path', 'thumb_path'];

    public function getFullPathAttribute()
    {
        return url('uploads/' . $this->attributes['path'] . '/' . $this->attributes['name']);
    }
    
    public function getThumbPathAttribute() 
    {
        return url('uploads/' . $this->attributes['path'] . '/thumb_' . $this->attributes['name']);
    }

    public function banner() {
        return $this->belongsToMany(Banner::class, 'banner_image', 'image_id', 'banner_id');
    }
    
    public function supplier_price() {
        return $this->belongsToMany(SupplierPrice::class, 'supplier_image', 'image_id', 'supplier_id');
    }

    public function production() {
        return $this->belongsToMany(ProductionOrder::class, 'production_image', 'image_id', 'production_id');
    }

    public function drawing()
    {
        return $this->belongsToMany(ProductionOrder::class, 'production_drawing', 'image_id', 'production_id');
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'product_image', 'image_id', 'product_id');
    }

    public function product() {
        return $this->hasMany(Product::class, 'product_image');
    }

    public function news() {
        return $this->hasMany(News::class, 'image_id');
    }

    public function news_category() {
        return $this->hasMany(NewsCategory::class, 'image_id');
    }

    public function advice(){
        return $this->hasMany(Advice::class, 'image_id');
    }
}

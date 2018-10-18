<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Efriandika\LaravelSettings\Facades\Settings;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HistoryTrait;
    protected $dates = ['deleted_at'];
    protected $guarded = array('id');
    protected $table = 'products';

    public function date_format()
    {
        return Settings::get('date_format');
    }

    public function getVariants() {
        return $this->hasMany(Product::class, 'is_variant');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function salesorder()
    {
        return $this->hasMany(SaleorderProduct::class, 'product_id');
    }

    public function parent()
    {
        return $this->belongsTo(Product::class, 'is_variant')->with('subProduct');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function delivery_category()
    {
        return $this->belongsTo(DeliveryCategory::class, 'delivery_category_id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'product_image');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function supplierPrice()
    {
        return $this->hasMany(SupplierPrice::class, 'product_id');
    }

    public function purchase()
    {
        return $this->hasMany(Purchase::class, 'product_id');
    }

    public function stock_movement()
    {
        return $this->hasMany(StockMovement::class, 'product_id');
    }

    public function stock_report()
    {
        return $this->hasMany(StockReport::class, 'product_id');
    }

    public function available_stock() {
        return $this->hasMany(StockReport::class, 'product_id')->where('order_id', 0)->whereHas('storage', function($q) {
            $q->where('available', 1);
        });
    }

    public function salesOrderProduct()
    {
        return $this->belongsToMany(SaleorderProduct::class, 'sales_order_products', 'product_id', 'order_id');
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'news_product', 'product_id', 'news_id');
    }

    public function customer() {
        return $this->belongsToMany(Customer::class, 'wishlist', 'product_id', 'customer_id')->wherePivot('status', 1);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_image', 'product_id', 'image_id');
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }

    public function feature() 
    {
        return $this->belongsToMany(Feature::class, 'product_feature', 'product_id', 'feature_id')->withPivot('value');
    }

    public function property()
    {
        return $this->belongsToMany(Property::class, 'product_variants', 'product_id', 'property_id');
    }

    public function properties() {
        return $this->belongsToMany(Property::class, 'product_variants', 'product_id', 'property_id')->with('type', 'color');
    }

    public function production()
    {
        return $this->hasMany(ProductionOrder::class, 'product_id');
    }

    public function setPromotionFromAttribute($date)
    {
        $this->attributes['promotion_from'] = $date ? Carbon::createFromFormat($this->date_format(),$date)->format('Y-m-d') : null;
    }

    public function getPromotionFromAttribute($date)
    {
        if ($date == "0000-00-00" || $date == "") {
            return "";
        } else {
            return date($this->date_format(), strtotime($date));
        }
    }

    public function setPromotionToAttribute($date)
    {
        $this->attributes['promotion_to'] = $date ? Carbon::createFromFormat($this->date_format(),$date)->format('Y-m-d') : null;
    }

    public function getPromotionToAttribute($date)
    {
        if ($date == "0000-00-00" || $date == "") {
            return "";
        } else {
            return date($this->date_format(), strtotime($date));
        }
    }

    public function scopeActive($query) {
        return $query->where('published', 1)->where('main_sku', '');
    }

    public function subProduct() {
        return $this->getVariants()->where('published', 1)->with('image','images', 'color', 'properties');
    }

    public function featureValue() 
    {
        return $this->hasMany(ProductFeature::class, 'product_id');
    }
}

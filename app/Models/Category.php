<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use DB;


class Category extends Model
{
    use HistoryTrait;
    protected $guarded = array('id');
    protected $table = 'categories';
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class)->where('published',1);
    }

    public function leg()
    {
        return $this->hasMany(Leg::class, 'category_id');
    }

    public function supplier_category()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_category', 'category_id', 'supplier_id');
    }

    public function feature()
    {
        return $this->belongsToMany(Feature::class, 'category_feature', 'category_id', 'feature_id');
    }

    public function parent() 
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function category_feature()
    {
        return $this->hasMany(CategoryFeature::class, 'category_id')->orderBy('order', 'asc');
    }

    public function childCategories()
    {
        return $this->categories()->with('childCategories');
    }

    public function getSKU($id)
    {
        $counter = $this->counter;
        if ($id != $this->id) {
            $counter++;
        }
        $no = 5 - strlen($this->code);
        $code = $this->code;
        for ($i=1; $i < $no; $i++) { 
            if (($this->counter/pow(10, $i)) < 1) {
                $code .= '0';
            }
        }
        return $code . $counter;
    }

    public function product_category()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
    }
}

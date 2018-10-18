<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryFeature extends Model
{
    protected $table = 'category_feature';
    public $timestamps = false;

    public function feature() {
    	return $this->belongsTo(Feature::class, 'feature_id');
    }
}

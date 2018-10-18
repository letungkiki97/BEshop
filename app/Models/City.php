<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	use HistoryTrait;
	protected $dates = ['deleted_at'];
    protected $guarded  = array('id');
    protected $table = 'cities';

    public function district() {
    	return $this->hasMany(District::class, 'city_id');
    }

    public function customer() {
    	return $this->hasMany(Customer::class, 'city_id');
    }
}

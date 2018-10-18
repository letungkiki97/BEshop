<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Role extends Model
{
    use HistoryTrait;
    protected $guarded = array('id');
    protected $table = 'roles';

    public function users() {
    	return $this->belongsToMany(User::class, 'role_users', 'role_id', 'user_id');
    }

    public static function userWithRole($role) {
    	return self::where('slug', $role)->first()->users;
    }

    public function authorized($action) {
    	$role = Sentinel::findRoleById($this->id);
    	return $role->hasAccess([$action]);
    }
}

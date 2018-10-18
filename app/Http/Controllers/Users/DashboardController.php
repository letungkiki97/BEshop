<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Sentinel;
use DB;

class DashboardController extends UserController
{
    protected $result = [];
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (Sentinel::check()) {
            if($this->user->hasAccess(['dashboard.admin']) || $this->user->inRole('admin')) {
                return view('user.dashboard.admin', $this->data);
            } elseif($this->user->hasAccess(['dashboard.basic'])) {
                return view('user.dashboard.basic');
            }
        }
    }
}
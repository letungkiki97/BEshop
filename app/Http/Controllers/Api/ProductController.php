<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\PropertyType;
use App\Models\Customer;
use App\Models\Wishlist;
use App\Models\Feature;
use App\Models\Color;
use Carbon\Carbon;
use Validator;
use Settings;
use Auth;
use Mail;
use App\Models\Property;
use App\Models\ProductFeature;

class ProductController extends Controller
{
    protected $list = [];

    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['getWishlist', 'postWishlist']]);
    }
}

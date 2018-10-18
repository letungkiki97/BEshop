<?php
 
namespace App\Observers;
 
use App\Models\Product;
use App\Models\ProductTag;
use Efriandika\LaravelSettings\Facades\Settings;
use Carbon\Carbon;
use App\Helpers\WoocommerceApi;
 
class ProductObserver
{
    public function created(Product $product)
    {
    	$product->category->counter++;
    	$product->category->save();
    }

    public function updated(Product $product) 
	{
		if ((int)$product->category_id != $product->getOriginal('category_id')) {
			$product->category->counter++;
    		$product->category->save();
		}
		$from = $product->promotion_from ? Carbon::createFromFormat(Settings::get('date_format'),$product->promotion_from)->format('Y-m-d') : null;
		$to = $product->promotion_to ? Carbon::createFromFormat(Settings::get('date_format'),$product->promotion_to)->format('Y-m-d') : null;
		if ((int)$product->sale_price != $product->getOriginal('sale_price') || (int)$product->promotion_price != $product->getOriginal('promotion_price') || $from != $product->getOriginal('promotion_from') || $to != $product->getOriginal('promotion_to') || (int)$product->professional_price != $product->getOriginal('professional_price')) {

			if (Settings::get('endpoint_url') && Settings::get('consumer_key') && Settings::get('consumer_secret')) {
				$client = WoocommerceApi::client(Settings::get('endpoint_url'), Settings::get('consumer_key'), Settings::get('consumer_secret'));
		        $item = $client->products->get_by_sku($product->product_sku);
		        if (isset($item->product)) {
		            $client->products->update($item->product->id, [
		                'regular_price' => (string) $product->sale_price,
		                'sale_price' => $product->promotion_price ? (string) $product->promotion_price : "",
		                'sale_price_dates_from' => $product->promotion_price && $product->promotion_from ? Carbon::createFromFormat(Settings::get('date_format'),$product->promotion_from)->format('Y-m-d') : "",
		                'sale_price_dates_to' => $product->promotion_price && $product->promotion_to ? Carbon::createFromFormat(Settings::get('date_format'),$product->promotion_to)->format('Y-m-d') : "",
		                'prices_by_user_roles' => [
		                    'professional' => $product->promotion_price ? (string) $product->promotion_price : (string) $product->sale_price,
		                    'salePrice' => [
		                        'professional' => (string) $product->professional_price
		                    ]
		                ]
		            ]);
		        }
		    }
			// $web = Settings::get('endpoint_url');
			// $key = Settings::get('consumer_key');
			// $sku = $product->main_sku ?: $product->product_sku;
			// $getUrl = $web . '/wp-admin/admin-ajax.php?action=sm_api_get_product&sku='.$sku.'&oauth_consumer_key='.$key;
			// $postUrl = $web . '/wp-admin/admin-ajax.php?action=sm_api_post_product&sku='.$sku.'&oauth_consumer_key='.$key;
			// $response = json_decode(@file_get_contents($getUrl), true);
			// if($response) {
			// 	switch ($response['product']['type']) {
			// 		case 'variable':
			// 			if (isset($response['product']['variations'])) {
			// 				foreach ($response['product']['variations'] as $key => $var) {
			// 					if ($var['sku'] == $product->product_sku) {
			// 						$response['product']['variations'][$key]['regular_price'] = (string) $product->sale_price;
			// 						$response['product']['variations'][$key]['sale_price'] = $product->promotion_price ? (string) $product->promotion_price : "";
			// 						$response['product']['variations'][$key]['_sale_price_dates_from'] = $product->promotion_price && $product->promotion_from ? $from : "";
			// 						$response['product']['variations'][$key]['_sale_price_dates_to'] = $product->promotion_price && $product->promotion_to ? $to : "";
			// 						$response['product']['variations'][$key]['prices_by_user_roles']['professional'] = $product->promotion_price ? (string) $product->promotion_price : (string) $product->sale_price;
			// 						$response['product']['variations'][$key]['prices_by_user_roles']['salePrice']['professional'] = (string) $product->professional_price;		
			// 					}
			// 				}
			// 			}
			// 			break;

			// 		case 'simple':
			// 			$response['product']['regular_price'] = (string) $product->sale_price;
			// 			$response['product']['sale_price'] = $product->promotion_price ? (string) $product->promotion_price : "";
			// 			$response['product']['_sale_price_dates_from'] = $product->promotion_price && $product->promotion_from ? $from : "";
			// 			$response['product']['_sale_price_dates_to'] = $product->promotion_price && $product->promotion_to ? $to : "";
			// 			$response['product']['prices_by_user_roles']['professional'] = $product->promotion_price ? (string) $product->promotion_price : (string) $product->sale_price;
			// 			$response['product']['prices_by_user_roles']['salePrice']['professional'] = (string) $product->professional_price;		
			// 			break;
					
			// 		default:
			// 			break;
			// 	}
			// 	$postdata = http_build_query(['product' => json_encode($response)]);
			// 	$options = [
			// 	    'http' => [
			// 	        'header'  => "Content-type: application/x-www-form-urlencoded",
			// 	        'method'  => 'POST',
			// 	        'content' => $postdata,
			// 	    ]
			// 	];
			// 	$context  = stream_context_create($options);
			// 	$result = file_get_contents($postUrl, false, $context);
			// }
		}
	}
}
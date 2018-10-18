<?php namespace App\Helpers;
/**
 * WooCommerce API Client Class
 *
 * @version 2.0.0
 * @license GPL 3 or later http://www.gnu.org/licenses/gpl.html
 */

$dir = dirname( __FILE__ ) . '/woocommerce-api/';

// base class
require_once( $dir . 'class-wc-api-client.php' );

// plumbing
require_once( $dir . 'class-wc-api-client-authentication.php' );
require_once( $dir . 'class-wc-api-client-http-request.php' );

// exceptions
require_once( $dir . '/exceptions/class-wc-api-client-exception.php' );
require_once( $dir . '/exceptions/class-wc-api-client-http-exception.php' );

// resources
require_once( $dir . '/resources/abstract-wc-api-client-resource.php' );
require_once( $dir . '/resources/class-wc-api-client-resource-coupons.php' );
require_once( $dir . '/resources/class-wc-api-client-resource-custom.php' );
require_once( $dir . '/resources/class-wc-api-client-resource-customers.php' );
require_once( $dir . '/resources/class-wc-api-client-resource-index.php' );
require_once( $dir . '/resources/class-wc-api-client-resource-orders.php' );
require_once( $dir . '/resources/class-wc-api-client-resource-order-notes.php' );
require_once( $dir . '/resources/class-wc-api-client-resource-order-refunds.php' );
require_once( $dir . '/resources/class-wc-api-client-resource-products.php' );
require_once( $dir . '/resources/class-wc-api-client-resource-reports.php' );
require_once( $dir . '/resources/class-wc-api-client-resource-webhooks.php' );


class WoocommerceApi {

	public static function client($url, $ck, $cs) {
		$option = [
	        'debug'           => true,
	        'return_as_array' => false,
	        'validate_url'    => false,
	        'timeout'         => 30,
	        'ssl_verify'      => false,
	    ];
		return new \WC_API_Client( $url, $ck, $cs, $option);
	}
}
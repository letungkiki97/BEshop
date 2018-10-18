<?php
 
namespace App\Observers;
 
use App\Models\ProductionOrder;
 
class ProductionOrderObserver
{
    public function deleting(ProductionOrder $production_order)
    {
    	$production_order->images()->get()->map(function($item) {
            $item->delete();
        });
        $production_order->images()->detach();

        $production_order->drawing()->get()->map(function($item) {
    		$item->delete();
    	});
        $production_order->drawing()->detach();
    }
}
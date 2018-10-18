<?php
 
namespace App\Observers;
 
use App\Models\SupplierPrice;
 
class SupplierPriceObserver
{
    public function deleting(SupplierPrice $supplier_price)
    {
    	$supplier_price->images()->get()->map(function($item) {
    		$item->delete();
    	});
        $supplier_price->images()->detach();
        $supplier_price->color()->detach();
    }
}
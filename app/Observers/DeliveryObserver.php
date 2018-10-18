<?php
 
namespace App\Observers;
 
use App\Models\Delivery;
 
class DeliveryObserver
{
    public function deleting(Delivery $delivery)
    {
        $delivery->product()->delete();
    }

    public function saved(Delivery $delivery) 
    {
    	$order = $delivery->order;
    	if ($delivery->status) {
    		if ($order->isFull() || $delivery->last) {
    			$order->status = 'Delivered'; 
    		} else {
    			$order->status = 'Delivered (P)';
    		}
            $order->save();
    	}
    }
}
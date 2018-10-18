<?php
 
namespace App\Observers;
 
use App\Models\ReturnDelivery;
 
class ReturnDeliveryObserver
{
    public function deleting(ReturnDelivery $return_delivery)
    {
        $return_delivery->product()->delete();
    }
}
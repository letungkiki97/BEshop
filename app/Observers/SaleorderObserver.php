<?php
 
namespace App\Observers;
 
use App\Models\Saleorder;
 
class SaleorderObserver
{
    public function deleting(Saleorder $saleorder)
    {
        $saleorder->products()->delete();
    }
}
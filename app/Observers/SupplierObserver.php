<?php
 
namespace App\Observers;
 
use App\Models\Supplier;
 
class SupplierObserver
{
    public function deleting(Supplier $supplier)
    {
        $supplier->category()->detach();
    }
}
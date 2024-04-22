<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'purchase_products')->withPivot('quantity', 'unit_price', 'totalPrice');
    }
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

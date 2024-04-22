<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $guarded = ['id'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'customer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchse_Product extends Model
{
    use HasFactory;

    protected $table = 'purchase_products';

    protected $guarded = ['id'];
}

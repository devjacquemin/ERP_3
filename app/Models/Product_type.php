<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Product_type extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->hasMany(Product::class);
    }
}

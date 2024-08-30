<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'products_id');
    }
}

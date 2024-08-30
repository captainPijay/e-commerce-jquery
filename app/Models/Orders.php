<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }
}

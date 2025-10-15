<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'total', 'status', 'payment_date', 'shipping_date', 'completion_date'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

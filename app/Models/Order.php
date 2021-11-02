<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    // Pass status when want list according to status type
    public function getOrdersList( $status = null ) {
        return Order::
        when($status, function($query) use ($status) {
            $query->where('status', '=', $status);
        })
        ->with('items')
        ->orderBy('id', 'DESC')
        ->get();
    }

    // Get Order Details
    public function getOrderDetail( $id = null, $order_number = null ) {
        return Order::
        when($id, function($query) use ($id) {
            $query->where('id', '=', $id);
        })
        ->when($order_number, function($query) use ($order_number) {
            $query->where('order_number', '=', $order_number);
        })
        ->with('items')
        ->first();
    }

    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')->withPivot('price');
    }

}

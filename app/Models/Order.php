<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['delivery_boy_id', 'order_details', 'assigned_at'];

    public function deliveryBoy()
    {
        return $this->belongsTo(DeliveryBoy::class);
    }
}

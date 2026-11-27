<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'pay_u_id',
        'pay_in_id',
        'pay_ba_id',
        'paypal_order_id',
        'paypal_capture_id',
        'pay_purchase_type',
        'pay_amount_minor',
        'pay_description',
        'pay_currency',
        'status',
        'paid_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
















<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'pay_u_id',
        'pay_in_id',
        'pay_e_id',
        'paypal_order_id',
        'paypal_capture_id',
        'pay_for',
        'pay_purchase_type',
        'pay_amount_total',
        'pay_amount_minor',
        'pay_amount_discount',
        'pay_description',
        'pay_currency',
        'pay_status',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'in_id';
    protected $fillable = [
        'in_id',
        'in_u_id',
        'in_date',
        'in_paypal_order_id',
        'in_paypal_capture_id',
        'in_amount_minor',
        'in_remarks',
        'created_at',
        'updated_at',
    ];
}
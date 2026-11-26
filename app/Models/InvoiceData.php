<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceData extends Model
{
    protected $table = 'invoice_data';
    protected $primaryKey = 'ind_id';
    protected $fillable = [
        'ind_id',
        'ind_in_id',
        'ind_e_id',
        'ind_for',
        'ind_total',
        'ind_amount_minor',
        'ind_discount',
        'ind_coupon',
        'created_at',
        'updated_at',
    ];
}
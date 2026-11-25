<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasketsData extends Model
{
    protected $table = 'baskets_data';
    protected $primaryKey = 'bad_id';
    protected $fillable = [
        'bad_id',
        'bad_ba_id',
        'bad_u_id',
        'bad_e_id',
        'bad_for',
        'bad_jiondate',
        'bad_expdate',
        'bad_price',
        'bad_discount_price',
        'bad_coupon',
        'bad_status',
        'created_at',
        'updated_at',
    ];
}
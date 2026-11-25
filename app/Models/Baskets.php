<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baskets extends Model
{
    protected $table = 'baskets';
    protected $primaryKey = 'ba_id';
    protected $fillable = [
        'ba_id',
        'ba_u_id',
        'ba_status',
        'created_at',
        'updated_at',
    ];
}

					

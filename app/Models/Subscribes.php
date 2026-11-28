<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribes extends Model
{
    protected $table = 'subscribes';
    protected $primaryKey = 'su_id';
    protected $fillable = [
        'su_id',
        'su_e_id',
        'su_u_id',
        'su_in_id',
        'su_for',
        'su_jiondate',
        'su_expdate',
        'created_at',
        'updated_at',
    ];
}
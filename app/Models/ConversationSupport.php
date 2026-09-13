<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationSupport extends Model
{
    protected $fillable = [
        'cos_name',
        'cos_email',
        'cos_category',
        'cos_reference',
        'cos_subject',
        'cos_message',
        'created_at',
        'updated_at',
    ];
}







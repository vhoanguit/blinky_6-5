<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $primaryKey = 'contact_id';

    protected $fillable = [
        'contact_id',
        'customer_name',
        'customer_phone',
        'Email',
        'contact_title',
        'contact_question',
        'reply_status',
        'reply_title',
        'reply_content',
    ];
}
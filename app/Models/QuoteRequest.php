<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuoteRequest extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'username',
        'phone_number',
        'agree_terms'
    ];
}

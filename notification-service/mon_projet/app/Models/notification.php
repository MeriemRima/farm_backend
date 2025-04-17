<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Type;

class notification extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'is_read',
        'type',
    ];  //
    
}

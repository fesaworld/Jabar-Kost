<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'user_id', 'ref_id', 'address', 'phone', 'image', 'gender', 'card_id'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferralCode extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'token', 'status', 'created_at', 'updated_at'
    ];

    public function refferal() {
        return $this->belongsTo(UserDetail::class, 'id');
    }
}

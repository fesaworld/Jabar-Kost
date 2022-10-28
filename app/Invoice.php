<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'room_id', 'start', 'end', 'discount', 'total_price', 'status', 'created_at', 'updated_at'
    ];

    public function toUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function toRoom()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}

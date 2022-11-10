<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'price', 'stok', 'detail', 'image', 'created_at', 'updated_at'
    ];

    public function invoiceRoom() {
        return $this->belongsTo(Invoice::class, 'id');
    }
}

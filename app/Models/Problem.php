<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    protected $table = 'problems';

    protected $fillable = ['order_id', 'device', 'brand', 'fault', 'description'];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function bids() {
        return $this->hasMany(Bid::class);
    }
}

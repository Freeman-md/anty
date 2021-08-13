<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $table = 'bids';

    protected $fillable = ['problem_id', 'name', 'price', 'rating', 'status'];

    public function problem() {
        return $this->belongsTo(Problem::class);
    }
}

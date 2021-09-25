<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function payment () {
        return $this->belongsTo(Payment::class);
    }

    public function campaign () {
        return $this->belongsTo(Campaign::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}

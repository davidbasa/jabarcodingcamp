<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'payment_methods';

    public function campaign()
    {
        return $this->hasMany(Campaign::class, 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function campaign()
    {
        return $this->hasMany(Campaign::class, 'id');
    }
}

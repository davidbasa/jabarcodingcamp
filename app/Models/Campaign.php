<?php

namespace App\Models;

use App\Models\Categories;
use GrahamCampbell\ResultType\Result;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public static function slug ($slug) {
        return self::where('slug', $slug)->first();
    }

    static function public_page()
    {
        $get_campaign = static::where('status', 'Ongoing')->latest()->get();
        $categories = Categories::pluck('id')->toArray();
        
        $result = [];
        for ($i = 0; $i < count($categories); $i++) { 
            $result[$i]['id'] = $categories[$i];
            $result[$i]['name'] = Categories::where('id', $categories[$i])->first()->name;
            $result[$i]['data'] = array();
            foreach ($get_campaign as $campaign) {
                if ($campaign->category_id == $categories[$i]) {
                    array_push($result[$i]['data'], $campaign);
                    continue;
                }
            }
        }
        
        return $result;
    }
}

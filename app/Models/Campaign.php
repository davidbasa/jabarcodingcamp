<?php

namespace App\Models;

use App\Models\Categories;
use GrahamCampbell\ResultType\Result;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Campaign extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = [
        'percentage'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public static function slug ($slug) {
        return self::where('slug', $slug)->first();
    }

    public function scopeListCampaign($query) {
        return $query->selectRaw("campaigns.*, SUM(donations.amount) as fund_collected")
            ->from('campaigns')
            ->join('categories', 'categories.id', 'campaigns.category_id')
            ->leftjoin('donations', function($join) {
                $join->on('donations.campaign_id','campaigns.id')
                    ->on('donations.status', DB::Raw("'success'"));
            })
            ->groupBy('campaigns.id');
    }

    public function getCollectedAttribute() {
        $collected = Donation::select('amount')->where([
            'status' => 'success',
            'campaign_id' => $this->attributes['id']
        ])->sum('amount');

        return $collected;
    }

    public function getPercentageAttribute() {
        $percentage = @$this->attributes['fund_collected'] / ($this->attributes['target'] / 100);

        return $percentage > 100 ? 100 : $percentage;
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
                    $campaign['collected'] = Donation::where('status', 'success')->where('campaign_id', $campaign->id)->sum('amount');
                    array_push($result[$i]['data'], $campaign);
                    continue;
                }
            }
        }

        return $result;
    }
}

<?php

use Illuminate\Support\Facades\Auth;

function isAdmin()
{
    return Auth::user()->role_id == 1 ? true : false;
}

function formatRupiah($number){ 
    $result =  'Rp ' . number_format($number,0, ',' , '.'); 
    return $result; 
}

function indonesianDate($timestamp, $with_time = false)
{
    $split = explode(' ', $timestamp);
    $date = explode('-', $split[0]);
    
    switch($date[1]){
        case '01': $month = 'Januari'; break;
        case '02': $month = 'Februari'; break;
        case '03': $month = 'Maret'; break;
        case '04': $month = 'April'; break;
        case '05': $month = 'Mei'; break;
        case '06': $month = 'Juni'; break;
        case '07': $month = 'Juli'; break;
        case '08': $month = 'Agustus'; break;
        case '09': $month = 'September'; break;
        case '10': $month = 'Oktober'; break;
        case '11': $month = 'November'; break;
        case '12': $month = 'Desember'; break;
    }

    if(!$with_time) {
        return $date[2] . ' ' . $month . ' ' . $date[0];
    } else {
        return $date[2] . ' ' . $month . ' ' . $date[0] . ' | ' . $split[1];
    }
}

function countRangeDayUntilToday($date)
{
    $interval = date_diff(date_create(date('Y-m-d')), date_create($date));
    return $interval->format('%d');
}
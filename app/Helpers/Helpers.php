<?php

use Illuminate\Support\Facades\Auth;

function isAdmin()
{
    return Auth::user()->role_id == 1 ? true : false;
}

function formatRupiah($number){ 
    $result =  'Rp. ' . number_format($number,0, ',' , '.'); 
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
    return $interval->days;
}

function campaign_category_label($id, $name = null) {
    switch($id) {
        case 1:
            return '<span class="badge bg-danger">'.$name.'</span>';
        break;
        case 2:
            return '<span class="badge bg-warning">'.$name.'</span>';
        break;
        case 3:
            return '<span class="badge bg-info">'.$name.'</span>';
        break;
        case 4:
            return '<span class="badge bg-success">'.$name.'</span>';
        break;
        default: 
            return '<span class="badge bg-success">'.$name.'</span>';
    }
}

function donation_status_label($status) {
    switch($status) {
        case 'cancel':
            return '<span class="badge bg-danger">Cancel</span>';
        break;
        case 'waiting_transfer':
            return '<span class="badge bg-warning">Menunggu Pembayaran</span>';
        break;
        case 'success':
            return '<span class="badge bg-success">Berhasil</span>';
        break;
        default: 
            return '<span class="badge bg-info">Unknown</span>';
    }
}

function fund_percentage($target, $collected) {
    $percentage = $collected / ($target / 100);
    return $percentage > 100 ? 100 : $percentage;
}
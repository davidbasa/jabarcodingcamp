<?php

use Illuminate\Support\Facades\Auth;

function isAdmin()
{
    return Auth::user()->role_id == 1 ? true : false;
}
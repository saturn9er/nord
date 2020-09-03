<?php

namespace App\Http\Controllers;

use App\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoCodeController extends Controller
{
    public function index()
    {
        //return PromoCode::all('id', 'promo_code', 'discount', 'issued_to', 'used');
    }

    public function show($promocode)
    {
        return PromoCode::select('id', 'promo_code', 'discount', 'issued_to')->where('promo_code', $promocode)->where('used', 0)->first();
    }
}

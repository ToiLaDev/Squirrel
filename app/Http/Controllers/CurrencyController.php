<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    //
    public function swap($short){

        $availCurrency = Currency::all()->pluck('short')->toArray();

        if(in_array($short, $availCurrency)){
            session()->put('currency',$short);
        }
        return redirect()->back();
    }
}
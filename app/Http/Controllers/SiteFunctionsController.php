<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

class SiteFunctionsController extends Controller
{
    public function getExchangeRates () {
        $api = env('FIXER_CURRENCY_CONVERTER');
        
        //$string = file_get_contents("http://data.fixer.io/api/latest?access_key=$api&format=1");
        $url = "http://data.fixer.io/api/latest?access_key=$api&format=1";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        //$result=json_decode($result,true);
        $json = json_decode($result, true);

        $this->updateExchangeRates($json['rates']);
        
        //dd($currency);
        dd('Currencies exchange rates updated successfully.');
    }

    public function updateExchangeRates($rates) {
        foreach ($rates as $key => $value) {
            Currency::where('currency_code','=',$key)->update(['exchange_rate'=>$value]);
        }
    }
}

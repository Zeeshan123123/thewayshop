<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;


    // Validation Rules
    public function validations($rules = []) {
        return $rules += [
            'currency_code' => 'required|unique:currencies,currency_code',
            'exchange_rate' => 'required',
            'status' => 'required|in:active,inactive',
        ];
    }

    // Pass status when want list according to status type
    public function getCurrenciesList( $status = null ) {
        return Currency::
        when($status, function($query) use ($status) {
            $query->where('status', '=', $status);
        })
        ->orderBy('id', 'DESC')
        ->get();
    }

    // Get Currency Detail
    public function getCurrencyDetail( $id = null ) {
        return Currency::
        when($id, function($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();
    }

    // Get Currency Detail By Code
    public function getCurrencyDetailByCode( $code = null ) {
        return Currency::
        where('currency_code', '=', $code)->first();
    }


    // Store Currency
    public function storeCurrency( $data )
    {
        $currency = new Currency;

        $currency->currency_code   = $data['currency_code'];
        $currency->currency_symbol = $data['currency_symbol'];
        $currency->exchange_rate   = $data['exchange_rate'];
        $currency->status  = $data['status'];

        $currency->save();

        return with($currency);
    }

    // Update Currency
    public function updateCurrency( $data )
    {
        $currency = new Currency;

        $currency = $this->getCurrencyDetail( $data['currency_id'] );

        $currency->currency_code   = $data['currency_code'];
        $currency->currency_symbol = $data['currency_symbol'];
        $currency->exchange_rate   = $data['exchange_rate'];
        $currency->status  = $data['status'];

        $currency->update();

        return with($currency);
    }

    // Get Currency Rates
    public function getCurrencyRates( $price )
    {
        $currencies_list = Currency::where('status', '=', 'active')->get();

        foreach ($currencies_list as $currency) {
            if( $currency->currency_code == "USD" ) {
                $usd_rate = round($price/$currency->exchange_rate, 2);
            } else if( $currency->currency_code == "EUR" ) {
                $eur_rate = round($price/$currency->exchange_rate, 2);
            }
        }

        $currencies = array(
            'usd_rate' => $usd_rate,
            'eur_rate' => $eur_rate,
        );

        return $currencies;
    }
}

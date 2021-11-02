<?php

/*
$server_protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
$base_path = $server_protocol . $_SERVER['SERVER_NAME'];
*/

$base_path = 'http://ecommerce.org';


define('BASE_PATH', $base_path.'/');

define('ASSETS', BASE_PATH);

define('ASSETS_BACKEND', BASE_PATH.'assets/backend/');

// Uploaded Images
define('UPLOADS', BASE_PATH.'images/profile/');

// Public Path
define('PUBLICS_PATH', BASE_PATH);


// Get Product Sort Types
function getProductSortTypes()
{
    return [
        'latest',
        'oldest',
        'lowest_price',
        'highest_price',
        'most_popular'
    ];
}

// Get Product Units
function getProductUnits()
{
    return ['kg','g','l','ml','mg','cm','m'];
}


function uploadImage($image,$loaded_image = '')
{

    if((isset($image) && trim(strlen($image)) > 0))
    {
        $image =  imageLinker($image);
    }
    else
    {
        if(strlen(trim($loaded_image)) > 0)
        {
            $image =  $loaded_image;
        }
        else
        {
           $image = '';
        }
    }

    return $image;
}

function imageLinker($contant_file)
{

    $file_name = uniqid().'.'.$contant_file->getClientOriginalExtension();

    \Storage::disk('public')->put('images/'.$file_name,file_get_contents($contant_file));

    return $file_name;
}

function getImage($file_name)
{
    return asset(Storage::url('images/'.$file_name));
}

function numberFormat($value)
{
    return number_format($value,2);
}

// Currency load
function currencyLoad()
{
    if ( session()->has('system_default_currency_info') == false ) {
        // session()->put('system_default_currency_info', \App\Models\Currency::where('currency_symbol', '=', '$')->first());
        // session()->put('system_default_currency_info', \App\Models\Currency::find(1));
        session()->put('system_default_currency_info', \App\Models\Currency::find(11));
    }
}

// Currency converter
function currencyConverter( $amount )
{
    return format_price(convertAmount( $amount ));
}

// Convert Price
function convertAmount( $price )
{
    currencyLoad();

    $system_default_currency_info = session('system_default_currency_info');
    $price = floatval($price)/floatval($system_default_currency_info->exchange_rate);

    if ( session()->has('currency_exchange_rate') ) {
        $exchange = session('currency_exchange_rate');
    }
    else {
        $exchange = $system_default_currency_info->exchange_rate;
    }

    $price = floatval($price)*floatval($exchange);

    return $price;
}

function currencySymbol()
{
    currencyLoad();

    if ( session()->has('currency_symbol') ) {
        $symbol = session('currency_symbol');
    }
    else {
        $system_default_currency_info = session('system_default_currency_info');
        $symbol = $system_default_currency_info->currency_symbol;
    }

    return $symbol;
}

function getCurrencySymbol()
{
    currencyLoad();
    $currency_code = session('currency_code');
    $currency_symbol = session('currency_symbol');

    if ( $currency_symbol == "" ) {
        $system_default_currency_info = session('system_default_currency_info');
        $currency_symbol = $system_default_currency_info->currency_symbol;
        $currency_code = $system_default_currency_info->currency_code;
    }
    return $currency_symbol;
}

function getCurrencyCode()
{
    currencyLoad();
    $currency_code = session('currency_code');
    $currency_symbol = session('currency_symbol');

    if ( $currency_symbol == "" ) {
        $system_default_currency_info = session('system_default_currency_info');
        $currency_symbol = $system_default_currency_info->currency_symbol;
        $currency_code = $system_default_currency_info->currency_code;
    }
    return $currency_code;
}

function format_price( $price ) {
    return currencySymbol(). number_format($price, 2);
}

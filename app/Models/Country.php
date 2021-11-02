<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;



    // Start: Reusable Functions
        public function getCountriesList() {
            return Country::all();
        }
    // End: Reusable Functions


    // Get Category Detail
    public function getCountryDetail( $id = null ) {
        return Country::
        when($id, function($query) use ($id) {
            $query->where('id', '=', $id);
        })->first();
    }
}

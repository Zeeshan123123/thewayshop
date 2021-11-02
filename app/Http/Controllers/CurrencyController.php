<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

use Validator;
use Crypt;

class CurrencyController extends Controller
{
    private $currrency;

    public function __construct()
    {
        $this->currency = new Currency;
    }

    public function index()
    {
        // Initialization
            $data = [];
        // End Initialization

        // Getting currencies data
        $data['currencies'] = $this->currency->getCurrenciesList();

        return view('backend.currencies.manage_currencies', $data);
    }

    public function create()
    {
        return view('backend.currencies.add_currency');
    }

    public function store( Request $request )
    {
        // Initialization
            $data = $request->input();
        // End Initialization

        $rules = $this->currency->validations();
        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $currency = $this->currency->storeCurrency($data);

        if ( $currency->id ) {
            return redirect('currencies')->with('success', 'Currrency Has Been Successfully Stored.');
        }
        else {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }


    public function edit( $id )
    {
        // Initialization
        $id = Crypt::decrypt($id);
        $data = [];
        // End Initialization

        $data['currency'] = $this->currency->getCurrencyDetail( $id );

        return view('backend.currencies.edit_currency', $data);
    }


    public function update( Request $request )
    {

        // Initialization
        $data = $request->input();
        $data['currency_id'] = Crypt::decrypt($data['currency_id']);
        // End Initialization

        $rules = $this->currency->validations(
            [
                'currency_code' => 'required|unique:currencies,currency_code,'.$data['currency_id'],
            ]
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $currency = $this->currency->updateCurrency( $data );

        if ( $currency->id ) {
            return redirect('currencies')->with('success', 'Currency Has Been Successfully Updated.');
        }
        else {
            return redirect()->back()->with('error', 'Currency Updating Error.');
        }
    }

    public function delete( $id )
    {
        try
        {
            // Initialization
            $id = decrypt($id);
            // End Initialization

            $currency = $this->currency->getCurrencyDetail( $id );
            $currency->delete();

            return redirect('currencies')->with('success', 'Currency Has Been Successfully Deleted.');

        }
        catch (DecryptException $e)
        {
            return back()->with('error', 'Something went wrong!');
        }

        return redirect('bank');
    }

    // Load Currency
    public function loadCurrency( Request $request )
    {
        session()->put('currency_code', $request->currency_code);

        $currency = $this->currency->getCurrencyDetailByCode( $request->currency_code );

        session()->put('currency_symbol', $currency->currency_symbol);
        session()->put('currency_exchange_rate', $currency->exchange_rate);

        $response['status'] = true;

        return $response;
    }
}

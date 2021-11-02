<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

use Crypt;

class CountryController extends Controller
{
    private $country;

    public function __construct()
    {
        $this->country = new Country;
    }

    public function index()
    {
        // Initialization
            $data = [];
        // End Initialization

        $data['countries'] = $this->country->getCountriesList();

        return view('backend.countries.manage_countries', $data);
    }


    public function edit( $id )
    {
        dd('under construction...');
        // Initialization
            $id = Crypt::decrypt($id);
            $data = [];
        // End Initialization

        $data['country'] = $this->country->getCountryDetail( $id );

        return view('backend.countries.edit_country', $data);
    }


    public function update( Request $request )
    {

        // Initialization
        $data = $request->input();
        $data['category_id'] = Crypt::decrypt($data['category_id']);
        // End Initialization

        $rules = $this->category->validations(
            [
                'title' => 'required|unique:categories,title,'.$data['category_id'],
            ]
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $category = $this->category->updateCategory( $data );

        if ( $category->id ) {
            return redirect('categories')->with('success', 'Category Has Been Successfully Updated.');
        }
        else {
            return redirect()->back()->with('error', 'Category Updating Error.');
        }
    }


    public function delete( $id )
    {
        try
        {
            // Initialization
            $id = decrypt($id);
            // End Initialization

            $category = $this->category->getCategoryDetail( $id );
            $category->delete();

            return redirect('categories')->with('success', 'Category Has Been Successfully Deleted.');

        }
        catch (DecryptException $e)
        {
            return back()->with('error', 'Something went wrong!');
        }

        return redirect('bank');
    }

}

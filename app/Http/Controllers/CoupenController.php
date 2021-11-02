<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupen;

use Validator;
use Crypt;

class CoupenController extends Controller
{
    
    private $coupen;

    public function __construct()
    {
        $this->coupen = new Coupen;
    }

    public function index()
    {
        // Initialization
            $data = [];
        // End Initialization

        $data['coupens'] = $this->coupen->getCoupensList();

        return view('backend.coupens.manage_coupens', $data);
    }

    public function create()
    {
        return view('backend.coupens.add_coupen');
    }


    public function store( Request $request )
    {   
        // Initialization
            $data = $request->input();
        // End Initialization

        $rules = $this->coupen->validations();
        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $coupen = $this->coupen->storeCoupen($data);

        if ( $coupen->id ) {
            return redirect('coupens')->with('success', 'Coupen Has Been Successfully Stored.');
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

        $data['coupen'] = $this->coupen->getCoupenDetail( $id );

        return view('backend.coupens.edit_coupen', $data);
    }


    public function update( Request $request )
    {

        // Initialization
        $data = $request->input();
        $data['coupen_id'] = Crypt::decrypt($data['coupen_id']);
        // End Initialization

        $rules = $this->coupen->validations(
            [
                'code' => 'required|unique:coupens,code,'.$data['coupen_id'],
            ]
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $coupen = $this->coupen->updateCoupen( $data );

        if ( $coupen->id ) {
            return redirect('coupens')->with('success', 'Coupen Has Been Successfully Updated.');
        }
        else {
            return redirect()->back()->with('error', 'Coupen Updating Error.');
        }
    }


    public function delete( $id )
    {
        try
        {
            // Initialization
            $id = decrypt($id);
            // End Initialization

            $coupen = $this->coupen->getCoupenDetail( $id );
            $coupen->delete();

            return redirect('coupens')->with('success', 'Coupen Has Been Successfully Deleted.');

        }
        catch (DecryptException $e)
        {
            return back()->with('error', 'Something went wrong!');
        }

        return redirect('bank');
    }
}

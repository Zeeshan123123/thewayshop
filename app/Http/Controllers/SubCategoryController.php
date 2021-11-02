<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;

use Validator;
use Crypt;

class SubCategoryController extends Controller
{
    private $category;
    private $subcategory;
    private $user;

    public function __construct()
    {
        $this->category         = new Category;
        $this->subcategory      = new SubCategory;
        $this->user             = new User;
    }

    public function index()
    {
        // Initialization
            $data = [];
        // End Initialization

        $data['subcategories'] = $this->subcategory->getSubCategoriesList();

        return view('backend.subcategories.manage_subcategories', $data);
    }


    public function create()
    {
        // Initialization
            $data = [];
        // End Initialization

        // Start: Fetch Data
            $data['categories'] = $this->category->getCategoriesList('active');
        // End: Fetch Data

        return view('backend.subcategories.add_subcategory', $data);
    }


    public function store( Request $request )
    {
        // Initialization
            $data = $request->input();
        // End Initialization
        
        $rules = $this->subcategory->validations();
        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $subcategory = $this->subcategory->storeSubCategory($data);

        if ( $subcategory->id ) {
            return redirect('subcategories')->with('success', 'Sub Category Has Been Successfully Stored.');
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

        $data['subcategory'] = $this->subcategory->getSubCategoryDetail( $id );
        $data['categories'] = $this->category->getCategoriesList('active');

        return view('backend.subcategories.edit_subcategory', $data);
    }


    public function update( Request $request )
    {

        // Initialization
            $data = $request->input();
            $data['subcategory_id'] = Crypt::decrypt($data['subcategory_id']);
        // End Initialization

        $rules = $this->subcategory->validations(
            [
                'title' => 'required|unique:sub_categories,title,'.$data['subcategory_id'],            
            ]
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        

        $subcategory = $this->subcategory->updateSubCategory( $data );

        if ( $subcategory->id ) {
            return redirect('subcategories')->with('success', 'Sub Category Has Been Successfully Updated.');
        }
        else {
            return redirect()->back()->with('error', 'Sub Category Updating Error.');
        }
    }


    public function delete( $id )
    {
        try
        {
            // Initialization
                $id = decrypt($id);
            // End Initialization

            $subcategory = $this->subcategory->getSubCategoryDetail( $id );
            $subcategory->delete();

            return redirect('subcategories')->with('success', 'Sub Category Has Been Successfully Deleted.');

        }
        catch (DecryptException $e)
        {
            return back()->with('error', 'Something went wrong!');
        }

        return redirect('bank');
    }
}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;

use Validator;
use Crypt;

class CategoryController extends Controller
{
    private $category;

    public function __construct()
    {
        $this->category = new Category;
    }

    public function index()
    {
        // Initialization
            $data = [];
        // End Initialization

        $data['categories'] = $this->category->getCategoriesList();

        return view('backend.categories.manage_categories', $data);
    }

    public function create()
    {
        return view('backend.categories.add_category');
    }

    public function store( Request $request )
    {
        // Initialization
            $data = $request->input();
        // End Initialization

        $rules = $this->category->validations();
        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = $this->category->storeCategory($data);

        if ( $category->id ) {
            return redirect('categories')->with('success', 'Category Has Been Successfully Stored.');
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

        $data['category'] = $this->category->getCategoryDetail( $id );

        return view('backend.categories.edit_category', $data);
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

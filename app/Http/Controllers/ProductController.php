<?php

namespace App\Http\Controllers;


use App\Notifications\ItemAdded;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;

use Validator;
use Crypt;

class ProductController extends Controller
{
    private $product;
    private $category;
    private $sub_category;
    private $user;

    public function __construct()
    {
        $this->product          = new Product;
        $this->category         = new Category;
        $this->user             = new User;
    }

    public function index()
    {
        // Initialization
            $data = [];
        // End Initialization

        $data['products'] = $this->product->getProductsList();

        return view('backend.products.manage_products', $data);
    }

    public function create()
    {
        // Initialization
        $data = [];
        $data['form_data'] =
            array(
                'form_title'       => 'product_information',
                'category'         => 'category',
                'title'            => 'title',
                'slug'             => 'slug',
                'codes'            => 'codes',
                'images'           => 'images',
                'short_description'=> 'short_description',
                'long_description' => 'long_description',
                'meta_title'       => 'meta_title',
                'meta_description' => 'meta_description',
                'meta_keywords'    => 'meta_keywords',
                'quantity'         => 'quantity',
                'weight'           => 'weight',
                'unit'             => getProductUnits(),
                'price'            => 'price',
                'hits'             => 'hits',
                'status'           => 'status',
                'created_at'       => 'created_at',
            );
        // End Initialization

        // Start: Fetch Data
        $data['categories'] = $this->category->getCategoriesList('active');
        // End: Fetch Data

        return view('backend.products.add_product', $data);
    }

    public function store( Request $request )
    {
        // Initialization
            $data = $request->input();
        // End Initialization

        $rules = $this->product->validations();
        /*$validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }*/

        $data['images'] = $request->images;
        $product = $this->product->storeProduct($data);

        if ( $product->id ) {
            // notifying admin about item added
            $product->notify(new ItemAdded($product));
            return redirect('products')->with('success', 'Product Has Been Successfully Posted.');
        }
        else {
            return redirect()->back()->with('error', 'Product Posting Error.');
        }
    }

    public function edit( $id )
    {
        // Initialization
        $id = Crypt::decrypt($id);
        $data = [];
        $data['form_data'] =
            array(
                'form_title'       => 'edit_product_information',
                'category'         => 'category',
                'title'            => 'title',
                'slug'             => 'slug',
                'code'             => 'code',
                'images'           => 'images',
                'short_description'=> 'short_description',
                'long_description' => 'long_description',
                'meta_title'       => 'meta_title',
                'meta_description' => 'meta_description',
                'meta_keywords'    => 'meta_keywords',
                'quantity'         => 'quantity',
                'weight'           => 'weight',
                'unit'             => getProductUnits(),
                'price'            => 'price',
                'hits'             => 'hits',
                'status'           => 'status',
                'created_at'       => 'created_at',
            );
        // End Initialization

        $data['product'] = $this->product->getProductDetail( $id, null );
        $data['categories'] = $this->category->getCategoriesList('active');

        return view('backend.products.edit_product', $data);
    }

    public function update( Request $request )
    {

        // Initialization
            $data = $request->input();
            $data['product_id'] = Crypt::decrypt($data['product_id']);
        // End Initialization

        $rules = $this->product->validations(
            [
                'slug' => 'required|unique:products,slug,'.$data['product_id'],
                'code' => 'required|unique:products,code,'.$data['product_id'],
            ]
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data['images'] = $request->images;
        $product = $this->product->updateProduct( $data );

        if ( $product->id ) {
            return redirect('products')->with('success', 'Product Has Been Successfully Updated.');
        }
        else {
            return redirect()->back()->with('error', 'Product Updating Error.');
        }
    }

    public function delete( $id )
    {
        try
        {
            // Initialization
                $id = decrypt($id);
            // End Initialization

            $product = $this->product->getProductDetail( $id, $slug = null );
            $product->delete();

            return redirect('products')->with('success', 'Product Has Been Successfully Deleted.');

        }
        catch (DecryptException $e)
        {
            return back()->with('error', 'Something went wrong!');
        }

        return redirect('bank');
    }

    // Check Slug In Db
    public function checkSlugInDb(Request $request)
    {
        try {
            if ( $request->ajax() ) {
                // Intialization
                $data = $request->input();
                // End Intialization

                if ( is_null($data['slug']) ) {
                    return response()->json(['error'=>'Please enter slug.']);
                }

                $product = $this->product->getProductDetail( null, $data['slug'], null );

                if ( isset($data['product_id']) && $product->id == $data['product_id'] ) {
                    return;
                }

                if (!is_null($product)) {
                    return response()->json(['error'=>'Slug already exists.']);
                }
            }
        } catch (Exception $e) {
            return response()->json(['error'=>'Slug error.']);
        }
    }

    // Check Code In Db
    public function checkCodeInDb(Request $request)
    {
        try {
            if ( $request->ajax() ) {
                // Intialization
                $data = $request->input();
                // End Intialization

                if ( is_null($data['code']) ) {
                    return response()->json(['error'=>'Please enter code.']);
                }

                $product = $this->product->getProductDetail( null, null, $data['code'] );

                if ( isset($data['product_id']) && $product->id == $data['product_id'] ) {
                    return;
                }

                if (!is_null($product)) {
                    return response()->json(['error'=>'Code already exists.']);
                }
            }
        } catch (Exception $e) {
            return response()->json(['error'=>'Code error.']);
        }
    }



    /* Start: Validations */
    public function validateProductRequest(array $data, $rules)
    {
        return Validator::make($data, $rules);
    }

    public function validateUpdateBlogRequest(array $data)
    {
        return Validator::make($data, [
            'category'  => 'required',
            'title'  => 'required|string|max:300',
            'slug'  => 'required|unique:products,slug,'.$data['product_id'],
            'code'  => 'required|unique:products,code,'.$data['product_id'],
            'description'  => 'required|string|max:1000',
            'meta_title'  => 'required|string|max:300',
            'meta_description'  => 'required|string|max:1000',
            'meta_keywords'  => 'required|string|max:300',
        ]);
    }
    /* End: Validations */
}

<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Coupen;

use Crypt;

class ProductController extends Controller
{
    public function index()
    {
        $product = new Product();
        $products = $product->getProductsList('active');
        return view('frontend.products.listings', compact('products'));
    }


    public function showProductDetail( $id )
    {
       
        // Initialization
            $data = [];
            $id = decrypt($id);
            $product = new Product();
        // End Initialization
        $data['product_detail'] = $product->getProductDetail($id);

        return view('frontend.products.detail', $data); 
    }


    // Apply Coupen
    public function applyCoupen( Request $request ) 
    {
        // Initialization
            $coupen = new Coupen;
        // End Initialization

        if ( $request->isMethod('post') ) {
            $data = $request->all();

            $coupen_detail = $coupen->getCoupenDetailByColumn( 'name', $data['name'] );
            
            if ( $coupen_detail ) {
                if ( $coupen_detail->expiry_date < date('Y-m-d') ) {
                    return back()->with('error', 'Coupen has been expired.');
                } else {
                    session()->put('coupen', [
                        'name' => $coupen_detail->name,
                        'discount' => $coupen->discount( $coupen_detail->name, \Cart::getTotal() ),
                    ]);

                    return back()->with('success', 'Coupen been applied.');
                }
            } else {
                return back()->with('error', 'Coupen does not exists.');
            }
        }
    }
}

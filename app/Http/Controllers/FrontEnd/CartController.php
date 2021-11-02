<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

use Cart;
use Crypt;

class CartController extends Controller
{
    private $product;
    private $dumy_image;

    public function __construct()
    {
        $this->product = new Product;
        $this->dumy_image = 'https://dummyimage.com/255x330/949494/fff';
    }

    public function addToCart( $product_id )
    {
        $product = $this->product->getProductDetail( $product_id, null );
        
        // Guest User
        $user_id = 0;

        // Get Product Single Image
        $product_single_image = $product->getProductSingleImage($product->id);
        if( isset( $product_single_image ) || !is_null( $product_single_image ) )
        {
            $product_single_image = $product_single_image->image;
        } 
        else 
        {
            $product_single_image = $this->dumy_image;
        }
        
        // add the product to cart
        Cart::add(array(
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(
                'image' => $product_single_image,
            )
        ));
        

        $cartCollection_count = Cart::getContent()->count();
        
        return $cartCollection_count;
    }

    public function addItemToCart( $product_id )
    {
        
        $product = $this->product->getProductDetail( $product_id, null );
        
        // Guest User
        $user_id = 0;

        // Get Product Single Image
        $product_single_image = $product->getProductSingleImage($product->id);
        if( isset( $product_single_image ) || !is_null( $product_single_image ) )
        {
            $product_single_image = $product_single_image->image;
        } 
        else 
        {
            $product_single_image = $this->dumy_image;
        }
        
        // add the product to cart
        Cart::add(array(
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(
                'image' => $product_single_image,
            )
        ));
        
        return redirect()->route('wishlist.view');
    }

    public function getCartList()
    {
        return view('frontend.includes.cart_list');
    }


    public function viewCartList()
    {
        return view('frontend.cart');
    }


    public function removeCartItem( $id )
    {
        try
        {
            // Initialization
                $id = decrypt($id);
            // End Initialization

            Cart::remove($id);

            return redirect('cart-view')->with('success', 'Item Has Been Successfully Removed From The Cart.');

        }
        catch (DecryptException $e)
        {
            return back()->with('error', 'Something went wrong!');
        }
    }
}

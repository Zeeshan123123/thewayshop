<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

use App\Classes\Wishlist;

use Session;
use Cart;
use Crypt;

class WishListController extends Controller
{
    private $product;
    private $dumy_image;

    public function __construct()
    {
        $this->product = new Product;
        $this->dumy_image = 'https://dummyimage.com/255x330/949494/fff';
    }

    public function addToWishList(Request $request, $product_id )
    {
        $product = $this->product->find($product_id);
        $oldWishlist = Session::has('wishlist') ? Session::get('wishlist') : null;
        $wishlist = new Wishlist($oldWishlist);
        $wishlist->add($product, $product->id);
        session()->put('wishlist', $wishlist);

        $added_wishlist = Session::get('wishlist');
        $new_added_wishlist = new Wishlist($added_wishlist);
        $count = 0;

        foreach( $new_added_wishlist->items as $item ) {
            $count++;
        }
        session()->put('wishlist_count', $count);
        
        return $count;
    }

    public function viewWishList()
    {
        // Initialization
            $data = [];
        // End Initialization

        $old_wishlist = Session::get('wishlist');
        $wishlist = new Wishlist($old_wishlist);

        if( session()->has('wishlist') ) {
            $data['wishlist'] = $wishlist->items;
        }

        // Adding cart items for comparing ids with wishlist
        $cart_ids = [];
        foreach ( \Cart::getContent() as $item ) {
            $cart_ids[] = $item->id;
        }
        $data['cart_ids'] = $cart_ids;

        return view('frontend.wishlist', $data);
    }

    public function clearWishlist()
    {
        session()->forget('wishlist');
        session()->forget('wishlist_count');

        return redirect()->route('wishlist.view');
    }
}

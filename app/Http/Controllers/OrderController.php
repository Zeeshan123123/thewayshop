<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderProduct;

use Auth;

class OrderController extends Controller
{
    private $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function index()
    {
        // Initialization
            $data = [];
        // End Initialization

        $data['orders'] = $this->order->getOrdersList();

        return view('backend.orders.manage_orders', $data);
    }

    public function store(Request $request)
    {
        // Initializaion
        $order = new Order();
        $order_product = new OrderProduct();
        $cartItems = \Cart::getContent();
        // End initializaion

        // Saving order data
        $order->order_number = uniqid('AA-');
        $order->user_id = ((Auth::user()) ? Auth::user()->id : NULL);
        $order->billing_first_name = $request->input('first_name');
        $order->billing_last_name = $request->input('last_name');
        $order->billing_email = $request->input('email');
        $order->billing_country = $request->input('country');
        $order->billing_state = $request->input('state');
        $order->billing_post_code = $request->input('zip');

        if ( session()->has('coupen') ) {
            $order->grand_total = \Cart::getTotal() - session()->get('coupen')['discount'];
        }
        else {
            $order->grand_total = \Cart::getTotal();
        }


        $order->save();
        // End saving order data

        // Saving order products data
        if ( $order->id ) {
            foreach($cartItems as $item) {
                $order_product->order_id = $order->id;
                $order_product->product_id = $item->id;
                $order_product->price = $item->price;

                $order_product->save();
            }

        }
        // End saving order products data

        // Redirecting to paypal route if customer's selected payment type is paypal
        if (request('payment_method') == 'paypal') {

            return redirect()->route('paypal.checkout', $order->id);

        }

        // Clearing cart after checkout
        \Cart::clear();

        // Clearing coupen after checkout
        session()->forget('coupen');

        return redirect()->route('order.complete', $order->id)->withMessage('Order has been placed');
    }

    public function getOrderComplete( $order )
    {

        // Initialization
            $data = [];
        // End Initialization

        $data['order'] = Order::where('id', $order)->first();

        return view('frontend.order_complete', $data);
    }
}

<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


// Start: Paypal Detail Classes
use App\Services\PaypalService;
// End: Paypal Detail Classes

// use Illuminate\Support\Facades\Mail;
// use App\Mail\OrderPaid;

use App\Models\Order;
use App\Models\ProductCode;
use App\Notifications\InvoicePaid;


class CheckoutController extends Controller
{
    private $paypalService, $product_code;

    function __construct(PaypalService $paypalService){

        $this->paypalService = $paypalService;
        // $this->product_code = $product_code;
    }

    public function viewCheckout()
    {
        return view('frontend.checkout');
    }

    public function getExpressCheckout($orderId)
    {

        $response = $this->paypalService->createOrder($orderId);

        if($response->statusCode !== 201) {
            abort(500);
        }

        $order = Order::find($orderId);
        $order->payment_method = 'paypal';
        $order->payment_id = $response->result->id;
        $order->save();

        foreach ($response->result->links as $link) {
            if($link->rel == 'approve') {
                return redirect($link->href);
            }
        }

    }



    public function cancelPage()
    {
        dd('payment failed');
    }


    public function getExpressCheckoutSuccess(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        $response = $this->paypalService->captureOrder($order->payment_id);

        if ($response->result->status == 'COMPLETED') {
            $order->is_paid = 1;
            $order->save();
            
            $order->notify(new InvoicePaid($order));

            /*foreach( \Cart::getContent() as $product ) {
                if ( $product->id ) {
                    $this->product_code->where( 'code', $product->code )->update([ 'status' => 'Sold' ]);
                }
            }*/

            \Cart::clear();

            // Mail::to($order->user->email)->send(new OrderPaid($order));
            return redirect()->route('order.complete', $order->id)->withMessage('Payment successful!');

        }

        return redirect()->route('checkout.view')->withError('Payment UnSuccessful! Something went wrong!');


    }
    // End: Payment Method Pay With Paypal

}

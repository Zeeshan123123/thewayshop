@extends('frontend.master')

@section('styles')
    <style>
       .invoice-link {
            font-weight: 700;
            color: #378bf2;
            font-size: 18px;
       }
    </style>
@endsection

@section('content')

<!-- Start Checkout  -->
    <div class="cart-box-main">
        <div class="container">

            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Thank you, Your order has been placed with Order No: {{ $order->order_number }} successfully!</h3>
                            <a href="{{ route('invoice.order',['order_number'=>$order->order_number]) }}" target="_blank" class="invoice-link">View your order invoice</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Checkout -->
@endsection

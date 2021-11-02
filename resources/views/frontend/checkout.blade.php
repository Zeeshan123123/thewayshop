<?php 
    $grand_total = 0;
    $coupen_discount = 0;
    if ( \Cart::getTotal() > 0 ) {
        if ( session()->has('coupen') && session()->get('coupen')['discount']  ) {
            $grand_total = \Cart::getTotal() - session()->get('coupen')['discount'];
            $coupen_discount = session()->get('coupen')['discount'];
        } else {
            $grand_total = \Cart::getTotal();
        }
    }
    
?>

@php
    currencyLoad();
    $currency_code = session('currency_code');
    $currency_symbol = session('currency_symbol');

    if ( $currency_symbol == "" ) {
        $system_default_currency_info = session('system_default_currency_info');
        $currency_symbol = $system_default_currency_info->currency_symbol;
        $currency_code = $system_default_currency_info->currency_code;
    }

    $product = new \App\Models\Product;
@endphp

@extends('frontend.master')

@section('content')

<!-- Start Checkout  -->
    <div class="cart-box-main">
        <div class="container">
            
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                        <form class="needs-validation" method="post" action="{{ route('order.store') }}" novalidate>

                            @csrf

                            <div class="row">
                                
                                <div class="col-md-6 mb-3">
                                    @php ($name = 'first_name')
                                    <label for="firstName">{{ ucfirst(str_replace('_', ' ', $name)) }} *</label>
                                    <input type="text" name="{{ $name }}" class="form-control" id="{{ $name }}" placeholder="{{ucfirst(str_replace('_', ' ', $name))}}" value="" required>
                                    <div class="invalid-feedback"> Valid {{str_replace('_', ' ', $name)}} is required. </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    @php ($name = 'last_name')
                                    <label for="{{ $name }}">{{ucfirst(str_replace('_', ' ', $name))}} *</label>
                                    <input type="text" name="{{ $name }}" class="form-control" id="{{ $name }}" placeholder="{{ucfirst( str_replace( '_', ' ', $name ) ) }}" value="" required>
                                    <div class="invalid-feedback"> Valid {{str_replace('_', ' ', $name)}} is required. </div>
                                </div>
                            </div>

                            {{-- 
                            <div class="mb-3">
                                @php ($name = 'username')
                                <label for="username">{{ ucfirst(str_replace( '_', ' ', $name )) }} *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="{{ $name }}" placeholder="{{ucfirst( str_replace( '_', ' ', $name ) ) }}" required>
                                    <div class="invalid-feedback" style="width: 100%;"> Your {{str_replace('_', ' ', $name)}} is required. </div>
                                </div>
                            </div> 
                            --}}

                            <div class="mb-3">
                                @php ($name = 'email')
                                <label for="{{ $name }}">{{ ucfirst(str_replace( '_', ' ', $name )) }} *</label>
                                <input type="email" name="{{ $name }}" class="form-control" id="{{ $name }}" placeholder="{{ucfirst( str_replace( '_', ' ', $name ) ) }}">
                                <div class="invalid-feedback"> Please enter a valid {{str_replace('_', ' ', $name)}} for shipping updates. </div>
                            </div>
                            
                            {{--  
                            <div class="mb-3">
                                @php ($name = 'address')
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" id="address" placeholder="" required>
                                <div class="invalid-feedback"> Please enter your {{str_replace('_', ' ', $name)}}. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address2">Address 2 *</label>
                                <input type="text" class="form-control" id="address2" placeholder=""> 
                            </div>
                            --}}

                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    @php ($name = 'country')
                                    <label for="{{ $name }}">{{ ucfirst(str_replace( '_', ' ', $name )) }} *</label>
                                    <select class="wide w-100" name="{{ $name }}" id="{{ $name }}">
									<option value="Choose..." data-display="Select">Choose...</option>
									<option value="United States">United States</option>
								</select>
                                    <div class="invalid-feedback"> Please select a valid {{str_replace('_', ' ', $name)}}. </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    @php ($name = 'state')
                                    <label for="{{ $name }}">State *</label>
                                    <select name="{{ $name }}" class="wide w-100" id="{{ $name }}">
									<option data-display="Select">Choose...</option>
									<option>California</option>
								</select>
                                    <div class="invalid-feedback"> Please provide a valid {{str_replace('_', ' ', $name)}}. </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    @php ($name = 'zip')
                                    <label for="{{ $name }}">Zip *</label>
                                    <input type="text" name="{{ $name }}" class="form-control" id="zip" placeholder="{{ ucfirst(str_replace( '_', ' ', $name )) }}" required>
                                    <div class="invalid-feedback"> {{str_replace('_', ' ', $name)}} required. </div>
                                </div>
                            </div>
                            
                            {{--                             
                            <hr class="mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="same-address">
                                <label class="custom-control-label" for="same-address">{{str_replace('_', ' ', $name)}} is the same as my billing address</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="save-info">
                                <label class="custom-control-label" for="save-info">Save this information for next time</label>
                            </div> 
                            --}}

                            <hr class="mb-4">
                            <div class="title"> <span>Payment</span> </div>
                            <div class="d-block my-3">
                                {{-- 
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="credit">Credit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="debit">Debit card</label>
                                </div>
                                 --}}
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="payment_method" type="radio" class="custom-control-input" required checked="checked" value="paypal">
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>

                            <hr class="mb-1"> 

                            <div class="col-16 d-flex shopping-box"> 
                                <button type="submit"  class="mt-5 ml-auto btn hvr-hover w-50">Place Order</button> 
                            </div>
                        </form>
                    

                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        
                        
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
                                    @foreach( \Cart::getContent() as $product )
                                    <div class="media mb-2 border-bottom">
                                        <div class="media-body"> <a href="detail.html"> {{ $product->name }} </a>
                                            <div class="small text-muted">Price: ${{ number_format( $product->price,2 ) }} 


                                            <span class="mx-2">|</span> 
                                            Subtotal: {{ $currency_symbol }}{{ number_format( $product->price,2 ) }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold"> {{ $currency_symbol }}{{ number_format(\Cart::getTotal()) }} </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Coupon Discount</h4>
                                    <div class="ml-auto font-weight-bold"> {{ $currency_symbol }}{{ number_format($coupen_discount) }} </div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5"> {{ $currency_symbol }}{{ number_format($grand_total) }} </div>
                                </div>
                                <hr> </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Checkout -->
@endsection
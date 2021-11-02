@php
    currencyLoad();
    $currency_code = session('currency_code');
    $currency_symbol = session('currency_symbol');

    if ( $currency_symbol == "" ) {
        $system_default_currency_info = session('system_default_currency_info');
        $currency_symbol = $system_default_currency_info->currency_symbol;
        $currency_code = $system_default_currency_info->currency_code;
    }
@endphp

@extends('frontend.master')

@section('styles')
<style>
    .error {
        color: red;
        background-color: #f2d2a4;
    }

    .success {
        color: green;
        background-color: #c6f8d2;
    }

    .closebtn {
        color: black;
        font-size: 3rem;
        font-weight: 500;
        margin-top: -30px;
        cursor: pointer;
    }
</style>
@endsection

@section('content')

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Cart</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
                <div id="scroll-window"></div>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->


 <!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('error'))
                    <div class="border error p-3">
                        <span class="closebtn ml-2 float-right" onclick="this.parentElement.style.display='none';">&times;</span>
                        <strong>Danger!</strong> {{ session()->get('error') }}
                    </div>
                @elseif(session()->has('success'))
                    <div class="border success p-3" >
                        <span class="closebtn ml-2 float-right" onclick="this.parentElement.style.display='none';">&times;</span>
                        <strong>Congrats!</strong> {{ session()->get('success') }}
                    </div>
                @endif
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                {{-- <th>Quantity</th> --}}
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( \Cart::getContent() as $product )
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="#">
                                        <img class="img-fluid" src="{{ getImage($product->attributes->image) }}" alt="" />
                                    </a>
                                </td>
                                <td class="name-pr">
                                    <a href="#">
                                {{ $product->name }}
                            </a>
                                </td>
                                <td class="price-pr">
                                    <p>{{ $currency_symbol }}{{ $product->price }}</p>
                                </td>
                                {{-- <td class="quantity-box"><input type="number" size="4" value="1" min="0" step="1" class="c-input-text qty text"></td> --}}
                                <td class="total-pr">
                                    <p>{{ $currency_symbol }}{{ $product->price }}</p>
                                </td>
                                <td class="remove-pr">
                                    <a href="{{ route('cart.remove.item',["id"=>Crypt::encrypt($product->id)]) }}">
                                <i class="fas fa-times"></i>
                            </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-6 col-sm-6">
                <div class="coupon-box">
                    <form action="{{ route('apply.coupen') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-sm">
                            <input name="name" class="form-control" placeholder="Enter your coupon" aria-label="Coupon name" type="text">
                            <div class="input-group-append">
                                <button class="btn btn-theme" type="submit">Apply Coupon</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                {{-- <div class="update-box">
                    <input value="Update Cart" type="submit">
                </div> --}}
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-8 col-sm-12"></div>
            <div class="col-lg-4 col-sm-12">
                <div class="order-box">
                    <h3>Order summary</h3>
                    <div class="d-flex">
                        <h4>Sub Total</h4>
                        <div class="ml-auto font-weight-bold">  {{ $currency_symbol }}{{ number_format(\Cart::getTotal()) }} </div>
                    </div>

                    <div class="d-flex">
                        <h4>Coupon Discount</h4>
                        <div class="ml-auto font-weight-bold">  {{ $currency_symbol }}{{ ( session()->get('coupen') )? number_format( session()->get('coupen')['discount'] ) : 0 }} </div>
                    </div>

                    {{-- <div class="d-flex">
                        <h4>Discount</h4>
                        <div class="ml-auto font-weight-bold"> $ 0 </div>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex">
                        <h4>Tax</h4>
                        <div class="ml-auto font-weight-bold"> $ 0 </div>
                    </div>
                    <div class="d-flex">
                        <h4>Shipping Cost</h4>
                        <div class="ml-auto font-weight-bold"> Free </div>
                    </div> --}}
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        @if( session()->get('coupen') && session()->get('coupen')['discount'] )
                            <div class="ml-auto h5"> {{ $currency_symbol }}{{ number_format(\Cart::getTotal() - session()->get('coupen')['discount'] ) }} </div>
                        @else
                            <div class="ml-auto h5"> {{ $currency_symbol }}{{ number_format(\Cart::getTotal() ) }} </div>
                        @endif
                    </div>
                    <hr> </div>
            </div>
            <div class="col-12 d-flex shopping-box"><a href="{{ route('checkout.view') }}" class="ml-auto btn hvr-hover">Checkout</a> </div>
        </div>

    </div>
</div>
<!-- End Cart -->
@endsection


@if( session()->has('error') || session()->has('success') )
<script>
    window.location.href = window.location.href + "#scroll-window";
</script>
@endif
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
                <h2>{{__('lang.Favourites')}}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{__('lang.Shop')}}</a></li>
                    <li class="breadcrumb-item active">{{__('lang.Favourites')}}</li>
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

        @if(isset($wishlist)) 
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
                                    {{-- <th>Images</th> --}}
                                    <th>Product Name</th>
                                    <th>Short Description</th>
                                    <th>Price</th>
                                    {{-- <th>Quantity</th> 
                                    <th>Remove</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach( $wishlist as $product )

                                <tr>
                                    {{-- <td class="thumbnail-img">
                                        <a href="#">
                                            <img class="img-fluid" src="{{ getImage($product->attributes->image) }}" alt="" />
                                        </a>
                                    </td> --}}
                                    <td class="name-pr">
                                        <a href="#">
                                            {{ $product['item']->title }}
                                        </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
                                            {!! $product['item']->short_description !!}
                                        </a>
                                    </td>
                                    <td class="price-pr">
                                        <p>{{ $currency_symbol }}{{ $product['item']->price }}</p>
                                    </td>
                                    {{-- <td class="quantity-box"><input type="number" size="4" value="1" min="0" step="1" class="c-input-text qty text"></td> --}}
                                    {{-- <td class="remove-pr">
                                        <a href="{{ route('cart.remove.item',["id"=>Crypt::encrypt($product['item']->id)]) }}">
                                        <i class="fas fa-times"></i>
                                        </a>
                                    </td> --}}
                                    <td>
                                        @if(in_array($product['item']->id,$cart_ids ))
                                            <a href="#" class="ml-auto btn hvr-hover text-white">{{__('lang.Added To Cart')}}</a>
                                        @else
                                            <a href="{{ route('cart.add_item',["product_id"=>$product['item']->id]) }}" class="ml-auto btn hvr-hover text-white">{{__('lang.Add To Cart')}}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex shopping-box"><a href="{{ route('wishlist.clear') }}" class="ml-auto btn hvr-hover">Clear Favourites</a> </div>
        @else  
            <h2><strong>{{__('lang.No Favourites Found')}}...</strong></h2>
        @endif
    </div>
</div>
<!-- End Cart -->
@endsection


@if( session()->has('error') || session()->has('success') )
<script>
    window.location.href = window.location.href + "#scroll-window";
</script>
@endif
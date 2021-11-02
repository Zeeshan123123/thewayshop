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

@section('content')

<!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            
                            @foreach( $product_detail->images as $image )
                                <div class="carousel-item {{ $loop->first?'active':'' }} "> <img class="d-block w-100" src="{{ getImage($image->image) }}" > </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span> 
					</a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
						<i class="fa fa-angle-right" aria-hidden="true"></i> 
						<span class="sr-only">Next</span> 
					</a>
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                                <img class="d-block w-100 img-fluid" src="images/smp-img-01.jpg" alt="" />
                            </li>
                            <li data-target="#carousel-example-1" data-slide-to="1">
                                <img class="d-block w-100 img-fluid" src="images/smp-img-02.jpg" alt="" />
                            </li>
                            <li data-target="#carousel-example-1" data-slide-to="2">
                                <img class="d-block w-100 img-fluid" src="images/smp-img-03.jpg" alt="" />
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{{ $product_detail->title }}</h2>
                        <h5> {{ $currency_symbol }}{{ number_format($product_detail->price) }}</h5>
                        <p class="available-stock">
                            <p>
                                <h4>Short Description:</h4>
                                <p>{!! $product_detail->short_description !!}</p>
                                

                                <div class="price-box-bar">
                                    <div class="cart-and-bay-btn">
                                        @if(\Cart::get($product_detail->id))
                                        <a class="btn hvr-hover" data-fancybox-close="" href="{{ route('cart.view') }}">Already added, View cart</a>
                                        @else
                                        <a class="btn hvr-hover" data-fancybox-close="" href="#" onclick="addToCart('{{ $product_detail->id }}')">Add to cart</a>
                                        @endif
                                    </div>
                                </div>

                                <div class="add-to-btn">
                                    <div class="share-bar">
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>

            

        </div>
    </div>
    <!-- End Cart -->

@endsection
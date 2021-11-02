<?php
$category = new \App\Models\Category;
$subcategory = new \App\Models\SubCategory;
$currency = new \App\Models\Currency;
?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>{{ config('app.name') }}</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/apple-touch-icon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <!-- Dark Mode Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark-mode.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Flag Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css" rel="stylesheet">

    @yield('styles')

</head>

<body>

<!-- Start Main Top -->
<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker">
                        <ul class="offer-box">
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                <div class="custom-select-box">
                    <select id="basic" class="selectpicker show-tick form-control currency-change" data-placeholder="{{ $currency_symbol }} {{ $currency_code }}" >
                        @foreach( $currency->getCurrenciesList('active') as $currency )
                            <option value="{{ $currency->currency_code }}" {{ $currency_symbol == $currency->currency_symbol ? 'selected' : ''}}>{{ $currency->currency_symbol }} {{ strtoupper($currency->currency_code) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="right-phone-box">
                    <p>Call US :- <a href="#"> +11 900 800 100</a></p>
                </div>
                <div class="our-link">
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Our location</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Top -->

<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="{{ route('home') }}">{{ __('lang.Home') }}</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li> --}}
                    <li class="dropdown megamenu-fw">
                        <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">{{ __('lang.Product') }}</a>
                        <ul class="dropdown-menu megamenu-content" role="menu">
                            <li>
                                <div class="row">
                                    @foreach( $category->getCategoriesList( 'active' ) as $category )
                                        <div class="col-menu col-md-3">
                                            <h6 class="title">{{ $category->title }}</h6>
                                            <div class="content">
                                                <ul class="menu-col">
                                                    <?php
                                                        $subcategories = $subcategory->getSubCategoryByCategory( $category->id );
                                                    ?>
                                                    @foreach( $subcategories as $subcategory )
                                                        <li><a href="#">{{ $subcategory->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- end col-3 -->
                                </div>
                                <!-- end row -->
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('frontend.products') }}" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">{{ __('lang.Shop') }}</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('cart.view') }}">{{__('lang.Cart')}}</a></li>
                            <li><a href="{{ route('wishlist.view') }}">{{__('lang.Favourites')}}</a></li>
                            <li><a href="{{ route('checkout.view') }}">{{__('lang.Checkout')}}</a></li>
                            <li><a href="my-account.html">My Account</a></li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item"><a class="nav-link" href="service.html">Our Service</a></li> --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route('contactUs') }}">{{ __('lang.Contact') }}</a></li>
                    @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">{{ __('lang.Dashboard') }}</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('lang.Login') }}</a></li>
                    @endauth
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    <li class="">
                        <a href="{{ route('cart.view') }}">
                            <i class="fa fa-shopping-bag"></i>
                            <span class="badge" id="cart-count">{{ \Cart::getContent()->count() }}</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('wishlist.view') }}">
                            @if( session()->has('wishlist_count') )
                                <span style="color: red;" title="{{ __('lang.Favourites') }}">
                                    <i class="fa fa-heart"></i>
                                    <span class="badge" id="favourites-count">{{ session()->get('wishlist_count') }}</span>
                                </span>
                            @else
                                <span class="red-color">
                                    <i class="fa fa-heart"></i>
                                    <span class="badge" id="favourites-count">0</span>
                                </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
            <div class="dark-mode ml-5">
                <label class="custom-switch">
                    <input type="checkbox" class="primary" id="darkSwitch">
                    <span class="custom-switch-toggle round"></span>
                </label>
            </div>

            <ul>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> {{ Config::get('languages')[App::getLocale()]['display'] }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                                <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span> {{$language['display']}}</a>
                        @endif
                    @endforeach
                    </div>
                </li>
            </ul>
        </div>
        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                {{-- <div id="updateDiv"></div> --}}
                @include('frontend.includes.cart_list')
            </li>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
<!-- End Top Search -->
@yield('content')
<!-- Start Footer  -->
<footer>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-widget">
                        <h4>About ThewayShop</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link">
                        <h4>Information</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Customer Service</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                            <li><a href="{{ route('frontend.blogs') }}">Blogs</a></li>
                            <li><a href="{{ route('termsAndConditions') }}">Terms &amp; Conditions</a></li>
                            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('faqs') }}">Faqs</a></li>
                            <li><a href="#">Delivery Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link-contact">
                        <h4>Contact Us</h4>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Address: Michael I. Days 3756 <br>Preston Street Wichita,<br> KS 67213 </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer  -->
<!-- Start copyright  -->
<div class="footer-copyright">
    <p class="footer-company">All Rights Reserved. &copy; 2018 <a href="#">ThewayShop</a> Design By :
        <a href="https://html.design/">html design</a></p>
</div>
<!-- End copyright  -->

<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

<!-- ALL JS FILES -->
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- ALL PLUGINS -->
<script src="{{ asset('assets/js/jquery.superslides.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('assets/js/inewsticker.js') }}"></script>
<script src="{{ asset('assets/js/bootsnav.js') }}"></script>
<script src="{{ asset('assets/js/images-loded.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/baguetteBox.min.js') }}"></script>
<script src="{{ asset('assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('assets/js/contact-form-script.js') }}"></script>
<script src="{{ asset('assets/js/dark-mode-switch.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
@yield('scripts')

{{-- Start: Custom Page Scripts --}}
<script>

    function addToCart( product_id ) {
        event.preventDefault();
        var route = '/ajax/add-to-cart/'+product_id;

        $.get(route,function(cart_count)
        {
            $('#cart-count').text(cart_count);
        });
    }

    function addToWishList( product_id ) {
        event.preventDefault();
        var route = '/ajax/add-to-wishlist/'+product_id;

        $.get(route,function(wishlist_count)
        {
            $('#favourites-count').text(wishlist_count);
            $('.red-color').css('color', 'red');
        });
    }
</script>

<script>
    function getCartList() {
        /*$.ajax({
          type: 'get',
          dataType: 'html',
          url: '/ajax/get-cart-list',
          data: "",
          success: function ( response ) {
            $('#updateDiv').html(response);
          }
        });*/
    }
</script>

<script>
    $(".currency-change").change(function(){
        var currency_code = $(this).children("option:selected").val();
        
        $.ajax({
            type: 'POST',
            url: '{{ route('currency.load') }}',
            data: {
                currency_code:currency_code,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                if ( response['status'] ) {
                    location.reload();
                }
                else {
                    alert('server error');
                }
            }
        });
    });
</script>
{{-- End: Custom Page Scripts --}}
</body>
</html>

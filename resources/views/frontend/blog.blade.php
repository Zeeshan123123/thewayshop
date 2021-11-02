@extends('frontend.master')

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Blogs</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blogs</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <!-- Blog Listing Start -->
    <div class="container pt-5">
        <div class="row">
            @foreach($data as $item)
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img src="https://dummyimage.com/600x400/64ba3c/1e1f33.jpg" class="img-fluid" alt="test">
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt text-info" aria-hidden="true"></i> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d M Y') }}
                                </small>
                                <h3>{{ \Illuminate\Support\Str::ucfirst($item->title) }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit($item->description, 200) }}</p>
                                <a href="" class="btn btn-info mt-3">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Blog Listing End -->
@endsection

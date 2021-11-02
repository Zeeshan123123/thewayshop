@extends('frontend.master')

@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>FAQS</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">FAQS</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <!-- Start Terms Page  -->
    <section class="py-5">
        <div class="container">
            <div class="accordion" id="accordion1">
                <div class="card">
                    <div class="card-header" id="heading1">
                        <h2 class="mb-0">
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse1">
                                <i class="fa fa-plus mr-2"> What is HTML?</i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordion1">
                        <div class="card-body">
                            <p>HTML stands for HyperText Markup Language. HTML is the standard markup language for describing the structure of web pages. </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading2">
                        <h2 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse2">
                                <i class="fa fa-plus mr-2"> What is Bootstrap?</i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#accordion1">
                        <div class="card-body">
                            <p>HTML stands for HyperText Markup Language. HTML is the standard markup language for describing the structure of web pages. </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="heading3">
                        <h2 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse3">
                                <i class="fa fa-plus mr-2"> What is Bootstrap?</i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion1">
                        <div class="card-body">
                            <p>HTML stands for HyperText Markup Language. HTML is the standard markup language for describing the structure of web pages. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Terms Page  -->
@endsection

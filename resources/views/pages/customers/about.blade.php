@extends('layouts.frontend.mainFrontend')
@section('content')
    <section class="bg-success py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-white">
                    <h1>About Us</h1>
                    <p>
                       Ex fames nam molestie purus proin ligula turpis vehicula per. Urna dapibus facilisis tincidunt fusce sagittis praesent
                    fames cras mattis. Faucibus dictumst vehicula ipsum viverra torquent tellus at himenaeos. Porttitor libero dignissim
                    volutpat parturient ac facilisis fringilla dictumst. Condimentum urna cubilia mauris arcu nascetur.
                    </p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/img/ticket.jpg') }}" alt="About us" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>
    <!-- Close Banner -->
    
    <!-- Start Section -->
    <section class="container py-5">
        <div class="row text-center pt-5 pb-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Our Services</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    Lorem ipsum dolor sit amet.
                </p>
            </div>
        </div>
        <div class="row">
    
            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fas fa-plane fa-lg"></i></div>
                    <h2 class="h5 mt-4 text-center">Delivery Services</h2>
                </div>
            </div>
    
            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fas fa-exchange-alt"></i></div>
                    <h2 class="h5 mt-4 text-center">Shipping & Return</h2>
                </div>
            </div>
    
            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-percent"></i></div>
                    <h2 class="h5 mt-4 text-center">Promotion</h2>
                </div>
            </div>
    
            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-user"></i></div>
                    <h2 class="h5 mt-4 text-center">24 Hours Service</h2>
                </div>
            </div>
        </div>
    </section>
@endsection
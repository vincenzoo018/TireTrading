@extends('layouts.app')

@section('content')
<!-- Services Header -->
<section class="py-5 bg-light">
    <div class="container">
        <h1 class="section-title">Our Services</h1>
        <p class="lead">Professional automotive services to keep your vehicle in top condition</p>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card service-card text-center">
                    <div class="card-body">
                        <div class="service-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h5 class="card-title">Wheel Alignment</h5>
                        <p class="card-text">Precision alignment for better handling and extended tire life.</p>
                        <p class="price">Starting at P800</p>
                        <a href="{{ route('customer.booking') }}" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card service-card text-center">
                    <div class="card-body">
                        <div class="service-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h5 class="card-title">Tire Replacement</h5>
                        <p class="card-text">Professional tire mounting and balancing services.</p>
                        <p class="price">Starting at P200</p>
                        <a href="{{ route('customer.booking') }}" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card service-card text-center">
                    <div class="card-body">
                        <div class="service-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <h5 class="card-title">Brake Service</h5>
                        <p class="card-text">Complete brake inspection and repair services.</p>
                        <p class="price">Starting at P1,200</p>
                        <a href="{{ route('customer.booking') }}" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card service-card text-center">
                    <div class="card-body">
                        <div class="service-icon">
                            <i class="fas fa-oil-can"></i>
                        </div>
                        <h5 class="card-title">Oil Change</h5>
                        <p class="card-text">Quick and efficient oil change with quality lubricants.</p>
                        <p class="price">Starting at P500</p>
                        <a href="{{ route('customer.booking') }}" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card service-card text-center">
                    <div class="card-body">
                        <div class="service-icon">
                            <i class="fas fa-battery-full"></i>
                        </div>
                        <h5 class="card-title">Battery Replacement</h5>
                        <p class="card-text">Professional battery testing and replacement services.</p>
                        <p class="price">Starting at P2,500</p>
                        <a href="{{ route('customer.booking') }}" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card service-card text-center">
                    <div class="card-body">
                        <div class="service-icon">
                            <i class="fas fa-filter"></i>
                        </div>
                        <h5 class="card-title">Filter Replacement</h5>
                        <p class="card-text">Air, oil, and cabin filter replacement services.</p>
                        <p class="price">Starting at P300</p>
                        <a href="{{ route('customer.booking') }}" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center">Why Choose Our Services?</h2>
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div class="feature-icon mb-3">
                    <i class="fas fa-certificate fa-3x text-primary"></i>
                </div>
                <h5>Certified Technicians</h5>
                <p>Our team consists of certified and experienced automotive technicians.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="feature-icon mb-3">
                    <i class="fas fa-tools fa-3x text-primary"></i>
                </div>
                <h5>Quality Equipment</h5>
                <p>We use state-of-the-art equipment for all our services.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="feature-icon mb-3">
                    <i class="fas fa-shield-alt fa-3x text-primary"></i>
                </div>
                <h5>Warranty Included</h5>
                <p>All our services come with a comprehensive warranty.</p>
            </div>
        </div>
    </div>
</section>
@endsection
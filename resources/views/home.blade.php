@extends('layouts.admin')

@section('content-header', 'Dashboard')

@section('content')
<style>
    .main {
        transition: 0.5s;
    }

    .main:hover {
        transform: 1.5s;
        transform: translateY(-15px);
    }

    .form-control {
        border-radius: 0;
    }

</style>
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-4 col-6 main">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{$product}}</h3>
                    <p>Total Products</p>
                    <div class="icon">
                        <i class="fas fa-dolly-flatbed"></i>
                    </div>
                    <a href="{{route('products.index')}}" class=" text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6 main">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $transactions }}</h3>
                    <p>Total invoice</p>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a href="{{route('transaction.index')}}" class=" text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6 main">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner text-white">
                    <h3>{{config('settings.currency_symbol')}} {{ $total_income,2 }}</h3>
                    <p class="text-white">Total Sale</p>
                    <div class="icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <a href="{{route('transaction.index')}}" class=" text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>
        </div>
        <!-- ./col -->


    </div>

    <div class="row">
        <div class="col-lg-4 col-6 main">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{config('settings.currency_symbol')}} {{ $total_paid,2 }}</h3>

                    <p>Total Paid</p>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="{{route('transaction.index')}}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6 main">
            <!-- small box -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3 class="text-white">{{config('settings.currency_symbol')}} {{ $total_due,2 }}</h3>

                    <p class="text-white">Total Due</p>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="{{route('transaction.index')}}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-4 col-6 main">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $customers }}</h3>

                    <p>Total Customers</p>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('customers.index') }}" class="text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
</div>
@endsection

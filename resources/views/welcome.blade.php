@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-primary py-7 py-lg-12">
    <div class="container">
        <div class="header-body text-center mt-7 mb-12">
            <div class="row justify-content-center">'
            <img src="{{ asset('images') }}/bpbd.jpg" alt="Bupati HSS" class="rounded-circle img-fluid img-thumbnail" width="80px">  
                <div class="col-lg-5 col-md-6">
                    <h1 class="text-white">{{ config('tagtexts.welcome_massage') }}</h1>
                </div>
                <img src="{{ asset('images') }}/tabalong.png" alt="Wakil Bupati HSS" class="rounded-circle img-fluid img-thumbnail" width="80px">
                @include('layouts.headers.cards')
            </div>

        </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</div>

<div class="container mt--10 pb-5"></div>
@endsection

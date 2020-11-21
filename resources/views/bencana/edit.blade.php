@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your Edit page. You can Update data here with late information data'),
        'class' => 'col-lg-12' ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">{{ __('Connect') }}</a>
                            <a href="#" class="btn btn-sm btn-default float-right">{{ __('Message') }}</a>
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">{{ __('Friends') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">{{ __('Photos') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">{{ __('Comments') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ auth()->user()->name }}<span class="font-weight-light">, 27</span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ __('Bucharest, Romania') }}
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{ __('Solution Manager - Creative Tim Officer') }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{ __('University of Computer Science') }}
                            </div>
                            <hr class="my-4" />
                            <p>{{ __('Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.') }}</p>
                            <a href="#">{{ __('Show more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Edit Data Bencana') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/bencana/{{$bencana->id}}/update" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('post')  
                            @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif 
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name_bencana') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nama Bencana') }}</label>
                                    <input type="text" name="nama_bencana" id="nama_bencana" class="form-control form-control-alternative{{ $errors->has('name_bencana') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{$bencana->nama_bencana}}" required autofocus>

                                    @if ($errors->has('nama_bencana'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama_bencana') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{$errors->has('jenis_bencana') ? ' has-error' : ''}}"> 
                                    <label for="exampleFormControlSelect1">Jenis Bencana</label>
                                    <select name="jenis_bencana" class="form-control" id="jenis_bencana">
                                        <option value="Banjir" @if($bencana->jenis_bencana == 'Banjir') selected @endif>Banjir</option>
                                        <option value="Kebakaran" @if($bencana->jenis_bencana == 'Kebakaran') selected @endif>Kebakaran</option>
                                        <option value="Gempa" @if($bencana->jenis_bencana == 'Gempa') selected @endif>Gempa</option>
                                        <option value="Puting Beliung" @if($bencana->jenis_bencana == 'Puting Beliung') selected @endif>Puting Beliung</option> 
                                        <option value="Longsor" @if($bencana->jenis_bencana == 'Longsor') selected @endif>Longsor</option>
                                        <option value="Wabah"  @if($bencana->jenis_bencana == 'Wabah') selected @endif>Wabah</option> 
                                    </select>
                                    @if($errors->has('jenis_bencana'))
                                    <!-- form validation -->    <span class="help-block">{{$errors->first('jenis_bencana')}}</span>
                                    @endif
                                </div>  
                                <div class="form-group">
                                    <label for="lokasi_bencana">Lokasi Bencana</label>
                                    <textarea name="lokasi_bencana" class="form-control" id="lokasi_bencana" placeholder="Alamat" rows="3">{{$bencana->lokasi_bencana}}</textarea> 
                                </div>  
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div> 
        @include('layouts.footers.auth') 
    </div> 
@endsection
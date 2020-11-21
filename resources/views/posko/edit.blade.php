@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->name,
'description' => __('Selamat Datang Di Sistem Informasi Distribusi Bantuan Logistik Bencana Alam !'),
'class' => 'col-lg-12' ])   

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{$posko->getAvatar()}}" class="rounded-circle">
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
                            {{ $posko->nama_posko }}<span class="font-weight-light">, {{$posko->jenis_posko}}</span>
                        </h3>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{$posko->lokasi_posko}}
                        </div>
                        <div class="h5 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>Tanggal Didirikan :  {{$posko->created_at->diffforhumans()}} | {{$posko->created_at->format('d M Y')}}
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="col-12 mb-0">{{ __('Edit Data Posko') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="/posko/{{$posko->id}}/update" enctype="multipart/form-data" autocomplete="off">
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
                            <div class="form-group{{ $errors->has('nama_posko') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Nama Posko') }}</label>
                                <input type="text" name="nama_posko" id="nama_posko" class="form-control form-control-alternative{{ $errors->has('nama_posko') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{$posko->nama_posko}}" required autofocus> 

                                @if ($errors->has('nama_posko'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama_posko') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{$errors->has('jenis_posko') ? ' has-error' : ''}}"> 
                                <label for="exampleFormControlSelect1">Jenis Posko</label>
                                <select name="jenis_posko" class="form-control" id="jenis_posko">
                                    <option value="Posko Bantuan" @if($posko->jenis_posko == 'Posko Bantuan') selected @endif>Posko Bantuan</option>
                                    <option value="Posko Pengungsi" @if($posko->jenis_posko == 'Posko Pengungsi') selected @endif>Posko Pengungsi</option> 
                                </select>
                                @if($errors->has('jenis_posko'))
                                <!-- form validation -->    <span class="help-block">{{$errors->first('jenis_posko')}}</span>
                                @endif
                            </div>   
                            <div class="form-group">
                                <label for="lokasi_posko">Lokasi Posko</label>
                                <textarea name="lokasi_posko" class="form-control" id="lokasi_posko" placeholder="Alamat" rows="3">{{$posko->lokasi_posko}}</textarea> 
                            </div>
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file" name="avatar" class="form-control" id="avatar" placeholder="Avatar" rows="3">{{$posko->avatar}}</textarea> 
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
    @endsection
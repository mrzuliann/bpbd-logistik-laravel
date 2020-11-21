@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('Selamat Datang Di Sistem Informasi Distribusi Bantuan Logistik Bencana Alam !'),
        'class' => 'col-lg-12' ])   
    <div class="container-fluid mt--7">
        <div class="row"> 
        </div>
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">  
                                <h3 class="mb-0">Data Posko</h3>
                            </div>
                            <div class="col text-right"> 
                                <a href= "staticBackdrop" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#staticBackdrop">Tambah Data</a>
                                <a href= "/posko/exportpdf" class="btn btn-sm btn-warning" >Export PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush"  id="myTable">
                            <thead class="thead-light">
                                <tr> 
                                    <th scope="col">Kode Posko</th>
                                    <th scope="col">Nama Posko</th>
                                    <th scope="col">Jenis Posko</th> 
                                    <th scope="col">Lokasi Posko</th>
                                    <th scope="col">Tanggal Didirikan</th> 
                                     <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($posko as $posko)
                             <tr>
                                <td>{{$posko->kode_pos}}</td>
                                <td>{{$posko->nama_posko}}</td>
                                <td>{{$posko->jenis_posko}}</td>
                                <td>{{$posko->lokasi_posko}}</td>
                                <td>{{$posko->created_at->diffforhumans()}} | {{$posko->created_at->format('d M Y')}}</td>  
                                <td><a href="/posko/{{$posko->id}}/profile" class="btn btn-info btn-sm">Preview</a> 
                                    <a href="/posko/{{$posko->id}}/edit" class="btn btn-warning btn-sm">Edit</a> 
                                    <a href="#" class="btn btn-danger btn-sm delete" posko-id="{{$posko->id}}">Delete</a></td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div> 
        @include('layouts.footers.auth')  
        @endsection
<!-- Modal Tambah Data-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="staticBackdropLabel">Tambah Data Posko</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/posko/create" method="POST" enctype="multipart/form-data"> 
                    {{csrf_field()}} 
                    <div class="form-group{{$errors->has('bencana_id') ? ' has-error' : ''}}"> 
                        <label for="exampleFormControlSelect1">Kode Bencana</label>
                        <select name="bencana_id" class="form-control" id="bencana_id">
                            <option>--Pilih Kode Bencana--</option>
                            @foreach($bencana as $bencana) 
                            <option value="{{ $bencana->id }}"{{(old('bencana_id') == ' ') ? ' selected' : ''}}> 
                                {{ $bencana->kode_bcn }}--{{ $bencana->nama_bencana }}
                            </option>  
                            @endforeach
                        </select>
                        @if($errors->has('bencana_id'))
                        <!-- form validation -->    <span class="help-block">{{$errors->first('bencana_id')}}</span>
                        @endif
                    </div>    
                    <!--  validation1    --><div class="form-group{{$errors->has('nama_posko') ? ' has-error' : ''}}">
                        <label for="nama_posko">Nama Posko</label>
                        <input name="nama_posko" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Posko" value="{{old('nama_posko')}}">
                        @if($errors->has('nama_posko'))
                        <!-- form validation -->    <span class="help-block">{{$errors->first('nama_posko')}}</span>
                        @endif
                    </div>
                    <!--  validation1    --><div class="form-group{{$errors->has('email') ? ' has-error' : ''}}">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" value="{{old('email')}}">
                        @if($errors->has('email'))
                        <!-- form validation -->    <span class="help-block">{{$errors->first('email')}}</span>
                        @endif
                    </div> 
                    <div class="form-group{{$errors->has('jenis_posko') ? ' has-error' : ''}}"> 
                        <label for="exampleFormControlSelect1">Jenis Posko</label>
                        <select name="jenis_posko" class="form-control" id="jenis_posko">
                            <option value="Posko Bantuan"{{(old('jenis_posko') == 'Posko Bantuan') ? ' selected' : ''}}>Posko Bantuan</option>
                            <option value="Posko Pengungsi"{{(old('jenis_posko') == 'Posko Pengungsi') ? ' selected' : ''}}>Posko Pengungsi</option> 
                        </select>
                        @if($errors->has('jenis_posko'))
                        <!-- form validation -->    <span class="help-block">{{$errors->first('jenis_posko')}}</span>
                        @endif
                    </div>  
                    <div class="form-group">
                        <label for="lokasi_posko">Lokasi Posko</label>
                        <textarea name="lokasi_posko" class="form-control" id="lokasi_posko" placeholder="Lokasi Posko" rows="3">{{old('lokasi_posko')}}</textarea>
                    </div> 
                    <!-- <div class="form-group{{$errors->has('avatar') ? ' has-error' : ''}}">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" class="form-control"> 
                        @if($errors->has('avatar'))
                        <!-- form validation -->   <!--  <span class="help-block">{{$errors->first('avatar')}}</span> -->
                        <!-- @endif
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div> 
            </div>
        </div>
    </form>
</div>
</div> 
</div>

@push('js')
<script>
     $(document).ready(function(){ 
        $('#myTable').DataTable(); 
    $('.delete').click(function(){
       var posko = $(this).attr('posko-id');
       const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

       swalWithBootstrapButtons.fire({
          title: 'Apa Kamu Yakin?',
          text: "Kamu tidak akan dapat mengembalikan ini!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Jangan, batalkan!',
          reverseButtons: true
      }).then((result) => {
          if (result.value) { 
            swalWithBootstrapButtons.fire(
              'Terhapus!',
              'Data kamu sudah di hapus!.',
              'success'
              )
            window.location = "/posko/"+posko+"/delete";
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
            swalWithBootstrapButtons.fire(
              'Dibatalkan!',
              'Data kamu batal dihapus :)',
              'error'
              )
        }
    })
  });
   }); 
</script> 
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
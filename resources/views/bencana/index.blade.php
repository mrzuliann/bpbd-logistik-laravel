@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('Selamat Datang Di Sistem Informasi Distribusi Bantuan Loistik Bencana Alam !'),
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
                                <h3 class="mb-0">Data Bencana</h3>
                            </div>
                            <div class="col text-right"> 
                                <a href= "staticBackdrop" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#staticBackdrop">Tambah Data</a>
                                <a href= "/bencana/exportpdf" class="btn btn-sm btn-warning" >Export PDF</a>
                            </div> 
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush" id="myTable">
                            <thead class="thead-light">
                                <tr> 
                                    <th scope="col">Kode Bencana</th>
                                    <th scope="col">Nama Bencana</th>
                                    <th scope="col">Jenis Bencana</th> 
                                    <th scope="col">Lokasi Bencana</th> 
                                    <th scope="col">Tanggal Bencana</th>  
                                    <th scope="col">Posko Tersedia</th>
                                     <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($bencana as $bencana)
                             <tr>
                                <td>{{$bencana->kode_bcn}} </td>
                                <td>{{$bencana->nama_bencana}}</td>
                                <td>{{$bencana->jenis_bencana}}</td>
                                <td>{{$bencana->lokasi_bencana}}</td> 
                                <td>{{$bencana->created_at->diffforhumans()}} | {{$bencana->created_at->format('d M Y')}}</td>
                                   <td>
                                    @If(is_null($bencana)) 
                                    @else
                                    <div><a href="/posko" class="btn btn-outline-danger btn-sm"> Tambah Posko </a></div>
                                    @endif
                                    @foreach($bencana->posko as $pos)
                                    <div><a href="/posko/{{ $pos->id }}/profile" class="btn btn-outline-dark btn-sm"> {{ $pos->nama_posko }} </a></div>
                                    @endforeach
                                </td>
                                <td><a href="/bencana/{{$bencana->id}}/profile" class="btn btn-info btn-sm">Preview</a> 
                                    <a href="/bencana/{{$bencana->id}}/edit" class="btn btn-warning btn-sm" >Edit</a> 
                                    <a href="#" class="btn btn-danger btn-sm delete" bencana-id="{{$bencana->id}}">Delete</a></td> 
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
                <h2 class="modal-title" id="staticBackdropLabel">Tambah Data Bencana</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/bencana/create" method="POST" enctype="multipart/form-data"> 
                    {{csrf_field()}}    
                    <!--  validation1    --><div class="form-group{{$errors->has('nama_bencana') ? ' has-error' : ''}}">
                        <label for="nama_bencana">Nama Bencana</label>
                        <input name="nama_bencana" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Bencana" value="{{old('nama_bencana')}}">
                        @if($errors->has('nama_bencana'))
                        <!-- form validation -->    <span class="help-block">{{$errors->first('nama_bencana')}}</span>
                        @endif
                    </div> 
                   
                    
                    <div class="form-group{{$errors->has('jenis_bencana') ? ' has-error' : ''}}"> 
                        <label for="exampleFormControlSelect1">Jenis Bencana</label>
                        <select name="jenis_bencana" class="form-control" id="jenis_bencana">
                            <option>--Pilih Jenis Bencana--</option>
                            <option value="Banjir"{{(old('jenis_bencana') == 'Banjir') ? ' selected' : ''}}>Banjir</option>
                            <option value="Kebakaran"{{(old('jenis_bencana') == 'Kebakaran') ? ' selected' : ''}}>Kebakaran</option>
                            <option value="Gempa"{{(old('jenis_bencana') == 'Gempa') ? ' selected' : ''}}>Gempa</option>
                            <option value="Puting_beliung"{{(old('jenis_bencana') == 'Puting Beliung') ? ' selected' : ''}}>Puting Beliung</option> 
                            <option value="Longsor"{{(old('jenis_bencana') == 'Longsor') ? ' selected' : ''}}>Longsor</option>
                            <option value="Wabah"{{(old('jenis_bencana') == 'Wabah') ? ' selected' : ''}}>Wabah</option> 
                        </select>
                        @if($errors->has('jenis_bencana'))
                        <!-- form validation -->    <span class="help-block">{{$errors->first('jenis_bencana')}}</span>
                        @endif
                    </div>  
                    <div class="form-group">
                        <label for="lokasi_bencana">Lokasi Bencana</label>
                        <textarea name="lokasi_bencana" class="form-control" id="lokasi_bencana" placeholder="Lokasi Bencana" rows="3">{{old('lokasi_bencana')}}</textarea>
                    </div><!--  
                    <div class="form-group{{$errors->has('avatar') ? ' has-error' : ''}}">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" class="form-control"> 
                        @if($errors->has('avatar')) -->
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
     var bencana = $(this).attr('bencana-id');
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
        window.location = "/bencana/"+bencana+"/delete";
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
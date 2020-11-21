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
                                <h3 class="mb-0">Data Barang</h3>
                            </div>
                            <div class="col text-right"> 
                                <a href= "staticBackdrop" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#staticBackdrop">Tambah Data</a>
                                 <a href= "/barang/exportpdf" class="btn btn-sm btn-warning" >Export PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush" id="myTable">
                            <thead class="thead-light">
                                <tr> 
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Jumlah</th> 
                                    <th scope="col">Satuan</th> 
                                     <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($barang as $barang)
                             <tr>
                                <td>{{$barang->kode_brg}}</td>
                                <td>{{$barang->nama_barang}}</td>
                                <td>{{$barang->jumlah}}</td>
                                <td>{{$barang->satuan}}</td> 
                                <td><a target="_blank" href="#" class="btn btn-info btn-sm">Preview</a> 
                                    <a href="/barang/{{$barang->id}}/edit" class="btn btn-warning btn-sm" >Edit</a> 
                                    <a href="#" class="btn btn-danger btn-sm delete" barang-id="{{$barang->id}}">Delete</a></td> 
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
                <h2 class="modal-title" id="staticBackdropLabel">Tambah Data Barang</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/barang/create" method="POST" enctype="multipart/form-data"> 
                    {{csrf_field()}}    
                    <!--  validation1    --><div class="form-group{{$errors->has('nama_barang') ? ' has-error' : ''}}">
                        <label for="nama_barang">Nama Barang</label>
                        <input name="nama_barang" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Barang" value="{{old('nama_barang')}}">
                        @if($errors->has('nama_barang'))
                        <!-- form validation -->    <span class="help-block">{{$errors->first('nama_barang')}}</span>
                        @endif
                    </div>
                    <!--  validation1    --><div class="form-group{{$errors->has('jumlah') ? ' has-error' : ''}}">
                        <label for="jumlah">Jumlah</label>
                        <input name="jumlah" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Jumlah" value="{{old('number')}}">
                        @if($errors->has('jumlah'))
                        <!-- form validation -->    <span class="help-block">{{$errors->first('jumlah')}}</span>
                        @endif
                    </div>   
                    <div class="form-group{{$errors->has('satuan') ? ' has-error' : ''}}"> 
                        <label for="exampleFormControlSelect1">Satuan</label>
                        <select name="satuan" class="form-control" id="satuan">
                            <option value="Kg"{{(old('satuan') == 'Kg') ? ' selected' : ''}}>Kg</option>
                            <option value="Liter"{{(old('satuan') == 'Liter') ? ' selected' : ''}}>Liter</option>
                            <option value="Pcs"{{(old('satuan') == 'Pcs') ? ' selected' : ''}}>Pcs</option>
                            <option value="Botol"{{(old('satuan') == 'Botol') ? ' selected' : ''}}>Botol</option> 
                            <option value="Bungkus"{{(old('satuan') == 'Bungkus') ? ' selected' : ''}}>Bungkus</option>
                            <option value="Unit"{{(old('satuan') == 'Unit') ? ' selected' : ''}}>Unit</option> 
                        </select>
                        @if($errors->has('satuan'))
                        <!-- form validation -->    <span class="help-block">{{$errors->first('satuan')}}</span>
                        @endif
                    </div>  
                   <!--  <div class="form-group">
                        <label for="lokasi_barang">Lokasi Barang</label>
                        <textarea name="lokasi_barang" class="form-control" id="lokasi_barang" placeholder="Alamat" rows="3">{{old('lokasi_barang')}}</textarea>
                    </div> --><!--  
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
           var barang = $(this).attr('barang-id');
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
                window.location = "/barang/"+barang+"/delete";
                swalWithBootstrapButtons.fire(
                  'Terhapus!',
                  'Data kamu sudah di hapus!.',
                  'success'
                  )
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
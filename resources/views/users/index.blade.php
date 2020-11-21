@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your Edit page. You can Update data here with late information data'),
        'class' => 'col-lg-12' ])   
    <div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Data Users</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href= "staticBackdrop" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#staticBackdrop">Tambah User</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                                        </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="myTable">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Email</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                 <td>{{$user->name}}</td>
                                 <td>{{$user->role}}</td>
                                <td>
                                    <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                </td>
                                <td>{{$user->created_at}}</td>
                                <td><a href="#" class="btn btn-info btn-sm">Preview</a> 
                                    <a href="#" class="btn btn-warning btn-sm">Edit</a> 
                                    <a href="#" class="btn btn-danger btn-sm delete" user-id="#">Delete</a></td> 
                                </tr>
                                @endforeach 
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">

                    </nav>
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
                <h2 class="modal-title" id="staticBackdropLabel">Tambah Data User</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/user/create" method="POST" enctype="multipart/form-data"> 
                    {{csrf_field()}}    
                    <!--  validation1    --><div class="form-group{{$errors->has('nama_user') ? ' has-error' : ''}}">
                        <label for="nama_user">Nama User</label>
                        <input name="nama_user" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama User" value="{{old('nama_user')}}">
                        @if($errors->has('nama_user'))
                        <!-- form validation -->    <span class="help-block">{{$errors->first('nama_user')}}</span>
                        @endif
                    </div> 
                   
                    
                    <div class="form-group{{$errors->has('role') ? ' has-error' : ''}}"> 
                        <label for="exampleFormControlSelect1">Jenis User</label>
                        <select name="role" class="form-control" id="role">
                            <option value="Banjir"{{(old('role') == 'Banjir') ? ' selected' : ''}}>Banjir</option>
                            <option value="Kebakaran"{{(old('role') == 'Kebakaran') ? ' selected' : ''}}>Kebakaran</option>
                            <option value="Gempa"{{(old('role') == 'Gempa') ? ' selected' : ''}}>Gempa</option>
                            <option value="Puting_beliung"{{(old('role') == 'Puting Beliung') ? ' selected' : ''}}>Puting Beliung</option> 
                            <option value="Longsor"{{(old('role') == 'Longsor') ? ' selected' : ''}}>Longsor</option>
                            <option value="Wabah"{{(old('role') == 'Wabah') ? ' selected' : ''}}>Wabah</option> 
                        </select>
                        @if($errors->has('role'))
                        <!-- form validation -->    <span class="help-block">{{$errors->first('role')}}</span>
                        @endif
                    </div>  
                     <!--  
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
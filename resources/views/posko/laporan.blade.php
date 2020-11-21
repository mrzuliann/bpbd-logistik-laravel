@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('Selamat Datang Di Sistem Informasi Distribusi Bantuan Logistik Bencana Alam !'),
        'class' => 'col-lg-12' ]) 
        <div class="container-fluid mt--7">
        <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                     
                    
                </div>
            </div>
        </div> 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
        <div class="card-header">LAPORAN POSKO</div> 
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Laporan</li>
                        </ol>   
<div class="form-row">
  <div class="form-group col-md-8">
    <label for="kejadian_id">Kejadian bencana</label>
    <select class="form-control custom-select" name="kejadian_id" id="kejadian_id" required>
      <option value="">--pilih--</option>
       
    </select>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-4">
    <label for="posko_jenis">Jenis posko</label>
    <select class="form-control custom-select" name="posko_jenis" id="posko_jenis" required>
      <option value="all" <?php echo ( ['posko_jenis'] == 'all' ) ? 'selected' : '';?>>--semua--</option>
      <option value="1" <?php echo ( ['posko_jenis'] == 1 ) ? 'selected' : '';?>>Posko Pengungsi</option>
      <option value="2" <?php echo ( ['posko_jenis'] == 2 ) ? 'selected' : '';?>>Posko Bantuan</option>
    </select>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-4">
    <div class="btn-group" role="group" aria-label="Action">
      
      <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i>&nbsp;Filter</button>
    </div>
  </div>
</div> 
    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
@include('layouts.footers.auth')  
@endsection      
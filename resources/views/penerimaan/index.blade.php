@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->name,
'description' => __('Selamat Datang Di Sistem Informasi Distribusi Bantuan Logistik Bencana Alam !'),
'class' => 'col-lg-12' ]) <div class="container-fluid mt--7">
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
        <div class="card-header">TRANSAKSI PENERIMAAN LOGISTIK</div> 
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol> 
                    {!! Form::open(['route'=>'penerimaan.store','method'=>'POST']) !!}    
                    <div class="card-body"> 
                    <table class="table table-bordered">
                          <tr><td>
                                <h3>Nama Barang</h3>
                                <div class="col-md-2">
                                    {!! Form::select('id_barang',\App\Barang::pluck('nama_barang','id'),null,['class'=>'form-control']) !!}
                                </div>
                           </td></tr>
                        <tr><td>
                            <h3>Qty</h3>
                                <div class="col-md-2">
                                {!! Form::number('qty',null,['class'=>'form-control']) !!}
                                </div>
                         </td></tr>
                          <tr><td>
                                <button type="submit" name="submit" class="btn btn-success">TAMBAH</button>
                                 <a href="{{route('penerimaan.update')}}" class="btn btn-danger">SIMPAN</a>
                            </td></tr>
                    </table>
                    {!! Form::close() !!}
                    <table class="table table-bordered">
                        <tr class="success"><th colspan="6">Detail Transaksi</th></tr>
                        <tr>
                         <th>No</th><th>Nama Barang</th><th>Qty</th><th>Stok Tersedia</th><th>Satuan</th> <th>Jumlah</th><th>Aksi</th></tr>
                        <?php $no=1; $total=0; ?>
                         @foreach ($penerimaan as $item)
                        <tr>
                               <td>{{ $no}}</td>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->barang->jumlah }}</td>
                                <td>{{ $item->barang->satuan }}</td>
                                <td>{{ $item->barang->jumlah+$item->qty }}</td>
                                {!! Form::open(['route'=>['penerimaan.destroy',$item->id],'method'=>'DELETE']) !!}
                                <td><button type="submit" class="btn btn-danger">Cancel</button></td></tr>
                                {!! Form::close() !!}
                                <?php $no++ ?>
                                <?php $total=$total+($item->barang->jumlah+$item->qty) ?>
                       @endforeach
                                <tr><td colspan="5"><p align="right">Total</p></td><td>{{$total}}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
@include('layouts.footers.auth')  
@endsection        
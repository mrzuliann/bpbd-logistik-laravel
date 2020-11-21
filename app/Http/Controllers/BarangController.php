<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use PDF;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BarangController extends Controller
{
   public function index(Request $request)
	{ 
		if($request->has('cari')){
			$barang = \App\Barang::where('nama_barang','LIKE','%'.$request->cari.'%')->all();
		}else{
			$barang = \App\Barang::all();
			// dd($request->all());
		}
		
		return view('barang.index',['barang' => $barang]);
	}

	public function create(Request $request)
	{
		{  
			$this->validate($request,[
				'nama_barang' => 'required',
				'jumlah' => 'required',
				'satuan' => 'required',
			   // 'jenis_kelamin' => 'required',
			   // 'email' => 'required|email|unique:users',
			   // 'avatar' => 'mimes:jpg,png'  
			]);
 			// Custom ID Generate
			$config=['table'=>'barang','field'=>'kode_brg','length'=>6,'prefix'=>'BRG-']; 
			$id = IdGenerator::generate($config);
			//  //basic insert ke tabel barang  
			$barang = new \App\Barang; 
			$request->request->add(['kode_brg' => $id]);
			$barang = \App\Barang::create($request->all());
			// if($request -> hasfile('avatar')){
			// 	$request -> file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
			// 	$barang->avatar = $request->file('avatar')->getClientOriginalName();
			// 	$barang->save();
		} 
		return redirect('/barang')->with('sukses','Data Berhasil Ditambah!'); 
	}

	public function edit(Barang $barang)
	{
		return view('barang/edit',['barang' => $barang]);
	}

	public function update(Request $request,Barang $barang)
	{ 
		{
			$barang->update($request->all());  
			$barang->save(); 
		}
		return back()->withStatus(__('Data berhasil Di Update..!!.'));
	} 

	public function delete(Barang $barang)
	{ 
		$barang->delete($barang); 
		return redirect('/barang')->with('error','Data Berhasil Dihapus!');
	}

	public function exportPdf()
	{  
		$barang = \App\Barang::all();
		$pdf = PDF::loadView('export.barangpdf',['barang' => $barang]);
		return $pdf->download('Laporan Stok Barang.pdf');
		// return $pdf->stream();
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bencana;
use App\Posko; 
use PDF; 
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BencanaController extends Controller
{
	public function index(Request $request)
	{ 
		if($request->has('cari')){
			$bencana = \App\Bencana::where('nama_bencana','LIKE','%'.$request->cari.'%')->all();
		}else{
			$bencana = \App\Bencana::all();  
			$posko = \App\Posko::all(); 
			// dd($request->all());
		}
		
		return view('bencana.index', compact('bencana','posko'));
	}

	public function create(Request $request)
	{
		{  
			$this->validate($request,[
				'nama_bencana' => 'required|min:5',
				'jenis_bencana' => 'required',
				'lokasi_bencana' => 'required|min:15',
			   // 'jenis_kelamin' => 'required',
			   // 'email' => 'required|email|unique:users',
			   // 'avatar' => 'mimes:jpg,png'  
			]);
			// Custom ID Generate
			$config=['table'=>'bencana','field'=>'kode_bcn','length'=>6,'prefix'=>'BCN-']; 
			$id = IdGenerator::generate($config);
			 //basic insert ke tabel bencana 
			$bencana = new \App\Bencana; 
			$request->request->add(['kode_bcn' => $id]);
			$bencana = \App\Bencana::create($request->all());
			// if($request -> hasfile('avatar')){
			// 	$request -> file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
			// 	$bencana->avatar = $request->file('avatar')->getClientOriginalName();
			// 	$bencana->save();
		} 
		return redirect('/bencana')->withSukses(__('Data Berhasil Ditambah..!!'));
	}

	public function edit(Bencana $bencana)
	{
		return view('bencana/edit',['bencana' => $bencana]);
	}

	public function update(Request $request,Bencana $bencana)
	{ 
		{
			$bencana->update($request->all());  
			$bencana->save(); 
		}
		return back()->withStatus(__('Data berhasil Di Update..!!.'));
	} 

	public function delete(Bencana $bencana)
	{ 
		$bencana->delete($bencana); 
		return redirect('/bencana')->witherror(__('Data Berhasil Dihapus !!.')); 
	}

	public function profile(Bencana $bencana) 
	{ 
		$bencana = Bencana::all();  
	 	$posko = Posko::find(1);
		// dd($bencana->all());
		return view('bencana.profile',['bencana' => $bencana]); 
	}

	public function exportPdf()
	{  
		$bencana = \App\Bencana::all();
		$pdf = PDF::loadView('export.bencanapdf',['bencana' => $bencana]);
		return $pdf->download('bencana.pdf');
		// return $pdf->stream();
	}	
}

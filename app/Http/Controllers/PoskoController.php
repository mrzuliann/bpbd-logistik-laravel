<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Posko;
use \App\Bencana;
use PDF;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PoskoController extends Controller
{
   public function index(Request $request)
	{ 
		if($request->has('cari')){
			$posko = \App\Posko::where('nama_posko','LIKE','%'.$request->cari.'%')->all();
		}else{
			$posko = Posko::all();
			$bencana = Bencana::all(); 
			// dd($request->all());
		}
		
		return view('posko.index',['posko' => $posko,'bencana' => $bencana]);
	}

	public function create(Request $request)
	{
		 
		 	//tambahan untuk insert posko = users (relasi oneToOne)
			$user = new \App\User; 
			$user->role = 'posko'; 
			$user->name = $request->nama_posko;
			$user->email = $request->email;
			$user->password = bcrypt('password');
			$user->remember_token = \Str::random(60);
			$user->save();
			// Custom ID Generate
			$config=['table'=>'posko','field'=>'kode_pos','length'=>6,'prefix'=>'POS']; 
			$id = IdGenerator::generate($config);    
			//  //basic insert ke tabel posko
			$request->request->add(['user_id' => $user->id,'kode_pos' => $id]);
			$posko = \App\Posko::create($request->all());
			// $posko = new \App\Posko; 
			// $request->request->add(['id' => $posko->id]);
			// $posko = \App\Posko::create($request->all());
			// if($request -> hasfile('avatar')){
			// 	$request -> file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
			// 	$posko->avatar = $request->file('avatar')->getClientOriginalName();
			// 	$posko->save(); 
		return redirect('/posko')->withSukses(__('Data Berhasil Ditambah..!!'));
	}

	public function edit(Posko $posko)
	{
		return view('posko/edit',['posko' => $posko]);
	}

	public function update(Request $request,Posko $posko)
	{  
			// dd($request->all());
			$posko->update($request->all());  
			if($request->hasfile('avatar')){
				$request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
				$posko->avatar = $request->file('avatar')->getClientOriginalName();
				$posko->save();
				} 
		return back()->withSukses(__('Data berhasil Di Update..!!.'));
	} 

	public function delete(Posko $posko)
	{ 
		$posko->delete($posko); 
		return redirect('/posko')->witherror(__('Data Berhasil Dihapus !!.')); 
	}

	public function profile($id)
	{ 
		$posko = Posko::find($id);
 
		// dd($bencana->all());
		return view('posko.profile',['posko' => $posko]);  
	}

	public function exportPdf()
	{  
		$posko = \App\Posko::all();
		$pdf = PDF::loadView('export.poskopdf',['posko' => $posko]);
		return $pdf->download('posko.pdf');
		// return $pdf->stream();
	}

	public function laporan()
	{  
		$posko = \App\Posko::all();
		
		return view('posko.laporan',compact('posko')); 
		
	}	
}

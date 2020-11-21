<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = ['id','kode_brg','nama_barang','jumlah','satuan','created_at','update_at'];

    public function getAvatar( )
    {
    	if(!$this->avatar){
    		return asset('images/default.jpg');
    	}
    	return asset('images/'.$this->avatar);	
    }

    public function mapel()
    {
    	return $this->belongsToMany(Mapel::class)->withPivot(['nilai'])->withTimeStamps();	
    }

    public function rataratanilai()
    {
        // ambil nilai   
        $total = 0;
        $hitung = 0;
        foreach($this->mapel as $mapel){
           $total = $total + $mapel->pivot->nilai;
           $hitung++;
       }
       return $total!= 0? round($total/$hitung):$total; 
   }

   public function nama_lengkap()
   {
     return $this->nama_depan.' '.$this->nama_belakang;    
   }
}

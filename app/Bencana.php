<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    protected $table = 'bencana';
    protected $fillable = ['id','kode_bcn','nama_bencana','jenis_bencana','lokasi_bencana','created_at','update_at'];

    public function posko()
    {
       //model bencana memiliki banyak Posko 
      return $this->hasMany(Posko::class);  
    }

    public function getAvatar( )
    {
    	if(!$this->avatar){
    		return asset('images/default.jpg');
    	}
    	return asset('images/'.$this->avatar);	
    }

    public function bencana()
    {
    	return $this->belongsToMany(Mapel::class)->withPivot(['posko'])->withTimeStamps();	
    }

    public function ratarataposko()
    {
        // ambil posko   
        $total = 0;
        $hitung = 0;
        foreach($this->bencana as $bencana){
           $total = $total + $bencana->pivot->posko;
           $hitung++;
       }
       return $total!= 0? round($total/$hitung):$total; 
   }

   public function nama_lengkap()
   {
     return $this->nama_depan.' '.$this->nama_belakang;    
   }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posko extends Model
{
    protected $table = 'posko';
    protected $fillable = ['id','user_id','bencana_id','kode_pos','nama_posko','jenis_posko','lokasi_posko','avatar','created_at','update_at'];

    public function getAvatar( )
    {
    	if(!$this->avatar){
    		return asset('images/default.jpg');
    	}
    	return asset('images/'.$this->avatar);	
    }
    
    public function bencana()
    { 
    	 //model posko ini dimiliki oleh Bencana 
    	return $this->belongsTo(Bencana::class); 
    }
}

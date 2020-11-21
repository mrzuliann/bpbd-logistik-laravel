<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $guarded=[];
    
    public function barang()
    {
    	return $this->belongsTo(Barang::class,'id_barang');
    }

    public function posko()
    {
    	return $this->belongsTo(Posko::class,'id_posko');
    }

    public function bencana()
    {
    	return $this->belongsTo(Bencana::class,'id_bencana');
    } 
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    protected $guarded=[];
    
    public function barang()
    {
    	return $this->belongsTo(Barang::class,'id_barang');
    } 
}

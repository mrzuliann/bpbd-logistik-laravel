<?php 
use App\Bencana;
use App\Posko;
use App\User;
use App\Barang;
// function ranking5Besar()
// {
// 	$bencana = Bencana::all();
// 	$bencana->map(function($s){ 
// 		$s->rataratanilai = $s->rataratanilai();
// 		return $s; 
// 	}); 
//  	$bencana = $bencana->sortByDesc('rataratanilai')->take(5);
// 	return $bencana; 
// }

function totalBencana()
{
 	return Bencana::count();
}
function totalPosko()
{
 	return Posko::count();
}
function totalBarang()
{
 	return Barang::count();
}
function totalUser()
{
 	return User::count();
}
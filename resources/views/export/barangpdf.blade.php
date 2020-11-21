<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Cetak PDF</title> 
	<script src="libs/jquery/dist/jquery.min.js"></script>

</head>
<body>
		<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
		<table align="center">
		<tr> 
					<td><img src="#">
					</td>
					<td><center><font size="4"><b>
						PEMERINTAH DAERAH KABUPATEN TABALONG</b><br/>
						<b>Badan Penanggulangan Barang Daerah Kabupaten Tabalong</b></font><br/>
						<span style="font-size:10pt;"><b>Jl. Mabuun Raya Bypass RT. 1 Kel. Murung Pudak Telp.(0274) 513036 Fax. 561690</b><br/><b>
						website : www.bpbd.tabalongkab.go.id email : bpbdtabalongkab@yahoo.com</b></span>
					</td>
					<td><img src="#">
					</td></center>  
		<tr>
			<td colspan="4"><hr size="2"> </td>
		</tr>
		</tr>
		</table>
		<br>
		<table align="center">
			<tr>
				<td>Kepada</td>
				<td width="500">:</td>
			</tr>
			<tr>
				<td>Perihal</td>
				<td width="500">:</td>
			</tr>
			<tr>
				<td>Lampiran</td>
				<td width="500">:</td>
			</tr> 
			<tr>
				<td height="20" colspan="4"><!-- space --></td> 
			</tr>
			<tr>
				<td colspan="4">	Dengan ini Disampaikan Bahwa pada hari ini senin, 15 April 1998 telah kami Laporkan Data Stok Kebutuhan<br> Dasar Bencana Alam yang dimiliki BPBD Kabupaten Tabalong, sebagai berikut : </td> 
			</tr>
			<br>
		</table> 
		<center><h3><font size="4">Laporan Stok Kebutuhan Dasar</font></h3></center>
		<table class="table table-striped table-bordered table-hover" id="tabel-data">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Barang</th>
					<th>Jumlah Stok</th> 
					<th>Jenis Barang</th>
				</tr>	
			</thead>
			<tbody>
				@php
				$i = 1; 
				@endphp
				@foreach($barang as $b)
				<tr><span style="font-size:10pt; ">
					<td>{{$i++}}</td>
					<td>{{$b->nama_barang}}</td> 
					<td>{{$b->jumlah}}</td>
					<td>{{$b->satuan}}</td> 
				</tr>
				@endforeach 
			</tbody>
		</table> 
		<br>
		<table align="right">
			<tr>
				<td><center>Kepala Seksi Logistik BPBD Tabalong</center></td>
			</tr>
			<tr>
				<td height="70"></td>
			</tr>
			<tr>
				<td><center><u>Ir. Muhammad Ridha Zuliannor, M.Kom</u></center></td>
			</tr>
			<tr>
				<td><center>NIP. 191 939238833 993 02</center></td>
			</tr>
		</table> 
</body>
</html> 
		
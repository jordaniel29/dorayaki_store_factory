<?php
session_start();
require "intermediate/auth.php";

//Setup Database
class MyDB extends SQLite3 {
	function __construct() {
		$this->open('../dorayaki.db');
	}
}
$db = new MyDB();
if (!$db) {
	echo "database not connected";
}
$nama = $_GET["nama"];
$result = $db->query("select * from dorayaki where nama ='$nama'");
$data= array(); //Create array to keep all results
while ($res= $result->fetchArray(1))
{
//insert row into array
array_push($data, $res);
}
if (empty($data)){
	echo "<script type='text/javascript'>alert('Varian Not Found/Deleted!'); window.location.href='dashboard.php';</script>";
}
//Kalau tombol submit ditekan
if(isset($_POST['submit'])){
	//Inisialisasi
	$jumlah = $_POST['jumlah']*-1;
	$total_harga = $_POST['jumlah'] * $data[0]['harga'];
	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date('d-m-Y H:i:s');
	//Eksekusi Query Riwayat
	$stmt = $db->prepare('INSERT INTO riwayat VALUES(:username, :tanggal, :nama_varian, :jumlah, :total_harga)');
	$stmt->bindValue(':username', $_COOKIE['username'], SQLITE3_TEXT);
	$stmt->bindValue(':tanggal', $tanggal, SQLITE3_TEXT);
	$stmt->bindValue(':nama_varian', $_GET['nama'], SQLITE3_TEXT);
	$stmt->bindValue(':jumlah', $jumlah, SQLITE3_INTEGER);
	$stmt->bindValue(':total_harga', $total_harga, SQLITE3_INTEGER);
	$result = $stmt->execute();
	//Eksekusi Query Dorayaki
	$stmt = $db->prepare('UPDATE dorayaki SET stok = :jumlah, jumlah_terjual = :jumlah_terjual WHERE nama=:nama_varian');
	$stmt->bindValue(':jumlah', $data[0]["stok"]+$jumlah, SQLITE3_INTEGER);
	$stmt->bindValue(':jumlah_terjual', $_POST['jumlah']+$data[0]["jumlah_terjual"], SQLITE3_INTEGER);
	$stmt->bindValue(':nama_varian', $_GET['nama'], SQLITE3_TEXT);
	$result = $stmt->execute();
	header("Location:detail_dorayaki.php?nama=".$data[0]['nama']);
}
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Pembelian Dorayaki</title>
	<link rel="stylesheet" href="../css/buy_modify.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>

<body>
	<?php 
		include "intermediate/navbar.php";
		echo create_navbar();
	?>
	<input type="hidden" id="nama" name="nama" value="<?= $data[0]['nama'] ?>">
	<input type="hidden" id="harga" name="harga" value="<?= $data[0]['harga'] ?>">
	<div class="container">
		<div class="text content-title">
			<h1>Detail Pembelian</h1>
		</div>
		<div style="background-image: url('<?=$data[0]['gambar']?>');" class="content-detail">
			<p class="counter"><?=$data[0]["stok"]?></p>
			<p class="varian"><?=$data[0]["nama"]?></p>
		</div>
		<div class="deskripsi-harga">
			Rp 0
		</div>
		<form class="content-foot" action="buy_dorayaki.php?nama=<?=$data[0]["nama"]?>" method="post">
			<div class="button-price">
				<input type="button" value="-" class="counter-btn" onclick="editDorayaki(-1); updateHarga()"/>
				<input type="number" name="jumlah" class="stok-input" min="0" max="<?=$data[0]["stok"]?>" value="0" oninput="updateHarga()"/>
				<input type="button" value="+" class="counter-btn" onclick="editDorayaki(+1); updateHarga()"/>
			</div>
			<div class="submit-btn">
				<input type="submit" name="submit" value="Beli" class="beli-btn" />
			</div>
		</form>
	</div>
	

	<footer>
		<small>Copyright © 2021 - sabebBrou. All Rights Reserved.</small>
	</footer>

	<script>
		function editDorayaki(sum){
			var stok = parseInt(document.getElementsByClassName("stok-input")[0].value);
			var max_stok = parseInt(document.getElementsByClassName("counter")[0].innerHTML);
			stok += sum;
			stok = Math.max(0,stok);
			stok = Math.min(max_stok, stok);
			document.getElementsByClassName("stok-input")[0].value = stok;
		}
		function updateHarga(){
			var jumlah_pembelian = parseInt(document.getElementsByClassName("stok-input")[0].value);
			var stok = parseInt(document.getElementsByClassName("counter")[0].innerHTML);
			var harga = parseInt(document.getElementById("harga").value);
			console.log(jumlah_pembelian);
			console.log(stok);
			if (jumlah_pembelian>=0 && jumlah_pembelian<=stok){
				document.getElementsByClassName("deskripsi-harga")[0].innerHTML = "Rp " + (harga*jumlah_pembelian).toString();
			}
			else{
				document.getElementsByClassName("deskripsi-harga")[0].innerHTML = "Jumlah Dorayaki Invalid";
			}
		}
		function realTimeUpdate(){
			var content = document.getElementsByClassName("content-detail")[0];
			var nama = document.getElementById("nama").value;
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function(){
				if (xhr.readyState == 4 && xhr.status == 200){
					content.innerHTML = xhr.responseText;
				}
			}	
			xhr.open('GET','intermediate/ajax_stock_update.php?nama='+nama, true);
			xhr.send();
		}

		realTimeUpdate();
		setInterval(function(){
				realTimeUpdate();
			}, 5000);
	</script>
</body>

</html>
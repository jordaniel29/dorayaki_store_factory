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

//Declare Function
function deleteData(){
	$db = new MyDB();
	$stmt = $db->prepare('DELETE from dorayaki where nama=:nama');
	$stmt->bindValue(':nama', $_GET["nama"], SQLITE3_TEXT);
	$result = $stmt->execute();
	$db->close();
	echo "<script type='text/javascript'>alert('Deleted Successfully!'); window.location.href='dashboard.php';</script>";
}
if (isset($_GET['delete'])) {
	deleteData();
}
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Detail Dorayaki</title>
		<link rel="stylesheet" href="../css/detail.css" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
			rel="stylesheet"
		/>
		<link
			href="https://fonts.googleapis.com/icon?family=Material+Icons"
			rel="stylesheet"
		/>
	</head>
	<body>
		<?php 
			include "intermediate/navbar.php";
			echo create_navbar();
		?>
		<div class="container">
			<div class="detail">
				<div class="gambar">
					<img
						src="<?= $data[0]["gambar"]?>"
						alt="Dorayaki"
						class="gambar-dorayaki"
						style="width: 100%"
					/>
				</div>
				<div class="main-info">
					<div class="detail-atas">
						<h1><?= $data[0]["nama"]?></h1>
						<h3>Rp <?=$data[0]["harga"]?></h3>
					</div>
					<div class="detail-bawah">
						<div class="jumlah_dorayaki">
							<div><?=$data[0]["jumlah_terjual"]?> terjual</div>
							<div><?=$data[0]["stok"]?> tersisa</div>
						</div>
						<?php if ($_SESSION['is_admin']) { ?>
						<div class="btn-atas">
							<input type="submit" value="Edit" class="edit-btn" onclick="location.href='edit_dorayaki.php?current_nama=<?=$data[0]["nama"]?>'" />
							<input type="submit" value="Hapus" class="hapus-btn" onclick="location.href='detail_dorayaki.php?nama=<?=$data[0]["nama"]?>&delete=true'" />
						</div>
						<?php } ?>
						<?php if ($_SESSION['is_admin']) { ?>
						<input type="submit" value="Ubah Stok" class="ubah-btn" onclick="location.href='request_stok_dorayaki.php?nama=<?=$data[0]["nama"]?>'" />
						<?php } else { ?>
						<input type="submit" value="Beli" class="ubah-btn" onclick="location.href='buy_dorayaki.php?nama=<?=$data[0]["nama"]?>'" />
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="deskripsi">
				<h1>Deskripsi</h1>
				<p>
					<?=$data[0]["deskripsi"]?>
				</p>
			</div>
		</div>
		<footer>
			<small>Copyright © 2021 - sabebBrou. All Rights Reserved.</small>
		</footer>
	</body>
</html>

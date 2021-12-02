<?php
session_start();
require "intermediate/auth.php";
require "intermediate/auth_admin.php";
class MyDB extends SQLite3
{
	function __construct()
	{
		$this->open('../dorayaki.db');
	}
}

$db = new MyDB();

if (isset($_GET['current_nama'])) {
	$current_nama = $_GET['current_nama'];
	setcookie('current_nama', $current_nama);
	$result = $db->query("select * from dorayaki where nama ='$current_nama'");
	$data = array(); //Create array to keep all results

	while ($res = $result->fetchArray(1)) {
		//insert row into array
		array_push($data, $res);
	}
}

if (isset($_POST['submit'])) {
	echo "HAI";
	$stmt = $db->prepare('UPDATE dorayaki SET nama = :nama, deskripsi = :deskripsi, harga = :harga WHERE nama=:current_nama');
	$stmt->bindValue(':nama', $_POST['nama'], SQLITE3_TEXT);
	$stmt->bindValue(':current_nama', $_COOKIE["current_nama"], SQLITE3_TEXT);
	$stmt->bindValue(':deskripsi', $_POST['deskripsi'], SQLITE3_TEXT);
	$stmt->bindValue(':harga', $_POST['harga'], SQLITE3_INTEGER);
	$result = $stmt->execute();

	if (!$result) {
		echo "<script type='text/javascript'>alert('Something went wrong!'); window.location.href='dashboard.php';</script>";
	}

	if (isset($_POST['fileToUpload'])) {
		$target_dir = "../images/stok/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		if (!file_exists($target_file)) {
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		}
		$stmt = $db->prepare('UPDATE dorayaki SET gambar = :gambar WHERE nama=:nama');
		$stmt->bindValue(':gambar', $target_file, SQLITE3_TEXT);
		$result = $stmt->execute();
	}

	if (!$result) {
		echo "<script type='text/javascript'>alert('Failed to Edit!'); window.location.href='dashboard.php';</script>";
	} else {
		echo "<script type='text/javascript'>alert('Dorayaki Edited Succesfully!'); window.location.href='dashboard.php';</script>";
	}
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Edit Dorayaki</title>
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link rel="stylesheet" href="../css/add_edit.css" />
</head>

<body>
	<?php
	include "intermediate/navbar.php";
	echo create_navbar();
	?>
	<form class="add-dorayaki" action="edit_dorayaki.php ?>" method="post">
		<h1 class="text content-title">Edit Dorayaki</h1>
		<div class="content-input" id="nama">
			<label class="text input-title">Nama</label>
			<input type="text" class="text text-input" name="nama" value="<?= $data[0]['nama'] ?>" required />
		</div>
		<div class="content-input" id="deskripsi">
			<label class="text input-title">Deskripsi</label>
			<input type="text" class="text text-input" name="deskripsi" placeholder="Masukkan deskripsi dorayaki" value="<?= $data[0]['deskripsi'] ?>" />
		</div>
		<div class="content-input" id="harga">
			<label class="text input-title">Harga</label>
			<input type="number" class="text text-input" name="harga" placeholder="Masukkan harga dorayaki (angka)" value="<?= $data[0]['harga'] ?>" />
		</div>
		<div class="content-input" id="gambar">
			<label class="text input-title">Gambar</label>
			<input type="file" accept="image/*" class="file-input" name="fileToUpload" id="fileToUpload" placeholder="" />
		</div>
		<div class="submit">
			<input type="submit" name="submit" value="Submit" class="submit-btn" />
		</div>
	</form>
</body>
<footer>
	<small>Copyright © 2021 - sabebBrou. All Rights Reserved.</small>
</footer>

</html>
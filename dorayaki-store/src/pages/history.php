<?php
session_start();
require "intermediate/auth.php";


class MyDB extends SQLite3 {
  function __construct() {
    $this->open('../dorayaki.db');
  }
}

$db = new MyDB();
if (!$db) {
  echo "database not connected";
}

$username = $_COOKIE['username'];

if ($_SESSION['is_admin']) {
	$result = $db->query("select * from riwayat");
} else {
	$result = $db->query("select * from riwayat where username='$username'");
}

$data= array();
while ($res= $result->fetchArray(1)){
  //insert row into array
  array_push($data, $res);
};

$db->close();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
		<link rel="stylesheet" href="../css/history.css" />
		<title>Riwayat Pengubahan Stok</title>
	</head>
	<body>
		<?php 
		include "intermediate/navbar.php";
		echo create_navbar();
	  ?>
		<div class="main-wrapper">
			<h1>Riwayat Pengubahan Stok</h1>
			<table>
				<thead>
					<tr>
						<th>Username</th>
						<th>Tanggal</th>
						<th>Nama Varian</th>
						<th>Jumlah</th>
						<th>Total Harga</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($data as $row): ?>
					<tr>
						<td><?=$row["username"]?></td>
						<td><?=$row["tanggal"]?></td>
						<td><a href="detail_dorayaki.php?nama=<?= $row["nama_varian"]?>"><?=$row["nama_varian"]?></a></td>
						<td><?=$row["jumlah"]?></td>
						<td><?=$row["total_harga"]?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<footer>
			<small>Copyright © 2021 - sabebBrou. All Rights Reserved.</small>
		</footer>
  </body>
</html>

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
$result = $db->query("select * from dorayaki order by jumlah_terjual desc limit 6");
$data= array(); //Create array to keep all results
while ($res= $result->fetchArray(1)){
  //insert row into array
  array_push($data, $res);
};

$username = $_COOKIE['username'];

if ($_SESSION['is_admin']) {
	$result = $db->query("select * from riwayat");
} else {
	$result = $db->query("select * from riwayat where username='$username'");
}

$data_riwayat= array();
while ($res= $result->fetchArray(1)){
  //insert row into array
  array_push($data_riwayat, $res);
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
	<link rel="stylesheet" href="../css/dashboard.css" />
	<title>Dashboard</title>
</head>

<body>
	<div class="hero-wrapper">
		<?php 
			include "intermediate/navbar.php";
			echo create_navbar();
		?>
		<div class="hero-text-wrapper">
			<div class="hero-text">
				<h1>The best dorayaki money can buy</h1>
				<form class="search-input" method="get" action="search_dorayaki.php">
					<input
						type="text"
						class="text text-input"
						name="keyword"
						placeholder="Cari dorayaki di sini"
						autocomplete="off"
					/>
				</form>
			</div>
			<img class="hero-img" src="../images/dorayaki-ilus-flip.png" alt="dorayaki-picture" />
		</div>
	</div>
	<div class="popular-items">
		<!-- javascript array mapping -->
		<h2>Popular Items</h2>
		<div class="popular-cards-container">
      <?php foreach ($data as $row) : ?>
        <a href="detail_dorayaki.php?nama=<?= $row["nama"]?>">
          <div class="dorayaki-card">
            <img src="<?=$row['gambar']?>" alt="dorayaki-real" />
            <h3><?=$row["nama"]?></h3>
          </div>
        </a>
      <?php endforeach;?>
    </div>
	</div>
	<div class="riwayat-wrapper">
		<h2>Riwayat Pembelian</h2>
		<div class="riwayat-container">
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
				<?php foreach ($data_riwayat as $row): ?>
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
	</div>
	<!-- footer -->
	<footer>
		<small>Copyright © 2021 - sabebBrou. All Rights Reserved.</small>
	</footer>
</body>

</html>
<?php
session_start();
require "intermediate/auth.php";
require "intermediate/auth_admin.php";

//FUNCTIONS
function alert($text, $location){
	echo "<script type='text/javascript'>alert('" . $text . "'); window.location.href='" . $location . "';</script>";
}
function soapRequest($endpoint, $params, $function_name){
	$client = new SoapClient($endpoint); // Initialize WS with the WSDL
	$response = $client->__soapCall($function_name, array($params)); //contain response gotten from SOAP request's function with params declared
	return $response;
}

//Setup Database
class MyDB extends SQLite3
{
	function __construct()
	{
		$this->open('../dorayaki.db');
	}
}
$db = new MyDB();

//Get factory's dorayaki name from SOAP Request
$params = array("ip" => "127.0.0.1");
$response = soapRequest("http://localhost:1234/dorayaki?wsdl", $params, "getAllDorayaki");
$selectionArray = json_decode($response->return, true);
if ($selectionArray == NULL){
	$response_string = array_values(json_decode(json_encode($response), true))[0];
	alert($response_string,"dashboard.php");
}

//If the submit button is clicked
if (isset($_POST['submit'])) {
	$target_dir = "../images/stok/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	if (!file_exists($target_file)) {
    	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
  	}
	//Database insert
	$stmt = $db->prepare('INSERT INTO dorayaki VALUES (:nama, :deskripsi, :harga, 0, 0, :gambar)');
	$stmt->bindValue(':nama', $_POST['nama'], SQLITE3_TEXT);
	$stmt->bindValue(':deskripsi', $_POST['deskripsi'], SQLITE3_TEXT);
	$stmt->bindValue(':harga', $_POST['harga'], SQLITE3_INTEGER);
	$stmt->bindValue(':gambar', $target_file, SQLITE3_TEXT);

	$result = $stmt->execute();

	if (!$result) {
		alert("Failed to Add!","dashboard.php");
	} else {
		alert("Dorayaki Added Succesfully!","dashboard.php");
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
	<title>Add New Dorayaki</title>
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
	<form class="add-dorayaki" action="add_dorayaki.php" method="post" enctype="multipart/form-data">
		<h1 class="text content-title">Tambah Dorayaki</h1>
		<div class="content-input" id="nama">
			<label class="text input-title">Nama</label>
			<select class="text text-input" name="nama" placeholder="Masukkan nama varian dorayaki"  required>
				<option value="">-----------------</option>
				<?php
					foreach($selectionArray as $key => $value):
					echo '<option value="'.$value["nama_dorayaki"].'">'.$value["nama_dorayaki"].'</option>'; //close your tags!!
					endforeach;
				?>				
			</select>
		</div>
		<div class="content-input" id="deskripsi">
			<label class="text input-title">Deskripsi</label>
			<input type="text" class="text text-input" name="deskripsi" placeholder="Masukkan deskripsi dorayaki"  required/>
		</div>
		<div class="content-input" id="harga">
			<label class="text input-title">Harga</label>
			<input type="number" class="text text-input" name="harga" placeholder="Masukkan harga dorayaki (angka)"  required/>
		</div>
		<div class="content-input">
			<label class="text input-title">Gambar</label>
			<input type="file" accept="image/*" class="file-input" name="fileToUpload" id="fileToUpload" placeholder="" required />
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
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
if (!$db) {
	echo "database not connected";
}
$nama = $_GET["nama"];
$result = $db->query("select * from dorayaki where nama ='$nama'");
$data = array(); //Create array to keep all results
while ($res = $result->fetchArray(1)) {
	//insert row into array
	array_push($data, $res);
}
if (empty($data)) {
	alert("Varian Not Found/Deleted!", "dashboard.php");
}


//Kalau tombol submit ditekan
if (isset($_POST['submit'])) {
	if ((int) $_POST['jumlah'] == 0){
		alert("Request stok anda tidak boleh 0", "");
	}
	else{
		$params = array("nama_dorayaki"=>$_GET['nama'], "jumlah_stok" => (int) $_POST['jumlah'], "ip" => "127.0.0.1", "endpoint" => "/request");
		$response = soapRequest("http://localhost:1234/request?wsdl", $params, "sendRequest");
		$response_string = json_decode(json_encode($response), true);
		if(!$response){
			alert("Something went wrong!", "dashboard.php");
		}
		else{
			alert(array_values($response_string)[0], "");
		}
	}
}

//Menutup koneksi
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Request Pengubahan Stok Dorayaki</title>
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
	<div class="container">
		<div class="text content-title">
			<h1>Request Pengubahan Stok</h1>
		</div>
		<div style="background-image: url('<?= $data[0]["gambar"]?>');" class="content-detail">
			<p class="counter"><?= $data[0]["stok"] ?></p>
			<p class="varian"><?= $data[0]["nama"] ?></p>
		</div>
		<form class="content-foot" action="request_stok_dorayaki.php?nama=<?= $data[0]["nama"] ?>" method="post">
			<div class="button-price">
				<input type="button" value="-" class="counter-btn" onclick="editDorayaki(-1)" />
				<input type="number" name="jumlah" class="stok-input" min="0" value="0" />
				<input type="button" value="+" class="counter-btn" onclick="editDorayaki(+1)" />
			</div>
			<div class="submit-btn">
				<input type="submit" name="submit" value="Request" class="beli-btn" />
			</div>
		</form>
	</div>
	<footer>
		<small>Copyright © 2021 - sabebBrou. All Rights Reserved.</small>
	</footer>

	<script>
		function editDorayaki(sum) {
			var stok = parseInt(document.getElementsByClassName("stok-input")[0].value);
			stok += sum;
			console.log(stok);
			stok = Math.max(0, stok);
			console.log(stok);
			document.getElementsByClassName("stok-input")[0].value = stok;
		}

		function realTimeUpdate() {
			var content = document.getElementsByClassName("content-detail")[0];
			var nama = document.getElementById("nama").value;
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					content.innerHTML = xhr.responseText;
				}
			}
			xhr.open('GET', 'intermediate/ajax_stock_update.php?nama=' + nama, true);
			xhr.send();
		}

		setInterval(function() {
			realTimeUpdate();
		}, 5000);
	</script>
</body>

</html>
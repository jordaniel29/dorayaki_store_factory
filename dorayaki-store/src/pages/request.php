<?php
session_start();
require "intermediate/auth.php";

//FUNCTIONS
function alert($text, $location){
	echo "<script type='text/javascript'>alert('" . $text . "'); window.location.href='" . $location . "';</script>";
}
function soapRequest($endpoint, $params, $function_name){

	$client = new SoapClient($endpoint); // Initialize WS with the WSDL
	$response = $client->__soapCall($function_name, array($params)); //contain response gotten from SOAP request's function with params declared
	return $response;
}
function replaceState($state){
    if ($state == 0){
        return "<font-weight:bold;'>-</b>";
    }
    elseif ($state == 1){
        return "<span style='color:green; font-weight:bold;'>DITERIMA</span>";
    }
    else {
        return "<span style='color:red; font-weight:bold;'>DITOLAK</span>";
    }
}

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

$username = $_COOKIE['username'];

//Fetching data from SOAP
$params = array("ip" => "127.0.0.1");
$response = soapRequest("http://localhost:1234/request?wsdl", $params, "checkRequest");
$response_string = json_decode(json_encode($response), true);
$response_array =json_decode(array_values($response_string)[0], true);

//If changes are committed
if (isset($_POST['submit'])) {
    $params = array("ip" => "127.0.0.1");
    $response = soapRequest("http://localhost:1234/request?wsdl", $params, "updateRequest");
    $response_string = json_decode(json_encode($response), true);
    if(!$response){
        alert("Something went wrong!", "dashboard.php");
    }
    else{
        if (array_values($response_string)[0] != ""){
            echo "HALO";
            alert(array_values($response_string)[0], "");
        }
        else{
            echo "HAI";
            foreach ($response_array as $row){
                if ($row["status"] == 1){
                    //Database insert
                    $stmt = $db->prepare('UPDATE dorayaki SET stok = stok + :stok WHERE nama = :nama');
                    $stmt->bindValue(':stok', $row['jumlah_stok'], SQLITE3_INTEGER);
                    $stmt->bindValue(':nama', $row['nama_dorayaki'], SQLITE3_TEXT);
                    $result = $stmt->execute();
                }
            }	
        
            if (!$result) {
                alert("Failed to Add!","dashboard.php");
            } else {
                alert("Commit Success!","dashboard.php");
            }
        }
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
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
		<link rel="stylesheet" href="../css/history.css" />
		<title>Request Pengubahan Stok</title>
	</head>
	<body>
		<?php 
		include "intermediate/navbar.php";
		echo create_navbar();
	  ?>
		<div class="main-wrapper">
			<h1>Request Pengubahan Stok</h1>
			<table>
				<thead>
					<tr>
						<th>Nama Varian</th>
						<th>Jumlah</th>
                        <th>Waktu Request</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($response_array as $row): ?>
					<tr>						
						<td><a href="detail_dorayaki.php?nama=<?=$row["nama_dorayaki"]?>"><?=$row["nama_dorayaki"]?></a></td>
						<td><?=$row["jumlah_stok"]?></td>
                        <td><?=$row["waktu_request"]?></td>
						<td><?=replaceState($row["status"])?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
            <div class="right">
                <form class="submit-btn" action="request.php" method="post">
                    <input type="submit" name="submit" value="Commit" class="commit-btn" />
                </div>
            </div>
		</div>
		<footer>
			<small>Copyright © 2021 - sabebBrou. All Rights Reserved.</small>
		</footer>
  </body>
</html>

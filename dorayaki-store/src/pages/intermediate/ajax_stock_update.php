<?php
session_start();

//Setup Database
class MyDB extends SQLite3 {
	function __construct() {
		$this->open('../../dorayaki.db');
	}
}
$db = new MyDB();
if (!$db) {
	echo "database not connected";
}
$nama = $_GET["nama"];
$result = $db->query("select * from dorayaki where nama ='$nama'");
$data= array(); //Create array to keep all results
while ($res= $result->fetchArray(1)){
  //insert row into array
  array_push($data, $res);
}
if (!empty($data)){
  $output = '';
  $output .= '<p class="counter">'.$data[0]["stok"].'</p>';
  $output .= '<p class="varian">'.$nama.'</p>';
  echo $output;
}
else{
  echo '<p class="varian">Varian Has Been Deleted</p>';
}
$db->close();
?>
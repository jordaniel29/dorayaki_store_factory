<?php
session_start();

//Setup Database
class MyDB extends SQLite3
{
	function __construct()
	{
		$this->open('../../dorayaki.db');
	}
}
$db = new MyDB();
if (!$db) {
	echo "database not connected";
}

//variables initialization
$page = '';
$keyword ='';
if (isset($_GET["keyword"])){
	$keyword = $_GET["keyword"];
}
$limit_per_page = 6; //Static
$total_row_count = $db->querySingle("SELECT COUNT(*) FROM dorayaki where nama like '%$keyword%' order by jumlah_terjual desc");
$total_page_number = ceil($total_row_count/$limit_per_page); // counting
//Get Page from search_dorayaki
if (!empty($_GET["page"])){
	if ($_GET["page"]=="before"){
		$page = max(1, $_SESSION["page"]-1);
	}
	else if ($_GET["page"]=="after"){
		$page = min($total_page_number, $_SESSION["page"]+1);
	}
	else{
		$page = $_GET["page"];
	}
}
else{
	$page = $_SESSION["page"];
}
$_SESSION["page"] = $page;

//Fetch data from database
$start_from = ($page-1) * $limit_per_page;
$result = $db->query("select * from dorayaki where nama like '%$keyword%' limit $start_from, $limit_per_page");
$data= array(); //Create array to keep all results
while ($res= $result->fetchArray(1)){
	//insert row into array
	array_push($data, $res);
};
$db->close();
?>

<div class="cards" id="cards">
	<?php foreach ($data as $row) : ?>
	<a href="detail_dorayaki.php?nama=<?= $row["nama"]?>">
		<div class="card">
			<div class="img-holder">
				<img
					src="<?= $row["gambar"]?>"
					alt="Dorayaki"
					class="gambar-dorayaki"
				/>
			</div>
			<div class="detail">
				<h1><?= $row["nama"]?></h1>
				<div class="deskripsi-atas">
					<h3>Rp <?=$row["harga"]?></h3>
					<div><?=$row["jumlah_terjual"]?> terjual</div>
				</div>
				<div class="bawah">
					<?=$row["deskripsi"]?>
				</div>
			</div>
		</div>
	</a>

	<?php endforeach;?>
	
	</div>

<div class="container" id="container">
	<div class="pagination_section">
		<span class="pagination_link" id='before' onclick='myFunction("before");'><<</span>
		<?php
			for ($x=1; $x<=$total_page_number; $x++){
				if ($x==$page){
					echo '<span class="pagination_link active" id="' . $x . '" onclick="myFunction('.$x.');" >' . $x . '</span>';
				}
				else{
					echo '<span class="pagination_link" id="' . $x . '" onclick="myFunction('.$x.');" >' . $x . '</span>';
				}
			}
		?>
		<span class="pagination_link" id='next' onclick='myFunction("after");'>>></span>
	</div>
</div>
<?php
session_start();
require "intermediate/auth.php";

$_SESSION["page"] = 1;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Search Dorayaki</title>
		<link rel="stylesheet" href="../css/search.css" />
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

		<input type="hidden" id="keyword" name="keyword" value="<?= $_GET['keyword']?>">
		<form class="search-input" method="get" action="search_dorayaki.php">
			<input
				type="text"
				class="text text-input"
				name="keyword"
				placeholder="Cari dorayaki di sini"
				autocomplete="off"
			/>
			<button class="search-btn" type="submit">
				<span class="material-icons"> search </span>
			</button>
		</form>
		
		<div class="search-text">Search Results for "<?= $_GET["keyword"]?>"</div>
		
		<div class="main" id="main">
		</div>

		<footer>
			<small>Copyright © 2021 - sabebBrou. All Rights Reserved.</small>
		</footer>
		
		<script>
			var main = document.getElementById("main");
			var keyword = document.getElementById("keyword").value;

			function myFunction(page){
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function(){
					if (xhr.readyState == 4 && xhr.status == 200){
						main.innerHTML = xhr.responseText;
					}
				}

				xhr.open('GET','intermediate/search_pagination.php?page='+page+'&keyword='+keyword, true);
				xhr.send();
			}

			myFunction(1);

			setInterval(function(){
				myFunction(0);
			}, 5000);
		</script>
		
	</body>
</html>
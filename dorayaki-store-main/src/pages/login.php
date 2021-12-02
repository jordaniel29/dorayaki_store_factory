<?php
session_start();
require "intermediate/auth_login.php";

class MyDB extends SQLite3
{
	function __construct()
	{
		$this->open('../dorayaki.db');
	}
}

$db = new MyDB();

if (isset($_POST['username'])) {
	$stmt = $db->prepare('SELECT * FROM Users WHERE username=:username');
	$stmt->bindValue(':username', $_POST['username'], SQLITE3_TEXT);

	$result = $stmt->execute();
	$var = $result->fetchArray();

	if ($var) {
		if ($var['password'] == hash("md5", $_POST['password'])) { //check password
			setcookie('username', $_POST['username'], time() + 5400);
			$_SESSION['is_admin'] = $var['is_admin'];
			header("Location: dashboard.php");
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
	<link rel="stylesheet" href="../css/login.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
	<title>Login</title>
</head>

<body>
	<div class="login">
		<div class="login-internal">
			<h2>Login</h2>
			<form method="post" action="login.php">
				<input class="text-field" type="text" placeholder="Email address" name="username" />
				<input class="text-field" type="password" placeholder="Password" name="password" />
				<p class="warning"><?php
									if (isset($_POST['username'])) { //gagal login
										if (!isset($_COOKIE['username'])) {
											echo "invalid username or password";
										}
									}
									?></p>
				<input class="submit-btn" type="submit" value="Login" name="login" />
				<p>Don't have an account? Register <a href="register.php">here</a></p>
			</form>
		</div>
	</div>
	<div class="jumbotron">
		<div class="jumbo-text">
			<h1>The best dorayaki money can buy</h1>
			<h4>
				Discover a new world of dorayaki, one you’ve never tasted before, with
				incredibly creamy fillings, soft buns at the best price!
			</h4>
		</div>
		<div class="dorayaki-illustration"></div>
	</div>
</body>

</html>
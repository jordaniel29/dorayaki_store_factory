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
if (!$db) {
    echo "database not connected";
}

if (isset($_REQUEST['q'])) {
    $q = $_REQUEST["q"];
    $stmt = $db->prepare('SELECT * FROM Users WHERE username = :username');
    $stmt->bindValue(':username', $q, SQLITE3_TEXT);
    $result = $stmt->execute();
    $var = $result->fetchArray();
    if ($var) {
        echo "fail";
    } else {
        echo "unique";
    }
}


if (isset($_POST['username'])) { #check username saja, since the rest is required
    $stmt = $db->prepare('INSERT INTO Users (email,username,password,is_admin)
                          VALUES (:email,:username,:password,:is_admin)  ');
    $stmt->bindValue(':email', $_POST['email'], SQLITE3_TEXT);
    $stmt->bindValue(':username', $_POST['username'], SQLITE3_TEXT);
    $stmt->bindValue(':password', hash("md5", $_POST['username']), SQLITE3_TEXT);
    $stmt->bindValue(':is_admin', 0, SQLITE3_INTEGER);

    $result = $stmt->execute();
    if ($result) { #succcess
        echo "<script type='text/javascript'>alert('Account registered'); window.location.href='login.php';</script>";
    }
    echo "<script type='text/javascript'>alert('Account fail to register'); window.location.href='register.php';</script>"; #if fail relocate to register page again
}

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
    <link rel="stylesheet" href="../css/login.css" />
    <script src="../js/register.js"></script>
    <title>Register</title>
</head>

<body>
    <div class="login">
        <div class="login-internal">
            <h2>Register</h2>
            <form method="post" action="register.php">
                <input class="text-field" id="username" type="text" placeholder="Username" name="username" onchange="validateUsername(this.value)" required />
                <input class="text-field" type="email" placeholder="Email address" name="email" required />
                <input class="text-field" type="text" placeholder="Password" name="password" required />
                <p class="warning" id="warning"></p>
                <input class="submit-btn" type="submit" value="Register" />
                <p>Already a member? Sign in <a href="login.php">here</a></p>
            </form>
        </div>
    </div>
    <div class="jumbotron jumbo-reg">
        <div class="jumbo-text text-reg">
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
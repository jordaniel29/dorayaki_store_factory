<?php

function create_navbar(){
  $is_admin = $_SESSION['is_admin'];
  $output = '';
  $output .= '
  <link rel="stylesheet" href="../css/style.css" />
  <script src="../js/navbar.js"></script>
  <div class="header">
    <div class="navbar">
      <a href="dashboard.php">
        <img class="main_logo" src="../images/main_logo.png" alt="main logo" />
      </a>
      <div class="header_text">
        <a href="history.php" class="text" id="dashboard">Riwayat</a>';

  $output .= $is_admin ==1 ? '
  <a href="add_dorayaki.php" class="text center_text" id="tambah-beli-varian">Tambah</a> 
  <a href="request.php" class="text center_text" id="dashboard">Request</a>' : '';

  $output .= '<div class="account">
          <span class="material-icons" id="account-logo" onclick="menuToggle();">
            account_circle
          </span>
          <span class="material-icons" id="expand-logo" onclick="menuToggle();">
            expand_more
          </span>
        </div>
      </div>
    </div>
    <div class="account-expand">
      <ul class="expand-dropdown">
        <li class="dropdown-item">
          <a class="text dropdown-text">Hello, '.$_COOKIE['username'].'</a>
        </li>
        <li class="dropdown-item">
          <form method="post" class="logout-form">
            <input type="submit" value="Logout" name="logout" class="text dropdown-text logout-btn">
          </form>
        </li>
      </ul>
    </div>
  </div>';
  return $output; 
}
?>

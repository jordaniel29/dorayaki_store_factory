<?php
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1){
    echo "<script type='text/javascript'>alert('You require admin priveleges to do this action'); window.location.href='dashboard.php';</script>";
}

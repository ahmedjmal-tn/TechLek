<?php
require_once('user.class.php');
$us=new user();
$us-> delete_user($_GET['id']);
header('location:dashboard/tables.php');
?>

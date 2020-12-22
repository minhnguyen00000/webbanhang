<?php
session_start();

unset($_SESSION['timtensp']);
if(isset($_POST['tim'])){	
	$_SESSION['timtensp']=$_POST['timtensp'];
}

var_dump($_SESSION);
header('Location: sanpham.php');

?>
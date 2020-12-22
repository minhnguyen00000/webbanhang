<?php
 date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
include "config/config.php";
include ROOT."/include/function.php";
spl_autoload_register("loadClass");
$obj=new Db();

$danhsachsanpham=$obj->select("select * from sanpham");
//var_dump($danhsachsanpham);
$chitiet=$obj->select("select * from `chitietdh` WHERE `madh`=3");
//var_dump($chitiet);




if (isset($_SESSION['id']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: login.php');
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <?php 

 include('subpage/head.php');
 ?>
  
	<body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<?php include('subpage/sidebar.php'); ?>
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			
			
			<!-- Page Head -->
			<h2><?php echo $_SESSION['tendangnhap'];?></h2>
		
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				


			</div>
			<?php include('subpage/footer.php'); ?>
			
		</div> <!-- End #main-content -->
		
	</div></body>
</html>

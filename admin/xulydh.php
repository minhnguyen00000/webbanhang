<?php
include "config/config.php";
include ROOT."/include/function.php";
spl_autoload_register("loadClass");
session_start();
if (isset($_SESSION['id']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: login.php');
}
unset($_SESSION['thongbaodb']);
$obj=new Db();
$madh=$_POST['madh'];$math=$_POST['math'];
$ngaygh=(date('YmdHis', strtotime($_POST['ngaygh'])));
if($ngaygh==19700101000000) $ngaygh='';

if(isset($_POST['sua'])){	
	
	if($ngaygh==''||$math=='')
		{	
			header('Location: index.php');
			$_SESSION['thongbaodh']='Không được để trống';
		}

		$sua='';
		if($ngaygh!='')
			$sua.="`ngaygh`='$ngaygh',";
		if($math!='')
			$sua.="`math`='$math',";
	
var_dump($_POST);
var_dump($_SESSION);	
	$sua=substr($sua, 0, -1);

	echo "UPDATE `donhang` SET $sua WHERE madh=$madh";
	$obj->update("UPDATE `donhang` SET $sua WHERE madh=$madh");
	$_SESSION['thongbaodh']='Thành công sửa đơn hàng';
}
header('Location: donhang.php');
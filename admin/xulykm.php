<?php 

include "config/config.php";
include ROOT."/include/function.php";
spl_autoload_register("loadClass");

session_start();
if (isset($_SESSION['id']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	//header('Location: login.php');
}
$admin=(int)($_SESSION['id']);

unset($_SESSION['thongbaokm']);
$obj=new Db();

var_dump($_SESSION);
$makm=$_POST['makm'];
$ngaybd=(date('YmdHis', strtotime($_POST['ngaybd'])));
if($ngaybd==19700101000000) $ngaybd='';
$ngaykt=(date('YmdHis', strtotime($_POST['ngaykt'])));
if($ngaykt==19700101000000) $ngaykt='';
$mansx=$_POST['mansx'];
$sotienkm=$_POST['sotienkm'];




if(isset($_POST['them'])){		

	if($ngaybd==''||$ngaykt==''||$mansx==''||$sotienkm=='')
		{	
			header('Location: index.php');
			$_SESSION['thongbaokm']='Không được để trống';
		}
	
	else
{
	$obj->insert("insert into `khuyenmaisp`(`ngaybd`,`ngaykt`,`mansx`,`sotienkm`,`admin`) values ($ngaybd,$ngaykt,$mansx,$sotienkm,$admin)");
	$_SESSION['thongbaokm']='Thành công thêm khuyến mãi.';
}
}
if(isset($_POST['sua'])){	
	
	if($ngaybd==''&&$ngaykt==''&&$mansx==''&&$sotienkm=='')
		{	
			header('Location: index.php');
			$_SESSION['thongbaokm']='Không được để trống';
		}

		$sua='';
		if($ngaybd!='')
			$sua.="`ngaybd`='$ngaybd',";

		if($ngaykt!='')
			$sua.="`ngaykt`='$ngaykt',";
		if($mansx!='')
			$sua.="`mansx`='$mansx',";
		if($sotienkm!='')
			$sua.="`sotienkm`='$sotienkm',";
		if($admin!='')
			$sua.="`admin`='$admin',";
		
	$sua=substr($sua, 0, -1);
	var_dump($_POST);
	echo "UPDATE `khuyenmaisp` SET $sua WHERE makm=$makm";
	$obj->update("UPDATE `khuyenmaisp` SET $sua WHERE makm=$makm");
	$_SESSION['thongbaokm']='Thành công sửa';
}
if(isset($_POST['xoa'])){	
	
	$obj->update("DELETE FROM `khuyenmaisp` WHERE `khuyenmaisp`.`makm` = $makm");
	$_SESSION['thongbaokm']='Thành công xóa';
}


header('Location: khuyenmai.php');
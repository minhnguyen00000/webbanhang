<?php 

include "config/config.php";
include ROOT."/include/function.php";
spl_autoload_register("loadClass");
session_start();
if (isset($_SESSION['id']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: login.php');
}
unset($_SESSION['thongbaonsx']);
$obj=new Db();
$mansx=$_POST['mansx'];
$tennsx=$_POST['tennsx'];
var_dump($_POST);

if(isset($_POST['them'])){		

	if($tennsx=='')
		{	
			header('Location: index.php');
			$_SESSION['thongbaonsx']='Không được để trống';
		}
	//echo "insert into `sanpham`(`tensp`, `giasp`,`mota`, `mansx`, `anhsp`, `trangthai`) values ('$tensp',$giasp,'$mota',$mansx,'$tenanhsp',$trangthai)";
	else
	{
		echo "insert into `nhasanxuat`(`tennsx`) values ('$tennsx')";
	$obj->insert("insert into `nhasanxuat`(`tennsx`) values ('$tennsx')");
	$_SESSION['thongbaonsx']='Thành công thêm';
}
}
if(isset($_POST['sua'])){	
	//echo "UPDATE `sanpham` SET `tensp`='$tensp',`giasp`=$giasp,`mota`='$mota',`mansx`=$mansx,`anhsp`='$tenanhsp',`trangthai`=$trangthai WHERE masp=$masp";
		$sua='';
		if($tennsx!='')
			$sua.="`tennsx`='$tennsx',";
		
		
	$sua=substr($sua, 0, -1);
	echo "UPDATE `nhasanxuat` SET $sua WHERE mansx=$mansx";
	$obj->update("UPDATE `nhasanxuat` SET $sua WHERE mansx=$mansx");
	$_SESSION['thongbaonsx']='Thành công sửa';
}
if(isset($_POST['xoa'])){	
	
	$obj->update("DELETE FROM `nhasanxuat` WHERE `nhasanxuat`.`mansx` = $mansx");
	$_SESSION['thongbaonsx']='Thành công xóa';
}


header('Location: nhasanxuat.php');
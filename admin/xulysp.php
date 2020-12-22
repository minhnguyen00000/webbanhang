<?php
include "config/config.php";
include ROOT."/include/function.php";
spl_autoload_register("loadClass");
session_start();
if (isset($_SESSION['id']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: login.php');
}
unset($_SESSION['thongbao']);
$obj=new Db();
$masp=$_POST['masp'];
$tensp=$_POST['tensp'];
$giasp=$_POST['giasp'];

$trangthai=1;



$str=$_POST['mota'];
$search  = '"';
$replace = 'inch';
$newstr = str_replace($search, $replace, $str, $count);





$mota=preg_replace('/[\s]+/mu', ' ',NL2br($newstr) );
$mansx=$_POST['mansx'];
$tenanhsp=$_FILES['anhsp']['name'];
$anhsp_tmp=$_FILES['anhsp']['tmp_name'];
move_uploaded_file($anhsp_tmp,'image/'.$tenanhsp);

 $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
 $allowUpload   = true;


//var_dump($_POST);
//var_dump($_FILES);
if(isset($_POST['them'])){		

	if($tensp==''||$giasp==''||$mota==''||$mansx==''||$tenanhsp=='')
		{	
			header('Location: index.php');
			$_SESSION['thongbao']='Không được để trống';
		}
	//echo "insert into `sanpham`(`tensp`, `giasp`,`mota`, `mansx`, `anhsp`, `trangthai`) values ('$tensp',$giasp,'$mota',$mansx,'$tenanhsp',$trangthai)";
	else
	{
	$obj->insert("insert into `sanpham`(`tensp`, `giasp`,`mota`, `mansx`, `anhsp`, `trangthai`) values ('$tensp',$giasp,'$mota',$mansx,'$tenanhsp',$trangthai)");
	$_SESSION['thongbao']='Thành công thêm';
}
}
if(isset($_POST['sua'])){	
	//echo "UPDATE `sanpham` SET `tensp`='$tensp',`giasp`=$giasp,`mota`='$mota',`mansx`=$mansx,`anhsp`='$tenanhsp',`trangthai`=$trangthai WHERE masp=$masp";
	if($tensp==''||$giasp==''||$mota==''||$mansx==''||$tenanhsp=='')
		{	
			header('Location: index.php');
			$_SESSION['thongbao']='Không được để trống';
		}
		$sua='';
		if($tensp!='')
			$sua.="`tensp`='$tensp',";      
		if($giasp!='')
			$sua.="`giasp`=$giasp,";
		if($mota!='')
			$sua.="`mota`='$mota',";
		if($mansx!='')
			$sua.="`mansx`=$mansx,";
		if($tenanhsp!='')
			$sua.="`anhsp`='$tenanhsp',";
		


		
	$sua=substr($sua, 0, -1);
	echo "$sua";
	$obj->update("UPDATE `sanpham` SET $sua WHERE masp=$masp");
	$_SESSION['thongbao']='Thành công sửa';
}

  
  // file upload.php xử lý upload file

  if ($_SERVER['REQUEST_METHOD'] !== 'POST')
  {
      // Dữ liệu gửi lên server không bằng phương thức post
      echo "Phải Post dữ liệu";
      die;
  }

  // Kiểm tra có dữ liệu fileupload trong $_FILES không
  // Nếu không có thì dừng
  if (!isset($_FILES["fileupload"]))
  {
      echo "Dữ liệu không đúng cấu trúc";
      die;
  }

  // Kiểm tra dữ liệu có bị lỗi không
  if ($_FILES["fileupload"]['error'] != 0)
  {
    echo "Dữ liệu upload bị lỗi";
    die;
  }

  // Đã có dữ liệu upload, thực hiện xử lý file upload

  //Thư mục bạn sẽ lưu file upload
  $target_dir    = "uploads/";
  //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
  $target_file   = $target_dir . basename($_FILES["fileupload"]["name"]);

  $allowUpload   = true;

  //Lấy phần mở rộng của file (jpg, png, ...)
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  // Cỡ lớn nhất được upload (bytes)
  $maxfilesize   = 800000;

  ////Những loại file được phép upload
  $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');


  if(isset($_POST["submit"])) {
      //Kiểm tra xem có phải là ảnh bằng hàm getimagesize
      $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
      if($check !== false)
      {
          echo "Đây là file ảnh - " . $check["mime"] . ".";
          $allowUpload = true;
      }
      else
      {
          echo "Không phải file ảnh.";
          $allowUpload = false;
      }
  }

  // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
  // Bạn có thể phát triển code để lưu thành một tên file khác
  if (file_exists($target_file))
  {
      echo "Tên file đã tồn tại trên server, không được ghi đè";
      $allowUpload = false;
  }
  // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
  if ($_FILES["fileupload"]["size"] > $maxfilesize)
  {
      echo "Không được upload ảnh lớn hơn $maxfilesize (bytes).";
      $allowUpload = false;
  }


  // Kiểm tra kiểu file
  if (!in_array($imageFileType,$allowtypes ))
  {
      echo "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
      $allowUpload = false;
  }


  if ($allowUpload)
  {
      // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
      if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file))
      {
          echo "File ". basename( $_FILES["fileupload"]["name"]).
          " Đã upload thành công.";

          echo "File lưu tại " . $target_file;

      }
      else
      {
          echo "Có lỗi xảy ra khi upload file.";
      }
  }
  else
  {
      echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
  }

if(isset($_POST['xoa'])){	
	echo "DELETE FROM `sanpham` WHERE 'masp'=$masp";
	$obj->update("DELETE FROM `sanpham` WHERE `sanpham`.`masp` = $masp");
	$_SESSION['thongbao']='Thành công xóa';
}

header('Location: sanpham.php');

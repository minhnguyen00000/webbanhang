<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
if(!isset($_SESSION))
session_start();
include "config/config.php";
include ROOT."/include/function.php";
spl_autoload_register("loadClass");
$obj=new Db();
$danhsachsanpham=$obj->select("select * from sanpham");
$chitiet=$obj->select("select * from `chitietdh` WHERE `madh`=3");

if (isset($_SESSION['id']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: login.php');
}


if(isset($_SESSION['thongbaodh']))
{

$thongbaodh=$_SESSION['thongbaodh'];
unset($_SESSION['thongbaodh']);
}



?>

<!DOCTYPE html>
<html>
 <?php 
 include('subpage/head.php');
 ?>

<body>
	<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<?php include('subpage/sidebar.php'); ?>
	</div>

	<div id="main-content"> 
		<div class="clear"></div> <!-- End .clear -->
		<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3></h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tabdonhang" class="default-tab">Đơn hàng</a></li> <!-- href must be unique and match the id of target div -->
						
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
			<div class="content-box-content">

			<div class="tab-content default-tab"  id="tabdonhang"> <!-- This is the target div. id must match the href of this div's tab -->


<!---- Them ---->
					


						<form action="xulydh.php" method="post" enctype="multipart/form-data">
							<p style="color: red; font-size: 20px"><?php if(isset($thongbaodh)) echo "  $thongbaodh";?></p>
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>Mã đơn hàng&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input readonly class="text-input small-input" type="text" id="madh" name="madh" />

								</p>
								
								<p>Ngày giao hàng &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="text-input small-input" type="datetime-local" id="ngaygh" name="ngaygh" />
								</p>
								
								
								<p>Trang thái đơn hàng<select name="math" id="math">
									<option value="">Trạng thái</option>
									<?php $rows_nhasanxuat=$obj->select("select * from trangthai "); 
									foreach ($rows_nhasanxuat as $value) 

										{?>
										<option id="<?php   echo $value['math'] ?>" value="<?php   echo $value['math'] ?>"> <?php echo $value['math'].'-'.($value['trangthai']); ?></option>
									<?php }?>
									</select>
									</p>
								<p>
									<label>Mô tả chi tiết đơn hàng</label>
								<textarea  readonly id="motadh" name="motadh" cols="79" rows="10">
								</textarea>
								</p>
			
								<p>
									<!--<input class="button" type="submit" name="them" value="Thêm" />
										<input class="button" type="submit" name="xoa" value="Xóa" />
									--><input class="button" type="submit" name="sua" value="Sửa" />
									

									
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
									
						<table>
							
							<thead>
								<tr>
								   <th>Mã ĐH</th>
								   <th>Ngày đặt</th>
								   <th>Ngày giao</th>
								   <th>Trạng thái ĐH</th>
								   <th>Mã khách hàng</th>
								   <th>Người nhận</th>
								   <th>Địa chỉ</th>
								   <th>Số điện thoại</th>
								   <th>Tổng</th>
								   <th>Edit</th>
								   
								</tr>
								
							</thead>
						 
							
				<form action="timdh.php" method="post" enctype="multipart/form-data">
      <input type="text" placeholder="Tìm kiếm.." name="timdh">
      <input class="button" type="submit" name="tim" value="Tìm">
       		 </form>						
						<tbody>

				
						 <?php 
						 $tim;
						 	if(isset($_SESSION['timdh']))
						 {
						 $tim=$_SESSION['timdh'];
						 $dssanpham=$obj->select("SELECT * FROM `sanpham` WHERE `tensp` LIKE '%$tim%'");
						 unset($_SESSION['timdh']);
						 }				  	
						 else {
						  	$dssanpham=$obj->select("SELECT * FROM `donhang` ORDER BY `math`");
						  } 
						 foreach ($dssanpham as $sanpham) {
						 	?>  
									
									<tr>
									<td><?php echo $sanpham["madh"]; ?></td>
									<td><?php echo $sanpham["ngaydh"];?></td>
									<td><?php echo $sanpham["ngaygh"];?></td>
									<td><?php  

									$e=$obj->select("select * from trangthai");

									
									

									 foreach ($e as $value) {
									 	if($value["math"]==$sanpham["math"]){
									 		echo ($value["trangthai"]);
									 	}
									 }

								

									?></td>
									<td><?php echo $sanpham["makh"];?></td>
									<td><?php echo $sanpham["tenkh"];?></td>
									<td><?php echo $sanpham["diachikh"];?></td>
									<td><?php echo $sanpham["sdtkh"];?></td>


									<!--<td><?php echo number_format($tong ,0 ,'.' ,'.').' Đ';?></td>-->
									
								

									<td><?php $tong=0;

									$e=$obj->select("select * from chitietdh");
									 foreach ($e as $value) {
									 	if($value["madh"]==$sanpham["madh"]){
									 		$tong+=(((int)$value["giasp"])*((int)$value["soluong"]));
									 	}
									 }
									 echo number_format($tong ,0 ,'.' ,'.').' Đ';

									?></td>


									<td>
										<!-- Icons -->
										 <a id="showdh-btn-<?php echo $sanpham["madh"];?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
										
									</td>
								</tr>  


<script language="javascript">
            // Lấy đối tượng
            var buttonshowdh = document.getElementById("showdh-btn-<?php echo $sanpham["madh"];?>");
            // Thêm sự kiện cho đối tượng
            buttonshowdh.onclick = function()
            {


            	var masp = document.getElementById("<?php echo $sanpham['math'];  ?>");
            	masp.selected=true;


            	var masp = document.getElementById("madh");
            	masp.value="<?php echo($sanpham["madh"]);?>";
            	var masp = document.getElementById("motadh");
            	masp.value="<?php 
            	$x=$sanpham['madh'];
            	$t=1;
            	$chitiet=$obj->select("select * from `chitietdh` WHERE `madh`=$x");
            	
				foreach ($chitiet as $value) 				
				{

					//var_dump($value);

					$a1=$value['masp'];
					$a2=$value['giasp'];
					$a3=$value['soluong'];
					$tenssp=$obj->select("select * from `sanpham` WHERE `masp`=$a1");
					$a4=$tenssp[0]['tensp'];
					echo $t;echo ".";
					echo $a4.'-Giá:'.$a2;			
					echo '-Số lượng:'.$a3;
					echo '___';
					
				}
				
            ?>";
            }

        </script>	

								<?php
						 }
						 ?>
						 							
							
								
								
								
							
							</tbody>
							
						</table>
						
					</div> <!-- End #tabdonhang -->


<?php include('subpage/footer.php'); ?>

			</div>
	</div>

</body>
</html>
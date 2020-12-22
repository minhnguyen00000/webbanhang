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


if(isset($_SESSION['thongbaokm']))
{

$thongbaokm=$_SESSION['thongbaokm'];
unset($_SESSION['thongbaokm']);
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
						<li><a href="#tabkhuyenmai" class="default-tab">Khuyến mãi</a></li> <!-- href must be unique and match the id of target div -->
						
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
			<div class="content-box-content">

				<div class="tab-content default-tab"  id="tabkhuyenmai"> <!-- This is the target div. id must match the href of this div's tab -->



<!---- Them ---->
					


						<form action="xulykm.php" method="post" enctype="multipart/form-data">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
							<!--	<p><?php  $now = time();

								$time = date_parse_from_format('Y-m-d H:i:s', $now);
								echo "$time";
								?></p>-->
								<p style="color: red; font-size: 20px"><?php if(isset($thongbaokm)) echo "  $thongbaokm";?></p>
								<p>Mã khuyến mãi&nbsp;&nbsp;<input readonly class="text-input small-input" type="text" id="makm" name="makm" />
								</p>
								<p>Ngay bắt đầu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="text-input small-input" type="datetime-local" id="ngaybd" name="ngaybd" />
								</p>
								<p>Ngay kết thúc &nbsp;&nbsp;&nbsp;<input class="text-input small-input" type="datetime-local" id="ngaykt" name="ngaykt" />
								</p>

								<p>Nhà sản xuất &nbsp;&nbsp;&nbsp;&nbsp;<select name="mansx">
									<option value="">Chọn nsx</option>
									<?php $rows_nhasanxuat=$obj->select("select * from nhasanxuat "); 
									foreach ($rows_nhasanxuat as $value) 

										{?>
										<option value="<?php echo $value['mansx'] ?>"> <?php echo strtoupper($value['tennsx']); ?></option>
									<?php }?>
									</select>
									</p>
									<p>Số tiền&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="text-input small-input" type="text" id="sotienkm" name="sotienkm" />
								</p>

								<p>
									<input class="button" type="submit" name="them" value="Thêm" />
									<input class="button" type="submit" name="sua" value="Sửa" />
									<input class="button" type="submit" name="xoa" value="Xóa" /></p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
									
						<table>
							
							<thead>
								<tr>
								   
								   <th>Mã khuyến mãi</th>
								  
								   <th>Ngày bắt đầu</th>
								   <th>Ngày kết thúc</th>
								    <th>Ngày tạo</th>
								   <th>Công ty</th>
								   <th>Số tiền</th>
								   <th>Chỉnh sửa</th>
								   <th>Edit
								   </th>

								 
							   
								</tr>
								
							</thead>
						 
							

										
						<tbody>

				
						 <?php 
						 
						  	$dssanpham=$obj->select("SELECT * FROM `khuyenmaisp`");
						 
						  	$time=time();
						 foreach ($dssanpham as $sanpham) {
						 	if (strtotime(date('Y-m-d H:i:s'))<strtotime($sanpham['ngaykt'])) {
						 	?>  <tr>
									
									
									<td><?php echo $sanpham["makm"]; ?></td>
									<td><?php echo $sanpham["ngaybd"];?></td>
									<td><?php echo $sanpham["ngaykt"];?></td>
									<td><?php echo $sanpham["ngaytao"];?></td>
									<td>	<?php 
									$e=$obj->select("select * from nhasanxuat");


									 

									 foreach ($e as $value) {
									 	if($value["mansx"]==$sanpham["mansx"]){
									 		echo strtoupper($value["tennsx"]);
									 	}
									 }

									// var_dump($ten);
									 ?></td>
									<td> <?php echo number_format($sanpham["sotienkm"] ,0 ,'.' ,'.').' Đ';?></td>
									 <td><?php echo $sanpham["admin"]; echo "-"; 

									 $e=$obj->select("select * from admin");
									 foreach ($e as $value) {
									 	if($value["id"]==$sanpham["admin"]){
									 		echo ($value["ten"]);
									 	}
									 }

									  ?></td>
									<td>
										<!-- Icons -->
										 <a id="showkm-btn-<?php echo($sanpham["makm"]);?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
										
									</td>
								</tr>  


<script language="javascript">
            // Lấy đối tượng
            var buttonshow = document.getElementById("showkm-btn-<?php echo($sanpham["makm"]);?>");
             
            // Thêm sự kiện cho đối tượng
            buttonshow.onclick = function()
            {
            	var masp = document.getElementById("makm");
            	masp.value="<?php echo($sanpham["makm"]);?>";
            };

        </script>	

								<?php
						 }}
						 ?>
						 							
							
								
								
							
							</tbody>
							
						</table>
						
					</div> <!-- End #tabnhasanxuat -->


<?php include('subpage/footer.php'); ?>

			</div>
	</div>

</body>
</html>
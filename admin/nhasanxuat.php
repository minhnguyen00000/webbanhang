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

if(isset($_SESSION['thongbaonsx']))
{

$thongbaonsx=$_SESSION['thongbaonsx'];
unset($_SESSION['thongbaonsx']);
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
						<li><a href="#tabnhasanxuat" class="default-tab">Nhà sản xuất</a></li> <!-- href must be unique and match the id of target div -->
						
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
			<div class="content-box-content">

				<div class="tab-content default-tab"  id="tabnhasanxuat"> <!-- This is the target div. id must match the href of this div's tab -->



<!---- Them ---->
					


						<form action="xulynsx.php" method="post" enctype="multipart/form-data">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								<p style="color: red; font-size: 20px"><?php if(isset($thongbaonsx)) echo "  $thongbaonsx";?></p>
								<p>Mã nhà sản xuất <input readonly class="text-input small-input" type="text" id="mansx" name="mansx" />
								</p>
								<p>Tên nhà sản xuất <input class="text-input small-input" type="text" id="tennsx" name="tennsx" />
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
								   
								   <th>Mã</th>
								   <th>Tên</th>
								   								   <th>Edit</th>

								   
							   
								</tr>
								
							</thead>
						 
							

										
						<tbody>

				
						 <?php 
						 
						  	$dssanpham=$obj->select("SELECT * FROM `nhasanxuat`");
						  
						 foreach ($dssanpham as $sanpham) {
						 	?>  <tr>
									
									
									<td><?php echo $sanpham["mansx"]; ?></td>
									<td><?php echo $sanpham["tennsx"];?></td>
									<td>
										<!-- Icons -->
										 <a id="shownsx-btn-<?php echo($sanpham["mansx"]);?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
										
									</td>
								</tr>  


<script language="javascript">
            // Lấy đối tượng
            var buttonshow = document.getElementById("shownsx-btn-<?php echo($sanpham["mansx"]);?>");
             
            // Thêm sự kiện cho đối tượng
            buttonshow.onclick = function()
            {
            	var masp = document.getElementById("mansx");
            	masp.value="<?php echo($sanpham["mansx"]);?>";
            	var tensp = document.getElementById("tennsx");
            	tensp.value="<?php echo($sanpham["tennsx"]);?>";
            	
            	

            };

        </script>	

								<?php
						 }
						 ?>
						 							
							
								
								
							
							</tbody>
							
						</table>
						
					</div> <!-- End #tabnhasanxuat -->



<?php include('subpage/footer.php'); ?>
			</div>
	</div>

</body>
</html>
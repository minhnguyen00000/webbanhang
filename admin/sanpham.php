<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
if(!isset($_SESSION))
session_start();
include "config/config.php";
include ROOT."/include/function.php";
spl_autoload_register("loadClass");
$obj=new Sanpham();


			
						if(isset($_SESSION['timtensp']))
						 {

						 $tim=$_SESSION['timtensp'];
						 $dssanpham=$obj->timtheoten($tim);
							$total_records=count($dssanpham);
						 }			


			else
           $total_records=count($obj->getallsp());
           $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
           $total_page = ceil($total_records /10);
           // echo count($obj->getallsp());
             if ($current_page > $total_page){
            $current_page = $total_page;
       			 }
             else if ($current_page < 1){
            $current_page = 1;
        }








$danhsachsanpham=$obj->timsp20(1);
//$chitiet=$obj->select("select * from `chitietdh` WHERE `madh`=3");

if (isset($_SESSION['id']) == false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: login.php');
}

if(isset($_SESSION['thongbao']))
{

$thongbao=$_SESSION['thongbao'];
unset($_SESSION['thongbao']);
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
						<li><a href="#tabsanpham" class="default-tab">Sản phẩm</a></li> <!-- href must be unique and match the id of target div -->
						
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
			<div class="content-box-content">

				<div class="tab-content default-tab  "  id="tabsanpham"> <!-- This is the target div. id must match the href of this div's tab -->


<!---- Them ---->
					


						<form action="xulysp.php" method="post" enctype="multipart/form-data">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								<p style="color: red; font-size: 20px"><?php if(isset($thongbao)) echo "  $thongbao";?></p>
								<p>Mã sản phẩm &nbsp; <input readonly class="text-input small-input" type="text" id="masp" name="masp" />

								</p>
								<p>Tên sản phẩm &nbsp;<input class="text-input small-input" type="text" id="tensp" name="tensp" />
								</p>
								<p>Giá tiền &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="text-input small-input" type="text" id="giasp" name="giasp" />
								</p>
								<p >Chọn một hình ảnh <input type="file" name="anhsp" id="anhsp"  />
									
								</p>  

							<!--	<p>Trạng thái sản phẩm <form>
									<input checked="checked" name="trangthai" type="radio" value="1" />Còn hàng
								<input name="trangthai" type="radio" value="0" />Hết hàng

								 			</form>-->
								</p>
								<p>Nhà sản xuất <select name="mansx">
									<option value="">Chọn nsx</option>
									<?php $rows_nhasanxuat=$obj->select("select * from nhasanxuat "); 
									foreach ($rows_nhasanxuat as $value) 

										{?>
										<option value="<?php echo $value['mansx'] ?>"> <?php echo strtoupper($value['tennsx']); ?></option>
									<?php }?>
									</select>
									</p>
								<p>
									<label>Mô tả</label>
									<textarea  id="mota" name="mota" cols="79" rows="10"></textarea>
								</p>
								
								<p>
									<input class="button" type="submit" name="them" value="Thêm" />
									<input class="button" type="submit" name="sua" value="Sửa" />
									<input class="button" type="submit" name="xoa" value="Xóa" />

									
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
									
						<table>
							
							<thead>
								<tr>
								   <th>Ảnh</th>
								   <th>Mã</th>
								   <th>Tên</th>
								   <th>Giá tiền</th>
								   <th>Nhà sản xuất</th>
								   <th>Ngày tạo</th>
								   <th>Edit</th>
								   
								</tr>
								
							</thead>
						 
							
				<form action="timsp.php" method="post" enctype="multipart/form-data">
      <input type="text" placeholder="Tìm kiếm.." name="timtensp" value="<?php if(isset($_SESSION['timtensp']))
echo $_SESSION['timtensp'];else echo '';
 ?>">
      <input class="button" type="submit" name="tim" value="Tìm">
       		 </form>						
						<tbody>

				
						 <?php 
						 $tim;
						 	if(isset($_SESSION['timtensp']))
						 {

						 $tim=$_SESSION['timtensp'];
						 $dssanpham=$obj->timsp20like($current_page,$tim);

						// $dssanpham=$obj->select("SELECT * FROM `sanpham` WHERE `tensp` LIKE '%$tim%'");
						// unset($_SESSION['timtensp']);
						 }				  	
						 else {
						 	//echo "$current_page";
						 	 $dssanpham=$obj->timsp20($current_page);
						  //	$dssanpham=$obj->select("SELECT * FROM `sanpham`");
						  } 
						 foreach ($dssanpham as $sanpham) {
						 	?>  <tr>
									
									<td><img style="width:50px;height:50px;" src="image/<?php echo $sanpham["anhsp"];?>" /></td>
									<td><?php echo $sanpham["masp"]; ?></td>
									<td><?php echo $sanpham["tensp"];?></td>
									<td><?php echo number_format($sanpham["giasp"] ,0 ,'.' ,'.').' Đ';?></td>
									<!--<td><?php echo $sanpham["mansx"];?></td>-->
								<td>	<?php 
									$e=$obj->select("select * from nhasanxuat");


									 $sanpham["mansx"];

									 foreach ($e as $value) {
									 	if($value["mansx"]==$sanpham["mansx"]){
									 		echo strtoupper($value["tennsx"]);
									 	}
									 }

									// var_dump($ten);
									 ?></td>
									<td><?php echo $sanpham["ngaytao"]; ?></td>




									<td>
										<!-- Icons -->
										 <a href="#C4"  id="show-btn-<?php echo($sanpham["masp"]);?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
										
									</td>
								</tr>  



<script language="javascript">
            // Lấy đối tượng
            var buttonshow = document.getElementById("show-btn-<?php echo($sanpham["masp"]);?>");
             
            // Thêm sự kiện cho đối tượng
            buttonshow.onclick = function()
            {
            	var masp = document.getElementById("masp");
            	masp.value="<?php echo($sanpham["masp"]);?>";
            	var tensp = document.getElementById("tensp");
            	tensp.value="<?php echo($sanpham["tensp"]);?>";
            	var giasp = document.getElementById("giasp");
            	giasp.value="<?php echo($sanpham["giasp"]);?>";
            //	var anhsp = document.getElementById("anhsp");    
            	
            	var mota = document.getElementById("mota");
            	mota.value="<?php echo NL2br(($sanpham["mota"])); ?>";
            	

            };

        </script>	

								<?php
						 }
						 ?>
						 							
							
								
								
								
							
							</tbody>
							
						</table>
						
					</div> <!-- End #tabsanpham -->

<div class="pagination">


          <?php 
            // PHẦN HIỂN THỊ PHÂN TRANG
            // BƯỚC 7: HIỂN THỊ PHÂN TRANG
 
            // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<a href="sanpham.php?page='.($current_page-1).'">Prev</a> | ';
            }
 
            // Lặp khoảng giữa
            for ($i = 1; $i <= $total_page; $i++){
                // Nếu là trang hiện tại thì hiển thị thẻ span
                // ngược lại hiển thị thẻ a
                if ($i == $current_page){
                    echo '<span>'.$i.'</span> | ';
                }
                else{
                    echo '<a href="sanpham.php?page='.$i.'">'.$i.'</a> | ';
                }
            }
 
            // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
            if ($current_page < $total_page && $total_page > 1){
                echo '<a href="sanpham.php?page='.($current_page+1).'">Next</a> | ';
            }
           ?>
        

<?php include('subpage/footer.php'); ?>
			</div>
	</div>

</body>
</html>
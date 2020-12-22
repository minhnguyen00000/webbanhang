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

if(isset($_SESSION['thongbao']))
{

$thongbao=$_SESSION['thongbao'];
unset($_SESSION['thongbao']);
}

if(isset($_SESSION['thongbaonsx']))
{

$thongbaonsx=$_SESSION['thongbaonsx'];
unset($_SESSION['thongbaonsx']);
}

if(isset($_SESSION['thongbaokm']))
{

$thongbaokm=$_SESSION['thongbaokm'];
unset($_SESSION['thongbaokm']);
}

if(isset($_SESSION['thongbaodh']))
{

$thongbaodh=$_SESSION['thongbaodh'];
unset($_SESSION['thongbaodh']);
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
				
				<div class="content-box-header">
					
					<h3></h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tabsanpham" class="default-tab">Sản phẩm</a></li> <!-- href must be unique and match the id of target div -->
						<li><a href="#tabnhasanxuat">Nhà sản xuất</a></li>
						<li><a href="#tabkhuyenmai">Khuyến mãi</a></li>
						<li><a href="#tabdonhang">Đơn hàng</a></li>
						<li><a href="#tab2">Forms</a></li>
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					

<div class="tab-content"  id="tabdonhang"> <!-- This is the target div. id must match the href of this div's tab -->


<!---- Them ---->
					


						<form action="xulydh.php" method="post" enctype="multipart/form-data">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>Mã đơn hàng <input readonly class="text-input small-input" type="text" id="madh" name="madh" /><?php if(isset($thongbaodh)) echo "  $thongbaodh";?>

								</p>
								
								<p>Ngày giao hàng <input class="text-input small-input" type="datetime-local" id="ngaygh" name="ngaygh" />
								</p>
								
								
								<p>Trang thái đơn hàng<select name="math">
									<option value="">Trạng thái</option>
									<?php $rows_nhasanxuat=$obj->select("select * from trangthai "); 
									foreach ($rows_nhasanxuat as $value) 

										{?>
										<option value="<?php echo $value['math'] ?>"> <?php echo $value['math'].'-'.($value['trangthai']); ?></option>
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
						  	$dssanpham=$obj->select("SELECT * FROM `donhang`");
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



					<div class="tab-content default-tab  "  id="tabsanpham"> <!-- This is the target div. id must match the href of this div's tab -->


<!---- Them ---->
					


						<form action="xulysp.php" method="post" enctype="multipart/form-data">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								<p style="color: red; font-size: 20px"><?php if(isset($thongbao)) echo "  $thongbao";?></p>
								<p>Mã sản phẩm <input readonly class="text-input small-input" type="text" id="masp" name="masp" />

								</p>
								<p>Tên sản phẩm <input class="text-input small-input" type="text" id="tensp" name="tensp" />
								</p>
								<p>Giá tiền <input class="text-input small-input" type="text" id="giasp" name="giasp" />
								</p>
								<p>Chọn một hình ảnh <input type="file" name="anhsp" id="anhsp"  />				</p>  

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
      <input type="text" placeholder="Tìm kiếm.." name="timtensp">
      <input class="button" type="submit" name="tim" value="Tìm">
       		 </form>						
						<tbody>

				
						 <?php 
						 $tim;
						 	if(isset($_SESSION['timtensp']))
						 {
						 $tim=$_SESSION['timtensp'];
						 $dssanpham=$obj->select("SELECT * FROM `sanpham` WHERE `tensp` LIKE '%$tim%'");
						 unset($_SESSION['timtensp']);
						 }				  	
						 else {
						  	$dssanpham=$obj->select("SELECT * FROM `sanpham`");
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

<div class="tab-content" id="tabnhasanxuat"> <!-- This is the target div. id must match the href of this div's tab -->



<!---- Them ---->
					


						<form action="xulynsx.php" method="post" enctype="multipart/form-data">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>Mã nhà sản xuất <input readonly class="text-input small-input" type="text" id="mansx" name="mansx" /><?php if(isset($thongbaonsx)) echo "  $thongbaonsx";?>
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

					

<div class="tab-content" id="tabkhuyenmai"> <!-- This is the target div. id must match the href of this div's tab -->



<!---- Them ---->
					


						<form action="xulykm.php" method="post" enctype="multipart/form-data">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
							<!--	<p><?php  $now = time();

								$time = date_parse_from_format('Y-m-d H:i:s', $now);
								echo "$time";
								?>--></p>
								<p>Mã khuyến mãi<input readonly class="text-input small-input" type="text" id="makm" name="makm" /><?php if(isset($thongbaokm)) echo "  $thongbaokm";?>
								</p>
								<p>Ngay bắt đầu<input class="text-input small-input" type="datetime-local" id="ngaybd" name="ngaybd" />
								</p>
								<p>Ngay kết thúc<input class="text-input small-input" type="datetime-local" id="ngaykt" name="ngaykt" />
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
									<p>Số tiền<input class="text-input small-input" type="text" id="sotienkm" name="sotienkm" />
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







					<div class="tab-content" id="tab2">
					
						<form action="#" method="post">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>
									<label>Small form input</label>
										<input class="text-input small-input" type="text" id="small-input" name="small-input" /> <span class="input-notification success png_bg">Successful message</span> <!-- Classes for input-notification: success, error, information, attention -->
										<br /><small>A small description of the field</small>
								</p>
								
								<p>
									<label>Medium form input</label>
									<input class="text-input medium-input datepicker" type="text" id="medium-input" name="medium-input" /> <span class="input-notification error png_bg">Error message</span>
								</p>
								
								<p>
									<label>Large form input</label>
									<input class="text-input large-input" type="text" id="large-input" name="large-input" />
								</p>
								
								<p>
									<label>Checkboxes</label>
									<input type="checkbox" name="checkbox1" /> This is a checkbox <input type="checkbox" name="checkbox2" /> And this is another checkbox
								</p>
								
								<p>
									<label>Radio buttons</label>
									<input type="radio" name="radio1" /> This is a radio button<br />
									<input type="radio" name="radio2" /> This is another radio button
								</p>
								
								<p>
									<label>This is a drop down list</label>              
									<select name="dropdown" class="small-input">
										<option value="option1">Option 1</option>
										<option value="option2">Option 2</option>
										<option value="option3">Option 3</option>
										<option value="option4">Option 4</option>
									</select> 
								</p>
								
								<p>
									<label>Textarea with WYSIWYG</label>
									<textarea class="text-input textarea wysiwyg" id="textarea" name="textfield" cols="79" rows="15"></textarea>
								</p>
								
								<p>
									<input class="button" type="submit" value="Submit" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->    


					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			
			
			
			<div class="clear"></div>
			
			
			
			
			<?php include('subpage/footer.php'); ?>
			
		</div> <!-- End #main-content -->
		
	</div></body>
  

<!-- Download From www.exet.tk-->
</html>

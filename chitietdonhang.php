<?php
	include('./connectDB.php');
	if(isset($_SESSION['user'])){
        if(isset($_GET['madh'])){
            $iddh = $_GET['madh'];
            $iduser = $_SESSION['user']['tai_khoan'];
            $sql = "SELECT * FROM `don_hang` WHERE `ma_kh`=? AND `ma_dh`=? LIMIT 1";
            $querySql = $pdo->prepare($sql);
            $querySql->execute([$iduser,$iddh]);
            $datadh = $querySql->fetch();
        }
	}
	else{
		header('location:login.php');
		exit;
	}
 ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="img/fav-icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Toan Nhat Cake</title>

        <!-- Icon css link -->
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="vendors/linearicons/style.css" rel="stylesheet">
        <link href="vendors/flat-icon/flaticon.css" rel="stylesheet">
        <link href="vendors/stroke-icon/style.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Rev slider css -->
        <link href="vendors/revolution/css/settings.css" rel="stylesheet">
        <link href="vendors/revolution/css/layers.css" rel="stylesheet">
        <link href="vendors/revolution/css/navigation.css" rel="stylesheet">
        <link href="vendors/animate-css/animate.css" rel="stylesheet">
        
        <!-- Extra plugin css -->
        <link href="vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="vendors/magnifc-popup/magnific-popup.css" rel="stylesheet">
        <link href="vendors/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link href="vendors/nice-select/css/nice-select.css" rel="stylesheet">
        
        <link href="css/style.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        <!--================Main Header Area =================-->
		
			
		<?php include("./include/header.php") ?>
        <!--================End Main Header Area =================-->
        
        <!--================End Main Header Area =================-->
        <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Giỏ hàng</h3>
        			<ul>
        				<li><a href="index.html">Trang chủ</a></li>
        				<li><a href="cart.html">Giỏ hàng</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->
        
        <!--================Cart Table Area =================-->
        <section class="cart_table_area p_100">
        	<div class="container">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Bánh</th>
								<th scope="col">Loại</th>
								<th scope="col">Giá</th>
								<th scope="col">Số lượng</th>
								<th scope="col">Thành tiền</th>
							</tr>
						</thead>
						<tbody>
                        <?php 
                            $sqlctdh = "SELECT * FROM `chitiet_dh` WHERE `ma_dh` =? ";
                            $querryctdh = $pdo ->prepare($sqlctdh);
                            $querryctdh ->execute([$iddh]);
                            $datactdh = $querryctdh ->fetchAll();
							foreach($datactdh as $v){
								$mabanh = $v['ma_banh'];
								$sqlBanh = "SELECT * FROM `banh` WHERE `ma_banh` ='$mabanh' LIMIT 1";
								$queryBanh= $pdo->prepare($sqlBanh);
								$queryBanh->execute();
								$dataBanh = $queryBanh->fetch();

								$maloai = $dataBanh['ma_loai'];
								$sqlLoai = "SELECT * FROM `loai` WHERE `ma_loai` ='$maloai' LIMIT 1";
								$queryLoai= $pdo->prepare($sqlLoai);
								$queryLoai->execute();
								$dataLoai = $queryLoai->fetch();
						?>
							<tr>
								<td>
									
									<img src="img/banh/<?php echo($dataBanh['hinh']) ?>.jpg" alt="" style="width:120px;height:120px;">
									<div>
									<?php echo($dataBanh['ten_banh']) ?>
									</div>
								</td>
								<td><?php echo($dataLoai['ten_loai']) ?> </td>
								<td><?php echo($dataBanh['gia']) ?></td>
								<td>
								<input type="text" name="" id="" value="<?= $v['soluong'];?>">
								</td>
								<td><?php echo($dataBanh['gia']) ?></td>
								
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
       			
        	</div>
        </section>
        
        <footer class="footer_area">
        	<div class="footer_widgets">
        		<div class="container">
        			<div class="row footer_wd_inner">
        				<div class="col-lg-3 col-6">
        					<aside class="f_widget f_about_widget">
        						<strong style="font-family: cursive;color: pink;font-size: 18px">Toan Nhat cake</strong>
        						<p></p>
        						<ul class="nav">
        							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
        							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
        							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        						</ul>
        					</aside>
        				</div>
        				<div class="col-lg-3 col-6">
        					<aside class="f_widget f_link_widget">
        						<div class="f_title">
        							<h3>Đường dẫn nhanh</h3>
        						</div>
        						<ul class="list_style">
        							<li><a href="#">Tài khoản của bạn</a></li>
        							<li><a href="#">Xem đơn hàng</a></li>
        							<li><a href="#">Chính sách bảo mật</a></li>
        							<li><a href="#">Các điều khoản và điều kiện</a></li>
        						</ul>
        					</aside>
        				</div>
        				
        				<div class="col-lg-3 col-6">
        					<aside class="f_widget f_contact_widget">
        						<div class="f_title">
        							<h3>Thông tin liên lạc</h3>
        						</div>
        						<h4>0817400969</h4>
        						<p>ToanNhat cake <br />180 Cao lỗ,phường 4, quận 8, Thành phố Hồ Chí Minh</p>
        						<h5>ToanNhat@gmail.com</h5>
        					</aside>
        				</div>
        			</div>
        		</div>
        	</div>
        	
        </footer>
        <!--================End Footer Area =================-->
        
        
        <!--================Search Box Area =================-->
        <div class="search_area zoom-anim-dialog mfp-hide" id="test-search">
            <div class="search_box_inner">
                <h3>Search</h3>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="icon icon-Search"></i></button>
                    </span>
                </div>
            </div>
        </div>
        <!--================End Search Box Area =================-->
        
        
        
        
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Rev slider js -->
        <script src="vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script src="vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <!-- Extra plugin js -->
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="vendors/magnifc-popup/jquery.magnific-popup.min.js"></script>
        <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="vendors/isotope/isotope.pkgd.min.js"></script>
        <script src="vendors/datetime-picker/js/moment.min.js"></script>
        <script src="vendors/datetime-picker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        
        <script src="js/theme.js"></script>
    </body>

</html>
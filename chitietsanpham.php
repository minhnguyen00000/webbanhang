<?php 
	include('./connectDB.php');
	if(!isset($_GET['id'])){
		header('locaition:cake.php');
		exit;
	}
	$maBanh = $_GET['id'];
	$sqlBanh = "SELECT * FROM `banh` WHERE `ma_banh` ='$maBanh' LIMIT 1";
    $queryBanh= $pdo->prepare($sqlBanh);
    $queryBanh->execute();
	$dataBanh = $queryBanh->fetch();
	
	

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
        			<h3>Chi tiết sản phẩm</h3>
        			<ul>
        				<li><a href="index.html">Trang chủ</a></li>
        				<li><a href="product-details.html">Chi tiết sản phẩm</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->
        
        <!--================Product Details Area =================-->
        <section class="product_details_area p_100">
        	<div class="container">
        		<div class="row product_d_price">
        			<div class="col-lg-6">
        				<div class="product_img"><img class="img-fluid" src="img/banh/<?php echo($dataBanh['hinh']) ?>.jpg" alt=""></div>
        			</div>
        			<div class="col-lg-6">
        				<div class="product_details_text">
        					<h4><?php echo($dataBanh['ten_banh']) ?></h4>
        					<p><?php echo($dataBanh['mo_ta']) ?></p>
        					<h5>Thành phần :<?php echo($dataBanh['thanh_phan']) ?></h5>
							<h6>Giá : <span><?php echo(number_format($dataBanh['gia'])) ?></span></h6>
							<a class="pest_btn" href="themcart.php?id=<?php echo($v['ma_banh']);?>">Thêm vào giỏ</a>

        					
        				</div>
        			</div>
        		</div>
        		
        	</div>
        </section>
        <!--================End Product Details Area =================-->
        
        <!--================Similar Product Area =================-->
        <section class="similar_product_area p_100">
        	<div class="container">
        		<div class="main_title">
        			<h2>Các sản phẩm khác</h2>
        		</div>
        		<div class="cake_feature_row row">
				<?php					
						$sqlBanh= "SELECT * FROM `banh` ORDER BY rand() LIMIT  4";
						$queryBanh = $pdo->prepare($sqlBanh);
						$queryBanh->execute();
						$dataBanh = $queryBanh->fetchAll();
						// print_r($dataBanh);
						foreach($dataBanh as $v){
					?>
					<div class="col-lg-3 col-md-4 col-6">
					<a href="chitietsanpham.php?id=<?php echo($v['ma_banh']); ?>">
						<div class="cake_feature_item">
							<a href="chitietsanpham.php">
                            <div class="cake_img">
								<img src="img/banh/<?php echo($v['hinh']);?>.jpg" alt="<?php echo($v['ten_banh']);?>">
							</div></a>
							<div class="cake_text">
								<h4><?php echo(number_format($v['gia']));?></h4>
								<h3><?php echo($v['ten_banh']);?></h3>
								<a class="pest_btn" href="themcart.php?id=<?php echo($v['ma_banh']);?>">Thêm vào giỏ</a>
							</div>
						</div>
					</div>
					<?php
						}
					?>
				</div>
        	</div>
        </section>
        <!--================End Similar Product Area =================-->
        
        <!--================Newsletter Area =================-->
        
        <!--================End Newsletter Area =================-->
        
        <!--================Footer Area =================-->
		<?php include("./include/footer.php") ?>
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
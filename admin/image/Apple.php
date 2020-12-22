<?php
session_start();
include "config.php";

include ROOT."/include/function.php";

include "autoload.php";
$db= new Db();
$obj = new Dongdt();
$cart = new Cart();
?>

<!--A Design by thuhuong.fpt
Author: thuhuong.fpt

-->
<!DOCTYPE HTML>
<head>
<title> Smart Store </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="themes/default/default.css" rel="stylesheet" type="text/css">
<link href="css/nivo-slider_style.css" rel="stylesheet" type="text/css">
<!--<link href="css/style_nivo.css" rel="stylesheet" type="text/css">-->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="css/menu_1.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.css" rel="stylesheet"> 

<link href="css/style_login_second.css" rel='stylesheet' type='text/css' />

<link href="css/style_index.css" rel="stylesheet" type="text/css" />

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>-->


<!--<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>-->
</head>
<body>
 <div class="container">
  <div class="wrap">
	<div class="header">
		<div class="header_top">
		
			<div class="logo">
				<a href="index.php"><img src="images/1a.png"  /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="giohang.php" title="View my shopping cart" rel="nofollow">
							<strong class="opencart"> </strong>
								<span class="cart_title">Giỏ hàng(<span id="cart_sumary"><?php echo  $cart->getNumItem();
								?></span>)</span>
							</a>
						</div>
			    </div>
				<?php
					if (!isset($_SESSION["loginfront"]))
					{
				?>
			   <div class="login">
				   <span><a href="login.php"><img src="images/login.png" alt="" title="login"/></a></span>
			   </div>
			  <a href="dangky.php"><button class="btn btn-default"><span class="glyphicon glyphicon-off"></span> Đăng ký</button></a><?php } 
			  else
			  {
			  ?>
			  <ul class="nav navbar-nav navbar-right">
			    <li class="dropdown">
	        		<a href="#" class="dropdown-toggle avatar" data-toggle="dropdown"><span><?php  
                                                                                                    	if (isset($_SESSION["loginfront"])) {
                                                                                                    	$kitu = str_word_count($_SESSION["loginfront"]["0"]["TenKH"]);
                                                                                                    	$chuoi = explode(" ", $_SESSION["loginfront"]["0"]["TenKH"]);
                                                                                                    	/*print_r($chuoi);*/
                                                                                                    	$ten = $chuoi[$kitu-1];

                                                                                                        echo "Xin chào, ".$ten;
                                                                                                    }
                                                                                                        ?>
                                                                                                </span><i class="fa fa-user"></i></a>
	        		<ul class="dropdown-menu">
						
						<li class="dropdown-menu-header text-center">
							<strong>Cài đặt</strong>
						</li>
						<li class="m_2"><a href="#"><i class="fa fa-user"></i> Thông tin tài khoản</a></li>
						<li class="m_2"><a href="#"><i class="fa  fa-cog"></i> Đổi mật khẩu</a></li>
						<li class="m_2"><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>	
	        		</ul>
	      		</li>
			</ul>
			<?php } ?>
	 		</div>
	 	</div>
	  </div>
  </div>
</div>
<div class="container">
	<ul class="ul_menu">
		<li><a href="dienthoai.php">ĐIỆN THOẠI</a>
			<ul class="menu">
				<li><a href="apple.php">Apple</a></li>
				<li><a href="samsung.php">Samsung</a></li>
				<li><a href="oppo.php">Oppo</a></li>
				<li><a href="#">Vivo</a></li>								
			</ul>
		</li>
  		<li><a href="#">PHỤ KIỆN</a>
        	<div class="phukien">
        		<div class="content_pk">
        			<h3>Các sản phẩm phụ kiện</h3>                 
                    <ul>  
                    	<li><a href="thenho.php">Thẻ nhớ</a></li>
                        <li><a href="#">Sạc cáp</a></li>
                        <li><a href="#">Phụ kiện Apple</a></li>  
                    	<li><a href="#">Bao da ốp lưng</a></li>        
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="content_pk_2">
                    <ul>  
                    		<li><a href="#">Sạc dự phòng</a></li>                       	
                            <li><a href="#">Tai nghe</a></li>    
                            <li><a href="#">Miếng dán màn hình</a></li>
                            <li><a href="#">Phụ kiện khác</a></li>
                    </ul>
                </div>
                	<div class="content_pk_3">
        			<h3>BÁN CHẠY NHẤT</h3>                 
                    <ul class="menu_pk">  
                    	<li><a href="thenho.php">
                    		<div class="hinh">
							<img src="images/phukien_num.png">
							</div>
							<div class="nd_menu">
								<span>Loa bluetooth Rocky CR-X6</span>
								<p>599.000 ₫</p>
							</div>	
                       </a></li>
                       <li><a href="#">
                    		<div class="hinh_2">
							<img src="images/phukien_head.png">
							</div>
							<div class="nd_menu_2">
								<span>Mic Karaoke kèm loa Bluetooth và SDP </span>
								<p>750.000 ₫</p>
							</div>	
                       		</a> 
						</li>     
                    </ul>
            	</div>
            </div>
        	
        </li>  		 						
	</ul>
</div>
 <div class="container">
	<div id="wrapper" style="margin-top: 10px">
		<div class="slider-wrapper theme-default">
			<div id="slider" class="nivoSlider">
				<img src="images/banner_1.png"  />
				<img src="images/banner_2.png"  />
				<img src="images/banner_3.png"  />
				<img src="images/banner_4.png"  />
			</div>
		</div>
	</div>
</div>	 
<div class="container">
<div class=" bg_icon">
	<div class="row">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner" >
			<div class="item active">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
					<a href="Apple.php">
					<img src="images/icon_apple.png" class="img-responsive icon_a">
					</a>
				</div>
				<div class="col-xs-3">
					<a href="samsung.php">
					<img src="images/icon_samsung.png" class="img-responsive icon_s">
					</a>
				</div>
				<div class="col-xs-3">
					<a href="oppo.php">
					<img src="images/icon_oppo.png" class="img-responsive icon_o">
					</a>
				</div>
				<div class="col-xs-3">
					<a href="vivo.php">
					<img src="images/icon_vivo.png" class="img-responsive icon_v">
					</a>
				</div>
			</div>
		  </div>
	   </div>		
	</div>
	</div>
</div>
<div class="container" style="margin-top: 20px">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 line_left">
			<a href="index.php"><h2>ĐIỆN THOẠI ĐƯỢC QUAN TÂM</h2></a>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 line_right">
			<a href="index1.php"><p>Xem tất cả</p></a>
		</div>
	</div>
</div>	
<div class="container bg_content margin_top_50">
	<div class="row content_1">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 content_img">
			<a href="IP8.php">
				<img src="images/content_4.png" >
				<h3>iPhone 8 Plus 64GB </h3>
				<strong class="tien">23.990.000₫</strong>
				<div class="coupon">
					<span>Trả góp 0%</span>
				</div>
				<figure class="content_figure">
					<span class="slogan">iPhone 8 Plus 64GB </span>
					<strong>23.990.000₫</strong>
					<div class="promotion">
						<span>   Giảm ngay 1.000.000đ khi thanh toán trực tuyến</span>
					</div>
					<span>Màn hình: 5.5", Retina HD</span>
					<span>HĐH: iOS 11</span>
					<span>CPU: Apple A11 Bionic 6 nhân</span>
					<span>RAM: 3 GB, ROM: 64 GB</span>
					<span>Camera: 2 camera 12 MP, Selfie: 7 MP</span>
					<span>PIN: 2691 mAh</span>
				</figure>
			</a>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 content_img">
			<a href="IP6s_32.php">
				<img src="images/content_5.jpg" class="img-responsive">
				<h3 style="margin-top: 20px">iPhone 6s Plus 32GB</h3>
				<strong class="tien">14.499.000 ₫</strong>
				<div class="coupon">
					<span>Trả góp 0%</span>
				</div>
				<figure class="content_figure">
					<span class="slogan">iPhone 6s Plus 32GB</span>
					<strong>14.499.000 ₫</strong>
					<div class="promotion">
						<span> Cơ hội trúng xe Honda SH150i</span>
					</div>
					<span>Màn Hình: 5.5 inch, 1080 x 1920 pixels</span>
					<span>HĐH: iOS 10</span>
					<span>CPU: Apple A9, 2 Nhân, Dual-core 1.8 GHz</span>
					<span>RAM: 2 GB</span>
					<span>Camera: 12.0 MP/ 5.0MP </span>
					<span>PIN: lithium-ion battery 2750mAh</span>
				</figure>
			</a>
		</div>	
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 content_img">
			<a href="IP6s_32.php">
				<img src="images/iphone5s.png" class="img-responsive">
				<h3 style="margin-top: 20px">IPhone 5s</h3>
				<strong class="tien">4.499.000 ₫</strong>
				<div class="coupon">
					<span>Trả góp 0%</span>
				</div>
				<figure class="content_figure">
					<span class="slogan">IPhone 5S</span>
					<strong>4.499.000 ₫</strong>
					<div class="promotion">
						<span> Cơ hội trúng xe Honda SH150i</span>
					</div>
					<span>Màn Hình: 5.5 inch, 1080 x 1920 pixels</span>
					<span>HĐH: iOS 10</span>
					<span>CPU: Apple A9, 2 Nhân, Dual-core 1.8 GHz</span>
					<span>RAM: 2 GB</span>
					<span>Camera: 12.0 MP/ 5.0MP </span>
					<span>PIN: lithium-ion battery 2750mAh</span>
				</figure>
			</a>
		</div>	
	</div>
</div>


  <div style="clear: both"></div>
  <div class="container">
   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				
				
				<div class="col_1_of_4 span_1_of_4">
											<ul>
							<li class="footer_pay">Tư vẫn miễn phí (24/7) : <span style="color: #d02c2c;">1800 6601 </span> </li>
						</ul>
						<div class="social-icons">
							<h4>LIKE & SHARE</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"></a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				
		   </div>
     </div>
    </div>
	  </div>

    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
							  <script defer src="js/jquery.flexslider.js"></script>
							  <script type="text/javascript">
								$(function(){
								  SyntaxHighlighter.all();
								});
								$(window).load(function(){
								  $('.flexslider').flexslider({
									animation: "slide",
									start: function(slider){
									  $('body').removeClass('loading');
									}
								  });
								});
							  </script>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
</script> 
</body>
</html>


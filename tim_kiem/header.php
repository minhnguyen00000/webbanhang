<div class="header">
		<div class="header-top">
			<div class="container">
				<div class="header-grid">
					<ul>
						<li  ><a href="tintuc.php" class="scroll">Tin tức</a></li>
						<li><a href="contact.html" class="scroll">Liên hệ  </a></li>
						<li><a href="privacy.html" class="scroll">Điều khoản</a></li>
						<li><a href="#" class="scroll">Chính sách bảo mật</a></li>						
					</ul>
				</div>
				<div class="header-grid-right">
				<?php 
							if(!isset ($_SESSION['taikhoan']))
							{
							?>
					<a href="dangnhap.php" class="sign-up">Đăng nhập</a>
					<label>&nbsp;|</label>
					<a href="dangky.php" class="sign-up">Đăng ký </a>
							<?php 
							}
							else{ 
							?> 
								<label><?php echo "Xin chào, ";
								echo $_SESSION['taikhoan']; ?>|</label>
								<a href="logout.php" class="sign-up">Đăng xuất </a>
							<?php
							}
							?>
					<div class="h-cart">
                            <a  href="giohang.php">
							<i class="glyphicon glyphicon-shopping-cart cart-icon"></i>
							<div  class="shop-menu-ttl">Giỏ hàng 
							(
								<?php
								if(isset($_SESSION['taikhoan'])&&(!empty($_SESSION["cart"])))
								{
								echo $_SESSION['slsp']; 
								}
								else
								echo "0";
								?>
							)
							</div>
                            </a>
					</div>
					
					
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="container">
		<div class="header-bottom">			
				<div class="logo">
					<a href="index.php"><img src="admin/resources/images/logo.png" alt=" " ></a>
				</div>
					<div class="ad-right">
					<img class="img-responsive" src="admin/resources/images/ad.png" alt=" " >
				</div>
				<div class="clearfix"> </div>
			</div>	
			<div class="header-bottom-bottom">
				<div class="top-nav">
					<span class="menu"> </span>
					<ul>
						<li class="active"><a href="index.php">Trang chủ </a></li>
						<li><a href="nuochoanam.php" >Nước hoa nam</a></li>
						<li><a href="nuochoanu.php" >Nước hoa nữ</a></li>
						<li><a href="nuochoaunisex.php" >Nước hoa Unisex</a></li>
						<li><a href="sale-off.php" >Khuyến mãi</a></li>
						<li><a href="baohanh.php" >Bảo hành</a></li>
					</ul>	
				<script>
					$("span.menu").click(function(){
						$(".top-nav ul").slideToggle(500, function(){
						});
					});
				</script>
					
					<div class="clearfix"> </div>					
				</div>
				<div class="search">
					<form action="tim-kiem.php" method="post">
						<input type="text" value="" name="search" >
						<input type="submit"  value=" ">
					</form>
				</div>
				<div class="clearfix"> </div>
				</div>
		</div>
	</div>
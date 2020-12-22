<?php 
	include('./connectDB.php');
    if(isset($_POST['sm'])){
        
        $email = isset($_POST['email'])?$_POST['email']:'';
        $password = isset($_POST['password'])?$_POST['password']:'';
        $hoten = isset($_POST['hoten'])?$_POST['hoten']:'';
        $sdt = isset($_POST['sdt'])?$_POST['sdt']:'';
        $diachi = isset($_POST['diachi'])?$_POST['diachi']:'';
        $nhaplai = isset($_POST['nhaplai'])?$_POST['nhaplai']:'';
        if(strlen($email)< 10) {
            $_SESSION['error']=" email không hợp lệ. " ;
            header('location:dangky.php');
            exit;
        }
        if(strlen($password) < 6 ){
            $_SESSION['error'] = " Mật khẩu ít nhất 6 ký tự " ;
            header('location:dangky.php');
            exit;
        }
        
        if($password != $nhaplai){
            $_SESSION['error'] = "Mật khẩu nhập lại không đúng.";
            header('location:dangky.php');
            exit;
        }
        else{
            $sql = "SELECT *,COUNT(*) AS rowdata FROM `khach_hang` WHERE `sdt`=? OR `tai_khoan` =? limit 1";
            $querychecksdt= $pdo->prepare($sql);
            $querychecksdt->execute([$sdt,$email]);
            $datacheck = $querychecksdt->fetch();
            if($datacheck[0]['rowdata']>0){
                $_SESSION['error'] = " tài khoản hoặc số điện thoại đã có. " ;
                header('location:dangky.php');
                exit();
            }
            else{
                $newUser = array(
                    $email,
                    $password,
                    $hoten,
                    $sdt,
                    $diachi 
                );
                $sqlAdd = "INSERT INTO `khach_hang`(`tai_khoan`, `mat_khau`, `ten_kh`, `sdt`, `dia_chi`) VALUES (?,?,?,?,?)";
                $queryAdd = $pdo->prepare($sqlAdd);
                $queryAdd->execute($newUser);
                if($queryAdd->rowCount()>0){
                    $_SESSION['error'] = " Đăng ký thành công " ;
                    header('location:dangky.php');
                    exit;
                }         
                else{
                    $_SESSION['error'] = " Đăng ký không thành công " ;
                    header('location:dangky.php');
                    exit;
                }
            }
           }
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
         <?php include("./include/style-link.php") ?>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        <!--================Main Header Area =================-->
        <?php include("./include/header.php") ;
        
        ?>
        <!--================End Main Header Area =================-->
        
        <!--================End Main Header Area =================-->
        <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Đăng ký</h3>
        			<ul>
        				<li><a href="index.php">Trang chủ</a></li>
        				<li><a href="single-blog.html">Đăng ký</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->
        
        <!--================Contact Form Area =================-->
        <section class="contact_form_area p_100">
        	<div class="container">
        		<div class="main_title">
					<h2>Đăng ký</h2>
				</div>
                <div class="row">
                       <!-- form -->
                       <div class="col-md-4"></div>
                       <div class="col-md-4">
                       <form action="dangky" method="post" > 
                          <?php
                         if(isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                        
                            <?php echo($_SESSION['error']);
                                    unset($_SESSION['error']);  
                                ?>
                            </div>
                          <?php } ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1"  placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Họ tên</label>
                                <input type="text" name="hoten" class="form-control" id="exampleInputEmail1"  >
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="text" name="sdt" class="form-control" id="exampleInputEmail1"  >
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ</label>
                                <input type="text" name="diachi" class="form-control" id="exampleInputEmail1"  >
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                <small id="emailHelp" class="form-text text-muted">Password ít nhất 6 ký tự</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhập lại mật khẩu</label>
                                <input type="password" name="nhaplai" class="form-control" id="exampleInputPassword1">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <input type="submit"  name="sm" class="btn  btn-primary btn-lg btn-block" value="Đăng ký">
                            <div class="alert alert-light" role="alert">
                            <a href="login.php" class="alert-link">Đăng nhập</a></div>
                        </form>
                    </div>
                        <div class="col-md-4"></div>
       			</div>
        	</div>
        </section>
        <!--================Footer Area =================-->
          <?php include("./include/footer.php") ?>
        <!--================End Footer Area =================--a
        
        
        
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
        <script src="vendors/datetime-picker/js/moment.min.js"></script>
        <script src="vendors/datetime-picker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        <!--gmaps Js-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
        <script src="js/gmaps.min.js"></script>
        <script src="js/map-active.js"></script>
        
        <!-- contact js --> 
        <script src="js/jquery.form.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/contact.js"></script>
        
        <script src="js/theme.js"></script>
    </body>

</html>
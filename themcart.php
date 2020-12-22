<?php
    include('./connectDB.php');
    if(isset($_GET['id'])){
        
        $status = array("Chưa thanh toán","Đang xử lý","Đã xác nhận","Đang giao hàng","Đã giao hàng và thanh toán");
        $payment = array("Tiền mặt","Chuyển khoản");
        $mabanh = $_GET['id'];
        $sqlcheck = "SELECT * FROM `don_hang` WHERE `ma_kh`=? AND `trangthai`=?";
        $queryCheck = $pdo->prepare($sqlcheck);
        $id = $_SESSION['user']['tai_khoan'];
        $idGio=time();
        $queryCheck->execute([$id,0]);
        $datacheck = $queryCheck ->fetchAll();
        if($queryCheck->rowCount()==0){
            $address = $_SESSION['user']['dia_chi'];
            $datenow=date('Y-m-d h:i:s');
            $sql = "INSERT INTO `don_hang` (`ma_dh`, `ma_kh`, `ngaydat`, `ngaygiao`, `diachigiao`, `trangthai`, `ghichu`, `thanhtien`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
            $arr = array($idGio,$id,$datenow,$datenow,$address,0,$id,0);
            $queryAdd = $pdo->prepare($sql);
            $queryAdd->execute($arr);
        }else{
            $idGio= $datacheck[0]['ma_dh'];

            $sqlcheckitem = "SELECT * FROM `chitiet_dh` WHERE `ma_banh`=? AND `ma_dh`=?";
            $querycheckitem = $pdo->prepare($sqlcheckitem);
            $querycheckitem->execute([$mabanh,$idGio]);
            $datacheckitem = $querycheckitem->fetchAll();
            if(count($datacheckitem)>0){
                $sqlupdatecart = " UPDATE `chitiet_dh` SET `soluong`=`soluong`+1  WHERE  `ma_banh`=? AND `ma_dh`=?";
                $queryupdatecart = $pdo->prepare($sqlupdatecart);
                $queryupdatecart->execute([$mabanh,$idGio]);
                $thanhtien = $datacheckitem[0]['dongia'];
                $sqlUpdateGia = "UPDATE `don_hang` SET `thanhtien`=`thanhtien`+? WHERE `ma_dh` = ?";
                $queryupdate = $pdo->prepare($sqlUpdateGia);
                $queryupdate->execute([$thanhtien,$idGio]);
                header('location:index');
                exit;
                
            }
        }
        
        $sqlAddItem= "INSERT INTO `chitiet_dh`(`ma_dh`, `ma_banh`, `soluong`, `dongia`) VALUES (?,?,1,?)";
        
        $sqlBanh = "SELECT * FROM `banh` WHERE `ma_banh` ='$mabanh' LIMIT 1";
        $queryBanh= $pdo->prepare($sqlBanh);
        $queryBanh->execute();
        $dataBanh = $queryBanh->fetchAll();
        
        $dongia = $dataBanh[0]['gia'];
        $arrItem = array($idGio,$mabanh,$dongia);
        $queryAddItem = $pdo->prepare($sqlAddItem);
        $queryAddItem->execute($arrItem);
        if($queryAddItem->rowCount()>0){
            $thanhtien = $datacheck[0]['thanhtien']+$dongia;
            $sqlUpdateGia = "UPDATE `don_hang` SET `thanhtien`=? WHERE `ma_dh` = ?";
            $queryupdate = $pdo->prepare($sqlUpdateGia);
            $queryupdate->execute([$thanhtien,$idGio]);
            header('location:index');
            exit;
        }
    }
 ?>
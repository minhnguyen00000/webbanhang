<div class="col-md-9 col-d">
			<div class="in-line">
				<div class="para-an" >
						<h3>KẾT QUẢ TÌM KIẾM</h3>
				</div>
				<?php
				include('include/connect.php');
				if (isset($_POST['search'])) 
				{
					$data = $_POST['search'];
					$query = "SELECT * FROM sanpham WHERE tensanpham like '%$data%'";
					$stm = $obj->prepare($query);
					$stm->execute();
					$datab = $stm->fetchAll(); 
					if (!$datab) 
					{
						 echo ("Không tìm thấy kết quả !!!");
					}
				} 
				?>
				</br>
				<h3> Kết quả tìm kiếm từ khóa "<?php echo $_POST['search']?>"  có "<?php echo count($datab)?>" sản phẩm </h3>
				
				<div class="lady-in">
                    <?php 
						foreach ($datab as $v)
						{
						?>
						<div class="col-md-4 you-para"  >
							<table>
							<a href="chitiet.php?idsanpham=<?php echo $v['idsanpham']?>"><img class="img-responsive pic-in" src="admin/resources/images/<?php echo($v['anhsanpham']) ?>" alt=" " ></a>
							<p><?php echo $v['tensanpham']  ?></p>
							<span><?php echo number_format($v['giasanpham'])?><label class="cat-in"> </label> <a href="chitiet.php?idsanpham=<?php echo $v['idsanpham']?>">Xem sản phẩm </a></span>
						</table>
						</div>
						<?php
						}
					?> 
						<div class="clearfix"> </div>
				</div>
			</div>
</div>
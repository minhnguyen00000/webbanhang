<?php
class Sanpham extends Db{
	public function timtheoten($n)
	{
		$sql="select * from sanpham where tensp like '%$n%' ";
		return $this->select($sql);	
	}
	public function timtheoma($n)
	{
		$sql="select * from sanpham where masp = $n ";
		return $this->select($sql);	
	}

	public function timkiemtheomuc($n)
	{
		$sql="select * from sanpham where giasp =$n ";
		return $this->select($sql);
	}
	public function duoi3t()
	{
		$sql="select * from sanpham where giasp < 3000000 ";
		return $this->select($sql);	
	}
	public function duoi3t6t()
	{
		$sql="select * from sanpham where giasp >= 3000000 and giasp <6000000 ";
		return $this->select($sql);	
	}

	public function timsp20($bt)
	{

		$batdau=($bt-1)*10;
		$sql="SELECT * FROM `sanpham` WHERE 1 LIMIT $batdau,10";
		return $this->select($sql);	
	}

	public function timsp20like($bt,$str)
	{

		$batdau=($bt-1)*10;
		$sql="SELECT * FROM `sanpham` where tensp like '%$str%' LIMIT $batdau,10";
		return $this->select($sql);	
	}

	public function getallsp()
	{
		$sql="select * from sanpham";
		return $this->select($sql);
	}
}
?>
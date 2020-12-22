<?php
class Donhang extends Db{
	public function diachi($n)
	{
		$sql="select * from donhang where diachikh like '%$n%' ";
		return $this->select($sql);	
	}
	}
?>
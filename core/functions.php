<?php 

session_start();

include 'connection.php';
include 'global.php';

$myGlobal = new GlobalFunction();

class AllFunction{

	public function getKategori($length = 0) 
	{
		global $myGlobal;

		if ( $length == 0 ) {
			$result = $myGlobal->query("SELECT * FROM tblkategori ORDER BY kategori ASC");
		} else {
			$result = $myGlobal->query("SELECT * FROM tblkategori ORDER BY kategori ASC LIMIT $length");
		}

		return $result;
	}

	public function siteIdentity() 
	{
		global $myGlobal;

		$get = $myGlobal->query("SELECT * FROM tblsite");
		$rows = [];

		foreach ($get as $row) {
			$config = $row['config'];
			$value = $row['value'];
			$rows["$config"] = $value;
		}

		return $rows;
	}

	public function getProduk() {
		global $myGlobal;
		return $myGlobal->query("SELECT * FROM tblproduk");
	}

	public function getKategoriProduk($id)
	{
		global $myGlobal;
		return $myGlobal->getData("SELECT * FROM tblkategori WHERE id = $id");
	}
}



include 'siteinfo.php';
include 'sitetitle.php';
include 'request.php';
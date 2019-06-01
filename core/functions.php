<?php 

session_start();
include 'connection.php';
include 'global.php';

$myGlobal = new GlobalFunction();

class AllFunction{

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

	public function checkSession($session)
	{
		if ( isset($_SESSION["$session"]) ) {
			$result = true;
		} else {
			$result = false;
		}

		return $result;
	}

	public function getKategori($length = 0) 
	{
		global $myGlobal;

		if ( $length == 0 ) {
			$result = $myGlobal->query("SELECT * FROM tblkategori WHERE dlt = false ORDER BY kategori ASC");
		} else {
			$result = $myGlobal->query("SELECT * FROM tblkategori WHERE dlt = false ORDER BY kategori ASC LIMIT $length");
		}

		return $result;
	}

	public function getKategoriProduk($id)
	{
		global $myGlobal;
		return $myGlobal->getData("SELECT * FROM tblkategori WHERE id = $id");
	}

	public function addKategori($data)
	{
		global $myGlobal;
		$getID = $myGlobal->getNewId("tblkategori");
		$kategori = $myGlobal->filterWord($data['kategori']);
		$icon = $myGlobal->uploadFile("../images/cat_icon/","icon");

		$queryCheck = "SELECT * FROM tblkategori WHERE kategori = '$kategori' AND dlt = false";

		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$result = "1";
		} else {
			$queryInsert = "INSERT INTO tblkategori VALUES ('$getID','$kategori','$icon',false)";
			$insert = $myGlobal->exeQuery($queryInsert);

			if ( $insert > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}
		}

		return $result;
	}

	public function deleteKategori($id)
	{
		global $myGlobal;
		$queryCheck = "SELECT * FROM tblkategori WHERE id = $id";

		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$delete = $myGlobal->softDelete("tblkategori", "id", $id);
			if ( $delete > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}

			$myGlobal->softDelete("tblproduk","kategori_id",$id);
		} else {
			$result = "3";
		}

		return $result;
	}

	public function editKategori($data)
	{
		global $myGlobal;
		$id = $data['id'];
		$kategori = $myGlobal->filterWord($data['kategori']);

		$queryCheck = "SELECT * FROM tblkategori WHERE kategori = '$kategori' AND dlt = false";
		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$result = "1";
		} else {
			$queryUpdate = "UPDATE tblkategori SET kategori = '$kategori' WHERE id = $id";
			$update = $myGlobal->exeQuery($queryUpdate);

			if ( $update > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}
		}

		return $result;
	}

	public function changeIconKategori($data)
	{
		global $myGlobal;
		$id = $data['id'];
		$kategoriInfo = $this->getKategoriProduk($id);
		$namaFile = $kategoriInfo['icon'];

		unlink("../images/cat_icon/" . $namaFile);
		$namaFileBaru = $myGlobal->uploadFile("../images/cat_icon/","gambar");

		$update = $myGlobal->exeQuery("UPDATE tblkategori SET icon = '$namaFileBaru' WHERE id = '$id'");

		if ( $update > 0 ) {
			$result = "0";
		} else {
			$result = "2";
		}

		return $result;
	}

	public function getProduk($limit = 0) {
		global $myGlobal;

		if ( $limit == 0 ) {
			$result = $myGlobal->query("SELECT * FROM tblproduk WHERE dlt = false ORDER BY id DESC");
		} else {
			$result = $myGlobal->query("SELECT * FROM tblproduk WHERE dlt = false ORDER BY id DESC LIMIT $limit");
		}
		return $myGlobal->query("SELECT * FROM tblproduk WHERE dlt = false");
	}

	public function addProduk($data)
	{
		global $myGlobal;
		$getID = $myGlobal->getNewId("tblproduk");
		$nama = $myGlobal->filterWord($data['nama']);
		$gambar = $myGlobal->uploadFile("../images/produk/","gambar");
		$harga = $myGlobal->filterWord($data['harga']);
		$kategori = $data['kategori'];
		$desc_singkat = $myGlobal->filterWord($data['descsingkat']);
		$deskripsi = $myGlobal->filterWord($data['deskripsi']);

		// Query for Product Checking
		$queryCheck = "SELECT * FROM tblproduk WHERE nama = '$nama' AND kategori_id = '$kategori' AND dlt = false";

		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$result = "1";
		} else {
			$queryInsert = "INSERT INTO tblproduk VALUES ('$getID','$kategori','$nama','$desc_singkat','$deskripsi','$harga','$gambar',false)";
			$insert = $myGlobal->exeQuery($queryInsert);

			if ( $insert > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}

			$stokID = $myGlobal->getNewId("tblstok");
			$myGlobal->exeQuery("INSERT INTO tblstok VALUES ('$stokID','$getID','0')");
		}

		return $result;
	}

	public function deleteProduk($id)
	{
		global $myGlobal;
		$queryCheck = "SELECT * FROM tblproduk WHERE id = $id";

		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$delete = $myGlobal->softDelete("tblproduk", "id", $id);
			if ( $delete > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}
		} else {
			$result = "3";
		}

		return $result;
	}

	public function getProdukInfo($id)
	{
		global $myGlobal;
		return $myGlobal->getData("SELECT * FROM tblproduk WHERE id = $id");
	}

	public function editProduk($data)
	{
		global $myGlobal;

		$id = $data['id'];
		$nama = $myGlobal->filterWord($data['nama']);
		$harga = $myGlobal->filterWord($data['harga']);
		$kategori = $data['kategori'];
		$desc_singkat = $myGlobal->filterWord($data['descsingkat']);
		$deskripsi = $myGlobal->filterWord($data['deskripsi']);

		$produkInfo = $this->getProdukInfo($id);
		$oldName = $produkInfo['nama'];
		$oldCategory = $produkInfo['kategori_id'];

		if ( strtolower($nama) <> strtolower($oldName) ) {
			$queryCheck = "SELECT * FROM tblproduk WHERE nama = '$nama' AND kategori_id = '$kategori' AND dlt = false";
			if ( $myGlobal->checkAvailability($queryCheck) ) {
				$result = "1";
				$continue = 0;
			} else {
				$continue = 1;
			}
		} else {
			$continue = 1;
		}

		if ( $continue == 1 ) {
			$queryInsert = "UPDATE tblproduk SET 
							kategori_id = '$kategori',
							nama = '$nama', 
							deskripsi_singkat = '$desc_singkat',
							deskripsi = '$deskripsi',
							harga = '$harga'
						  WHERE id = $id";
			$insert = $myGlobal->exeQuery($queryInsert);
			if ( $insert > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}
		}

		return $result;
	}

	public function changeGambarProduk($data)
	{
		global $myGlobal;
		$id = $data['id'];
		$produkInfo = $this->getProdukInfo($id);
		$namaFile = $produkInfo['gambar'];

		unlink("../images/produk/" . $namaFile);
		$namaFileBaru = $myGlobal->uploadFile("../images/produk/","gambar");

		$update = $myGlobal->exeQuery("UPDATE tblproduk SET gambar = '$namaFileBaru' WHERE id = '$id'");

		if ( $update > 0 ) {
			$result = "0";
		} else {
			$result = "2";
		}

		return $result;
	}

	public function getStokProduk($id)
	{
		global $myGlobal;
		return $myGlobal->getData("SELECT * FROM tblstok WHERE produk_id = $id")['stok'];
	}

	public function setStokProduk($data)
	{
		global $myGlobal;
		$id = $data['id'];
		$stok = $data['stok'];

		$update = $myGlobal->exeQuery("UPDATE tblstok SET stok = $stok WHERE produk_id = $id");
		if ( $update > 0 ) {
			$result = "0";
		} else {
			$result = "2";
		}

		return $result;
	}

	public function addStokProduk($data)
	{
		global $myGlobal;
		$id = $data['id'];
		$addstok = $data['stok'];

		$oldstok = $this->getStokProduk($id);

		$newStok = $addstok + $oldstok;

		$update = $myGlobal->exeQuery("UPDATE tblstok SET stok = $newStok WHERE produk_id = $id");
		if ( $update > 0 ) {
			$result = "0";
		} else {
			$result = "2";
		}

		return $result;
	}

	public function userRegistration($data)
	{
		global $myGlobal;
		$id = $myGlobal->getNewId("tbluser");
		$nama = $myGlobal->filterWord($data['name']);
		$email = $myGlobal->filterWord($data['email']);
		$username = $myGlobal->filterWord($data['username']);
		$password = $myGlobal->filterWord($data['password']);
		$password = password_hash($password, PASSWORD_DEFAULT);

		$queryCheck = "SELECT * FROM tbluser WHERE username = '$username'";

		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$result = "Username already exist";
		} else {
			$queryCheck = "SELECT * FROM tbluser WHERE email = '$email'";
			if ( $myGlobal->checkAvailability($queryCheck) ) {
				$result = "Email already Registered";
			} else {
				$queryInsert = "INSERT INTO tbluser VALUES ('$id','$nama','$username','$password','$email')";
				$insert = $myGlobal->exeQuery($queryInsert);

				if ( $insert > 0 ) {
					$result = "0";
				} else {
					$result = "2";
				}

				$queryInsert = "INSERT INTO tbluserdetail VALUES ('$id','$id','','default.png','','')";
				$myGlobal->exeQuery($queryInsert);
			}
		}

		return $result;
	}

	public function userLogin($data)
	{
		global $myGlobal;
		$username = $myGlobal->filterWord($data['username']);
		$password = $myGlobal->filterWord($data['password']);

		$queryCheck = "SELECT * FROM tbluser WHERE username = '$username'";
		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$data = $myGlobal->getData($queryCheck);
			if ( password_verify($password,$data['password']) ) {
				$myGlobal->setSession("userSess",true);
				$myGlobal->setSession("userInfo",$data);
				$result = "0";
			} else {
				$result = "Password didn't match";
			}
		} else {
			$result = "Username didn't exist";
		}

		return $result;
	}

	public function addToWishlist($data)
	{
		global $myGlobal;
		$id = $myGlobal->getNewId("tblwishlist");
		$userid = $data['user_id'];
		$produkid = $data['produk_id'];

		$queryCheck = "SELECT * FROM tblwishlist WHERE user_id = '$userid' AND produk_id = '$produkid'";
		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$result = "1";
		} else {
			$queryInsert = "INSERT INTO tblwishlist VALUES ('$id','$userid','$produkid')";
			$insert = $myGlobal->exeQuery($queryInsert);

			if ( $insert > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}
		}

		return $result;
	}

}

include 'siteinfo.php';
include 'sitetitle.php';
include 'request.php';


/*
	MESSAGE
	0  = Execution Success
	1! = Data Exist
	2! = Can't Insert Data
	3! = Data not Exist

	SESSION
	adminSess = Admin Login
	adminInfo = Admin Info
	userSess  = User Login
	userInfo  = User Info 
*/
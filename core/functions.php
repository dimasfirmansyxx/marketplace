<?php 

session_start();
date_default_timezone_set('Asia/Jakarta');
include 'connection.php';
include 'global.php';
include 'API/rajaongkir/app.php';

$myGlobal = new GlobalFunction();
$ongkirApp = new RajaOngkir("b63970fa62a2cc22f898e3f73170d166",true);

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

	public function logout($session)
	{
		global $baseurl;
		global $myGlobal;
		if ( $session == "adminSess" ) {
			$redirect = "/management";
		} else {
			$redirect = "/home";
		}

		session_destroy();
		$myGlobal->redirect($baseurl . $redirect);
	}

	public function getRegion($type, $value = 0)
	{
		global $myGlobal;
		if ( $type == "province" ) {
			$result = $myGlobal->query("SELECT * FROM tblprovince ORDER BY province ASC");
		} else {
			$result = $myGlobal->query("SELECT * FROM tblcity WHERE id_province = '$value' ORDER BY city ASC");
		}

		return $result;
	}

	public function getRegionInfo($type, $value)
	{
		global $myGlobal;
		if ( $type == "province" ) {
			$result = $myGlobal->getData("SELECT * FROM tblprovince WHERE id = '$value'");
		} else {
			$result = $myGlobal->getData("SELECT * FROM tblcity WHERE id = '$value'");
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
		$berat = $myGlobal->filterWord($data['berat']);
		$desc_singkat = $myGlobal->filterWord($data['descsingkat']);
		$deskripsi = $myGlobal->filterWord($data['deskripsi']);

		// Query for Product Checking
		$queryCheck = "SELECT * FROM tblproduk WHERE nama = '$nama' AND kategori_id = '$kategori' AND dlt = false";

		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$result = "1";
		} else {
			$queryInsert = "INSERT INTO tblproduk VALUES ('$getID','$kategori','$nama','$desc_singkat','$deskripsi','$harga','$gambar','$berat',false)";
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
		$berat = $myGlobal->filterWord($data['berat']);
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
							harga = '$harga',
							berat = '$berat'
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
				$queryInsert = "INSERT INTO tbluser VALUES ('$id','$nama','$username','$password','$email','bio')";
				$insert = $myGlobal->exeQuery($queryInsert);

				if ( $insert > 0 ) {
					$result = "0";
				} else {
					$result = "2";
				}
			}
		}

		return $result;
	}

	public function setUserDetail($data)
	{
		global $myGlobal;
		$newId = $myGlobal->getNewId("tbluserdetail");
		$userId = $data['id'];
		$provinsi = $myGlobal->filterWord($data['provinsi']);
		$kota = $myGlobal->filterWord($data['kota']);
		$alamat = $myGlobal->filterWord($data['alamat']);
		$kodepos = $myGlobal->filterWord($data['kodepos']);
		$nohp = $myGlobal->filterWord($data['nohp']);
		$foto = "default.png";
		$tgllahir = $myGlobal->filterWord($data['tgllahir']);
		$jk = $myGlobal->filterWord($data['jk']);

		if ( !(is_numeric($kodepos) || is_numeric($nohp)) ) {
			$result = "2";
		} else {
			$queryCheck = "SELECT * FROM tbluserdetail WHERE user_id = '$userId'";
			if ( $myGlobal->checkAvailability($queryCheck) ) {
				$result = "1";
			} else {
				$queryInsert = "INSERT INTO tbluserdetail VALUES ('$newId','$userId','$provinsi','$kota','$alamat',
																	'$kodepos','$nohp','$foto','$tgllahir','$jk')";
				$insert = $myGlobal->exeQuery($queryInsert);
				if ( $insert > 0 ) {
					$result = "0";
				} else {
					$result = "2";
				}
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

	public function getUserDetail($id)
	{
		global $myGlobal;
		$query = "SELECT * FROM tbluserdetail WHERE user_id = $id";
		if ( $myGlobal->checkAvailability($query) ) {
			$result = $myGlobal->getData($query);
		} else {
			$result = "3";
		}
		return $result;
	}

	public function getUserInfo($id)
	{
		global $myGlobal;
		$query = "SELECT * FROM tbluser WHERE id = '$id'";
		if ( $myGlobal->checkAvailability($query) ) {
			$result = $myGlobal->getData($query);
		} else {
			$result = "3";
		}
		return $result;
	}

	public function checkUserDetail($id)
	{
		global $myGlobal;
		global $baseurl;
		if ( $this->getUserDetail($id) == "3" ) {
			$myGlobal->redirect($baseurl . "/home/page/session/detail");
		} else {
			if ( $_SESSION["userInfo"]['verify'] == "email" ) {
				$myGlobal->redirect($baseurl . "/home/page/session/verify");
			} else {
				$myGlobal->setSession("userDetail",$this->getUserDetail($id));
			}
		}
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

	public function getTransactionId()
	{
		return date("YmdHis");
	}

	public function getTransactionInfo($user)
	{
		global $myGlobal;
		$queryCheck = "SELECT * FROM tblcart WHERE user_id = '$user'";
		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$result = $myGlobal->getData($queryCheck);
		} else {
			$result = "3";
		}

		return $result;
	}

	public function addToCart($data)
	{
		global $myGlobal;
		$user = $data['user_id'];
		$produk = $data['produk_id'];
		$qty = $data['qty'];
		$date = date("Y-m-d");
		$time = date("H:i:s");


		$getProductStok = $this->getStokProduk($produk);

		if ( $getProductStok < $qty ) {
			$result = "3";
		} elseif ( !is_numeric($qty) ) {
			$result = "2";
		} else {
			$queryCheck = "SELECT * FROM tblcart WHERE user_id = '$user'";
			if ( $myGlobal->checkAvailability($queryCheck) ) {
				$getData = $myGlobal->getData($queryCheck);
				$idTransaksi = $getData['id_transaksi'];

				$queryCheck = "SELECT * FROM tblcartdetail WHERE id_transaksi = '$idTransaksi' AND produk_id = '$produk'";
				if ( $myGlobal->checkAvailability($queryCheck) ) {
					$getData = $myGlobal->getData($queryCheck);
					$idDetail = $getData['id'];
					$oldQty = $getData['qty'];

					$newQty = $oldQty + $qty;
					$update = $myGlobal->exeQuery("UPDATE tblcartdetail SET qty = '$newQty' WHERE id = '$idDetail'");
					if ( $update > 0 ) {
						$result = "0";
					} else {
						$result = "2";
					}
				} else {
					$idDetail = $myGlobal->getNewId("tblcartdetail");
					$insert = $myGlobal->exeQuery("INSERT INTO tblcartdetail VALUES ('$idDetail','$idTransaksi','$produk','$qty')");
					if ( $insert > 0 ) {
						$result = "0";
					} else {
						$result = "2";
					}
				}
			} else {
				$idTransaksi = $this->getTransactionId();
				$idDetail = $myGlobal->getNewId("tblcartdetail");
				$insert = $myGlobal->exeQuery("INSERT INTO tblcart VALUES ('$idTransaksi','$user','$date','$time')");
				if ( $insert > 0 ) {
					$result = "0";
				} else {
					$result = "2";
				}

				$myGlobal->exeQuery("INSERT INTO tblcartdetail VALUES ('$idDetail','$idTransaksi','$produk','$qty')");
			}
		}

		return $result;

	}

	public function getCartItem($user)
	{
		global $myGlobal;
		$totalitem = $this->getTotalItemOnCart($user);
		if ( $totalitem > 0 ) {
			$get = $myGlobal->getData("SELECT * FROM tblcart WHERE user_id = '$user'");
			$idTransaksi = $get['id_transaksi'];
			$result = $myGlobal->query("SELECT * FROM tblcartdetail WHERE id_transaksi = '$idTransaksi'");
		} else {
			$result = "0";
		}

		return $result;
	}

	public function setNewQty($data)
	{
		global $myGlobal;
		$id = $data['id'];
		$qty = $data['qty'];
		$produk = $data['produk'];

		if ( !is_numeric($qty) ) {
			$result = "2";
		} else {
			$getStock = $this->getStokProduk($produk);

			if ( $getStock < $qty ) {
				$result = "3";
			} else {
				$query = "UPDATE tblcartdetail SET qty = '$qty' WHERE id = '$id'";
				$update = $myGlobal->exeQuery($query);
				if ( $update > 0 ) {
					$result = "0";
				} else {
					$result = "2";
				}
			}
		}

		return $result;
	}

	public function getTotalItemOnCart($user)
	{
		global $myGlobal;
		$queryCheck = "SELECT * FROM tblcart WHERE user_id = '$user'";
		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$get = $myGlobal->getData($queryCheck);
			$idTransaksi = $get['id_transaksi'];
			$result = $myGlobal->numRows("SELECT * FROM tblcartdetail WHERE id_transaksi = '$idTransaksi'");
		} else {
			$result = "0";
		}

		return $result;
	} 

	public function getTotalPriceOnCart($user)
	{
		global $myGlobal;
		$queryCheck = "SELECT * FROM tblcart WHERE user_id = '$user'";
		$totalPrice = 0;
		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$get = $myGlobal->getData($queryCheck);
			$idTransaksi = $get['id_transaksi'];
			$getDetail = $myGlobal->query("SELECT * FROM tblcartdetail WHERE id_transaksi = '$idTransaksi'");
			foreach ($getDetail as $row) {
				$produk = $this->getProdukInfo($row['produk_id']);
				$price = $produk['harga'] * $row['qty'];
				$totalPrice = $totalPrice + $price;
				$result = $totalPrice;
			}
		} else {
			$result = "0";
		}

		return $result;
	}

	public function getItemWeight($user)
	{
		global $myGlobal;
		$get = $myGlobal->getData("SELECT * FROM tblcart WHERE user_id = '$user'");
		$idTransaksi = $get['id_transaksi'];
		$getDetail = $myGlobal->query("SELECT * FROM tblcartdetail WHERE id_transaksi = '$idTransaksi'");
		$totalberat = 0;
		foreach ($getDetail as $row) {
			$produk = $this->getProdukInfo($row['produk_id']);
			$totalberat = $totalberat + $produk['berat'];
			if ( $row['qty'] > 1 ) {
				$i = 1;
				while ($i < $row['qty']) {
					$totalberat = $totalberat + $produk['berat'];
					$i++;
				}
			}
		}

		return $totalberat;
	}

	public function deleteCart($id, $user)
	{
		global $myGlobal;
		$queryDelete = "DELETE FROM tblcartdetail WHERE id = $id";
		$delete = $myGlobal->exeQuery($queryDelete);

		if ( $delete > 0 ) {
			$result = "0";
			if ( $this->getTotalItemOnCart($user) == "0" ) {
				$myGlobal->exeQuery("DELETE FROM tblcart WHERE user_id = '$user'");
			}
		} else {
			$result = "2";
		}

		return $result;
	}

	public function getOngkir($destination, $expedition, $weight, $package)
	{
		global $ongkirApp;
		$getData = $ongkirApp->getCost("48","$destination","$weight","$expedition");
		$decode = json_decode($getData,true);
		if ( $expedition == "jne" ) {
			if ( $package == "jne reg" ) {
				$result = $decode['rajaongkir']['results'][0]['costs']['1']['cost'][0]['value'];
			} else {
				$result = $decode['rajaongkir']['results'][0]['costs']['0']['cost'][0]['value'];
			}
		} else {
			$result = $decode['rajaongkir']['results'][0]['costs']['0']['cost'][0]['value'];
		}

		return $result;
	}



	public function makeOrder($expedition, $user, $package)
	{
		global $myGlobal;
		$id_transaksi = $this->getTransactionInfo($user)['id_transaksi'];
		$date = date("Y-m-d");
		$time = date("H:i:s");
		$status = "pending";

		$insert = $myGlobal->exeQuery("INSERT INTO tblorder VALUES ('$id_transaksi','$user','$date','$time','$status')");

		if ( $insert > 0 ) {
			$result = "0";
		} else {
			$result = "2";
		}

		$userDetail = $this->getUserDetail($user);
		$weight = $this->getItemWeight($user);
		$noresi = "0";
		$alamat = $userDetail['alamat'];
		$kota = $userDetail['kota'];
		$provinsi = $userDetail['provinsi'];
		$nohp = $userDetail['no_hp'];
		$shoppingTotal = (int) $this->getTotalPriceOnCart($user);
		$ppn = $shoppingTotal * 10 / 100;
		$subtotal = $shoppingTotal + $ppn;
		$ongkir = (int) $this->getOngkir($kota, $expedition, $weight, $package);
		$total = $subtotal + $ongkir;

		if ( $expedition == "jne" ) {
			$expedition = $package;
		}

		$myGlobal->exeQuery("INSERT INTO tblinvoice VALUES ('$id_transaksi','$noresi','$expedition','$alamat','$kota','$provinsi','$nohp','$subtotal','$ongkir','$total')");

		$cartItem = $this->getCartItem($user);
		foreach ($cartItem as $row) {
			$thisid = $myGlobal->getNewId("tblinvoicedetail");
			$thistransaksi = $id_transaksi;
			$thisproduk = $row['produk_id'];
			$thisqty = $row['qty'];

			$myGlobal->exeQuery("INSERT INTO tblinvoicedetail VALUES ('$thisid','$thistransaksi','$thisproduk','$thisqty')");
		}

		$myGlobal->exeQuery("DELETE FROM tblcartdetail WHERE id_transaksi = '$id_transaksi'");
		$myGlobal->exeQuery("DELETE FROM tblcart WHERE id_transaksi = '$id_transaksi'");

		return $result;

	}

	public function getOrderList($status, $user = 0)
	{
		global $myGlobal;
		$query = "SELECT * FROM tblorder WHERE status = '$status'";
		return $myGlobal->query($query);
	}

	public function getUserOrder($status, $user)
	{
		global $myGlobal;
		
		if ( $status == "progress" ) {
			$query = "SELECT * FROM tblorder WHERE user_id = '$user' AND
						status = 'pending' OR status = 'request' OR status = 'prepare' OR status = 'ongoing'
						OR status = 'confirm'";
		} elseif ( $status == "done" ) {
			$query = "SELECT * FROM tblorder WHERE user_id = '$user' AND status = 'success'";
		} elseif ( $status == "decline" ) {
			$query = "SELECT * FROM tblorder WHERE user_id = '$user' AND status = 'decline'";
		}

		if ( $myGlobal->numRows($query) > 0 ) {
			$result = $myGlobal->query($query);
		} else {
			$result = "3";
		}

		return $result;

		/* 
			status
			`progress` = pending, request, prepare, ongoing, confirm
			`done` = success
			`decline` = decline
		*/
	}

	public function getInvoiceDetail($transaction)
	{
		global $myGlobal;
		$result = [];
		$query = "SELECT * FROM tblinvoicedetail WHERE id_transaksi = '$transaction'";
		$get = $myGlobal->query($query);
		foreach ($get as $row) {
			$produkInfo = $this->getProdukInfo($row['produk_id']);
			$item = [];
			$item["produk"] = ucwords($produkInfo['nama']);
			$item["harga"] = $produkInfo['harga'];
			$item["qty"] = $row['qty'];
			$item["subtotal"] = $produkInfo['harga'] * $row['qty'];

			$result[] = $item;
		}

		return $result;
	}

	public function deleteOrder($transaction)
	{
		global $myGlobal;

		$query = "SELECT * FROM tblorder WHERE id_transaksi = '$transaction'";
		if ( $myGlobal->checkAvailability($query) ) {
			$data = $myGlobal->getData($query);
			$myGlobal->exeQuery("DELETE FROM tblinvoicedetail WHERE id_transaksi = '$transaction'");
			$myGlobal->exeQuery("DELETE FROM tblinvoice WHERE id_transaksi = '$transaction'");
			$delete = $myGlobal->exeQuery("DELETE FROM tblorder WHERE id_transaksi = '$transaction'");
			if ( $delete > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}

			$message = "PESANAN $transaction SUDAH DIBATALKAN.";
			$user = $data['user_id'];
			$msgID = $myGlobal->getNewId("tblnotification");
			$myGlobal->exeQuery("INSERT INTO tblnotification VALUES ('$msgID','$user','$message','unread')");
		} else {
			$result = "3";
		}

		return $result;
	}

	public function getTotalNotification($user)
	{
		global $myGlobal;
		$queryCheck = "SELECT * FROM tblnotification WHERE user_id = '$user' AND status = 'unread'";
		if ( $myGlobal->checkAvailability($queryCheck) ) {
			$result = $myGlobal->numRows($queryCheck);
		} else {
			$result = "0";
		}

		return $result;
	}

	public function uploadProofOfPayment($data)
	{
		global $myGlobal;
		$getId = $myGlobal->getNewId("tblrequest");
		$transaction = $data['transaction'];
		$user = $data['user'];
		$allowExtension = ["jpg","jpeg","png","bmp"];
		$checkFile = $myGlobal->filterFile("gambar",$allowExtension);
		if ( $checkFile == "0" ) {
			if ( $myGlobal->checkAvailability("SELECT * FROM tblrequest WHERE transaksi_id = '$transaction'") ) {
				$result = "1";
			} else {
				$bukti = $myGlobal->uploadFile("../images/bukti_pembayaran/","gambar");
				$queryInsert = "INSERT INTO tblrequest VALUES ('$getId','$transaction','$user','$bukti')";
				$insert = $myGlobal->exeQuery($queryInsert);
				if ( $insert > 0 ) {
					$result = "0";
				} else {
					$result = "2";
				}

				$myGlobal->exeQuery("UPDATE tblorder SET status = 'request' WHERE id_transaksi = '$transaction'");
			}
		} else {
			$result = "5";
		}

		return $result;
	}

	public function getProofOfPayment($transaction)
	{
		global $myGlobal;
		return $myGlobal->getData("SELECT * FROM tblrequest WHERE transaksi_id = '$transaction'");
	}

	public function acceptOrder($transaction)
	{
		global $myGlobal;

		$query = "SELECT * FROM tblorder WHERE id_transaksi = '$transaction'";
		if ( $myGlobal->checkAvailability($query) ) {
			$data = $myGlobal->getData($query);
			$update = $myGlobal->exeQuery("UPDATE tblorder SET status = 'confirm' WHERE id_transaksi = '$transaction'");
			if ( $update > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}

			$message = "PEMBAYARAN PADA ORDERAN $transaction SUDAH DITERIMA.";
			$user = $data['user_id'];
			$msgID = $myGlobal->getNewId("tblnotification");
			$myGlobal->exeQuery("INSERT INTO tblnotification VALUES ('$msgID','$user','$message','unread')");
		} else {
			$result = "3";
		}

		return $result;
	}

	public function declineOrder($transaction,$reason)
	{
		global $myGlobal;

		$query = "SELECT * FROM tblorder WHERE id_transaksi = '$transaction'";
		if ( $myGlobal->checkAvailability($query) ) {
			$data = $myGlobal->getData($query);
			$update = $myGlobal->exeQuery("UPDATE tblorder SET status = 'decline' WHERE id_transaksi = '$transaction'");
			if ( $update > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}

			$user = $data['user_id'];
			$msgID = $myGlobal->getNewId("tblnotification");
			$myGlobal->exeQuery("INSERT INTO tblnotification VALUES ('$msgID','$user','$reason','unread')");
		} else {
			$result = "3";
		}

		return $result;
	}

	public function prepStatusOrder($transaction)
	{
		global $myGlobal;

		$query = "SELECT * FROM tblorder WHERE id_transaksi = '$transaction'";
		if ( $myGlobal->checkAvailability($query) ) {
			$data = $myGlobal->getData($query);
			$update = $myGlobal->exeQuery("UPDATE tblorder SET status = 'prepare' WHERE id_transaksi = '$transaction'");
			if ( $update > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}

			$user = $data['user_id'];
			$msgID = $myGlobal->getNewId("tblnotification");
			$msg = "ORDERAN $transaction SEDANG DISIAPKAN";
			$myGlobal->exeQuery("INSERT INTO tblnotification VALUES ('$msgID','$user','$msg','unread')");

		} else {
			$result = "3";
		}

		return $result;
	}

	public function getInvoice($transaction)
	{
		global $myGlobal;

		$order = $myGlobal->getData("SELECT * FROM tblorder WHERE id_transaksi = '$transaction'");
		$invoice = $myGlobal->getData("SELECT * FROM tblinvoice WHERE id_transaksi = '$transaction'");
		$user = $this->getUserInfo($order['user_id']);
		$kota = $this->getRegionInfo("city", $invoice['kota']);
		$provinsi = $this->getRegionInfo("province", $invoice['provinsi']);

		$alamat = $invoice['alamat'] . ". " . $kota['city'] . ", " . $provinsi['province'];

		$result = [
			"nama" => $user['nama'],
			"alamat" => $alamat,
			"nohp" => $invoice['nohp'],
			"ekspedisi" => strtoupper($invoice['ekspedisi']),
		];

		return $result;
	}

	public function sendItem($transaction,$resi)
	{
		global $myGlobal;

		$query = "SELECT * FROM tblorder WHERE id_transaksi = '$transaction'";
		if ( $myGlobal->checkAvailability($query) ) {
			$data = $myGlobal->getData($query);
			$update = $myGlobal->exeQuery("UPDATE tblorder SET status = 'ongoing' WHERE id_transaksi = '$transaction'");
			if ( $update > 0 ) {
				$result = "0";
			} else {
				$result = "2";
			}

			$myGlobal->exeQuery("UPDATE tblinvoice SET no_resi = '$resi' WHERE id_transaksi = '$transaction'");


			$user = $data['user_id'];
			$msgID = $myGlobal->getNewId("tblnotification");
			$msg = "ORDERAN $transaction SUDAH DIKIRIM. NOMOR RESI $resi";
			$myGlobal->exeQuery("INSERT INTO tblnotification VALUES ('$msgID','$user','$msg','unread')");

		} else {
			$result = "3";
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
	4! = Need Login
	5! = Forbidden

	SESSION
	adminSess  = Admin Login
	adminInfo  = Admin Info
	userSess   = User Login
	userInfo   = User Info 
	userDetail = User Detail
*/
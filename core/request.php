<?php 

$myFunc = new AllFunction();
$myGlobal = new GlobalFunction();

if ( isset($_GET['cmd']) ) {
	if ( $_GET['cmd'] == "setSession" ) {
		$myGlobal->setSession($_POST['name'],$_POST['value']);
	} elseif ( $_GET['cmd'] == "getProduk" ) {
		echo json_encode($myFunc->getProduk());
	} elseif ( $_GET['cmd'] == "addProduk" ) {
		echo json_encode($myFunc->addProduk($_POST));
	} elseif ( $_GET['cmd'] == "deleteProduk" ) {
		echo json_encode($myFunc->deleteProduk($_POST['id']));
	} elseif ( $_GET['cmd'] == "getProdukInfo" ) {
		echo json_encode($myFunc->getProdukInfo($_POST['id']));
	} elseif ( $_GET['cmd'] == "editProduk" ) {
		echo json_encode($myFunc->editProduk($_POST));
	} elseif ( $_GET['cmd'] == "changeGambarProduk" ) {
		echo json_encode($myFunc->changeGambarProduk($_POST));
	} elseif ( $_GET['cmd'] == "getStokProduk" ) {
		echo json_encode($myFunc->getStokProduk($_POST['id']));
	} elseif ( $_GET['cmd'] == "setStokProduk" ) {
		echo json_encode($myFunc->setStokProduk($_POST));
	} elseif ( $_GET['cmd'] == "addStokProduk" ) {
		echo json_encode($myFunc->addStokProduk($_POST));
	} elseif ( $_GET['cmd'] == "getKategoriProduk" ) {
		echo json_encode($myFunc->getKategoriProduk($_POST['id']));
	} elseif ( $_GET['cmd'] == "addKategori" ) {
		echo json_encode($myFunc->addKategori($_POST));
	} elseif ( $_GET['cmd'] == "deleteKategori" ) {
		echo json_encode($myFunc->deleteKategori($_POST['id']));
	} elseif ( $_GET['cmd'] == "editKategori" ) {
		echo json_encode($myFunc->editKategori($_POST));
	} elseif ( $_GET['cmd'] == "changeIconKategori" ) {
		echo json_encode($myFunc->changeIconKategori($_POST));
	} elseif ( $_GET['cmd'] == "userRegistration" ) {
		echo json_encode($myFunc->userRegistration($_POST));
	} elseif ( $_GET['cmd'] == "userLogin" ) {
		echo json_encode($myFunc->userLogin($_POST));
	} elseif ( $_GET['cmd'] == "addToWishlist" ) {
		echo json_encode($myFunc->addToWishlist($_POST));
	} elseif ( $_GET['cmd'] == "addToCart" ) {
		echo json_encode($myFunc->addToCart($_POST));
	} elseif ( $_GET['cmd'] == "getTotalItemOnCart" ) {
		echo json_encode($myFunc->getTotalItemOnCart($_POST['id']));
	} elseif ( $_GET['cmd'] == "setNewQty" ) {
		echo json_encode($myFunc->setNewQty($_POST));
	} elseif ( $_GET['cmd'] == "deleteCart" ) {
		echo json_encode($myFunc->deleteCart($_POST['id'],$_POST['user']));
	} elseif ( $_GET['cmd'] == "getRegion" ) {
		echo json_encode($myFunc->getRegion($_POST['type'],$_POST['value']));
	} elseif ( $_GET['cmd'] == "setUserDetail" ) {
		echo json_encode($myFunc->setUserDetail($_POST));
	}
}
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
	} elseif ( $_GET['cmd'] == "getTotalPriceOnCart" ) {
		echo json_encode($myFunc->getTotalPriceOnCart($_POST['user']));
	} elseif ( $_GET['cmd'] == "getOngkir" ) {
		echo json_encode($myFunc->getOngkir($_POST['destination'],$_POST['expedition'],$_POST['weight'],$_POST['package']));
	} elseif ( $_GET['cmd'] == "makeOrder" ) {
		echo json_encode($myFunc->makeOrder($_POST['expedition'],$_POST['user'],$_POST['package']));
	} elseif ( $_GET['cmd'] == "getInvoiceDetail" ) {
		echo json_encode($myFunc->getInvoiceDetail($_POST['transaction']));
	} elseif ( $_GET['cmd'] == "deleteOrder" ) {
		echo json_encode($myFunc->deleteOrder($_POST['transaction']));
	} elseif ( $_GET['cmd'] == "getTotalNotification" ) {
		echo json_encode($myFunc->getTotalNotification($_POST['id']));
	} elseif ( $_GET['cmd'] == "uploadProofOfPayment" ) {
		echo json_encode($myFunc->uploadProofOfPayment($_POST));
	} elseif ( $_GET['cmd'] == "getProofOfPayment" ) {
		echo json_encode($myFunc->getProofOfPayment($_POST['transaction']));
	} elseif ( $_GET['cmd'] == "acceptOrder" ) {
		echo json_encode($myFunc->acceptOrder($_POST['transaction']));
	} elseif ( $_GET['cmd'] == "declineOrder" ) {
		echo json_encode($myFunc->declineOrder($_POST['transaction'],$_POST['reason']));
	} elseif ( $_GET['cmd'] == "prepStatusOrder" ) {
		echo json_encode($myFunc->prepStatusOrder($_POST['transaction']));
	} elseif ( $_GET['cmd'] == "getInvoice" ) {
		echo json_encode($myFunc->getInvoice($_POST['transaction']));
	} elseif ( $_GET['cmd'] == "sendItem" ) {
		echo json_encode($myFunc->sendItem($_POST['transaction'],$_POST['resi']));
	}
}
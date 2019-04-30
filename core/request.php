<?php 

$myFunc = new AllFunction();
$myGlobal = new GlobalFunction();

if ( isset($_GET['cmd']) ) {
	if ( $_GET['cmd'] == "setSession" ) {
		$myGlobal->setSession($_POST['name'],$_POST['value']);
	} elseif ( $_GET['cmd'] == "getProduk" ) {
		echo json_encode($myGlobal->getProduk());
	}
}
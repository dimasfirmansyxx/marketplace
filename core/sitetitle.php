<?php 

$url = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

$url = "http://" . $url;

$siteTitle = "untitled";

// This part for product title
$myFunc = new AllFunction();
$explode = explode("/", $url);
$counting = count($explode);
$getParam1 = $explode[$counting-2];
$getParam2 = end($explode);
if ( $getParam1 == "product" && is_numeric($getParam2) ) {
	$getProduk = $myFunc->getProdukInfo($getParam2);
	$siteTitle = ucwords($getProduk['nama']) . " - " . $siteName;
}
// End part of product title

if ( $siteTitle == "untitled" ) {
	switch ( $url ) {
		case "$baseurl/home/page/product/all":
			$siteTitle = "Semua Produk - $siteName";
			break;

		case "$baseurl/home/page/session/login":
			$siteTitle = "Login - $siteName";
			break;

		case "$baseurl/home/page/session/register":
			$siteTitle = "Registrasi - $siteName";
			break;

		case "$baseurl/home":
			$siteTitle = "Beranda - $siteName";
			break;
		

		default:
			$siteTitle = "Beranda - $siteName";
			break;
	}
}
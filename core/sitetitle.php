<?php 

$url = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

$url = "http://" . $url;

switch ( $url ) {
	case "$baseurl/home/page/products":
		$siteTitle = "Semua Produk - $siteName";
		break;


	case "$baseurl/home":
		$siteTitle = "Beranda - $siteName";
		break;
	

	default:
		$siteTitle = "Beranda - $siteName";
		break;
}
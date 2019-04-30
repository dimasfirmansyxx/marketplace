<?php 

$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

switch ( $url ) {
	case " $baseurl/home ":
		$siteTitle = "Home - $siteName";
		break;
	
	default:
		$siteTitle = "Home - $siteName";
		break;
}
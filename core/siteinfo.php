<?php
$myFunc = new AllFunction();

$siteIdentity = $myFunc->siteIdentity();

$baseurl = $siteIdentity['baseurl'];
$siteName = $siteIdentity['sitename'];
$contactMail = $siteIdentity['contactmail'];
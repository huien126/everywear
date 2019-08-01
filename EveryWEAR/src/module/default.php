<?php 
	session_name("EWSESSID");
	session_start();
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("X-Session: ".(isset($_SESSION["EWUID"])?explode("@", $_SESSION["EWUID"])[0]:'false'));
	

	include 'module/browser.php';

	$browser = getBrowser();
	$browser = $browser['name'];
	$pjax = false;

	if ($_SERVER["HTTP_X_XMLHTTPREQUEST"] == 'true') {
		$pjax = true;
	}
	
	$imgExtention = "png";
	$webp = false;
	if ($browser == "Google Chrome" || $browser == "Opera" || $_COOKIE["webp"] === "true") {
		$imgExtention = "webp";
		$webp = true;
	};
	$htmlAttribute = "lang=\"ko\" data-browser=\"".$browser."\" data-render-webp=\"".($webp?"true":"false")."\"";
?>
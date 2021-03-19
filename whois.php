<?php
// Whois Lookup using api.hackertarget.com
echo "<html>\n<head><title>Whois Lookup</title>\n</head>\n<body>\n<style>@import url(\"//fonts.googleapis.com/css?family=Iceland\");@import url(\"//fonts.googleapis.com/css?family=Iceberg\");@import url(\"//fonts.googleapis.com/css?family=Quicksand\");body{background-color:#212121;color: white;text-shadow: 1px 0px 2px black, 1px 0px 2px black, 0px 1px 2px black;font-family:Quicksand;text-align:center;}a{text-decoration: none;}</style>\n<table width=\"100%\" height=\"100%\">\n<td align=\"center\">\n<center><font face='Iceland' size='7'><a href='".htmlspecialchars($_SERVER['PHP_SELF'])."' style='text-decoration: none; text-shadow: 2px 0px 4px black, 3px 0px 5px black, 0px 3px 4px black; font-weight: bold;color:red;'>Whois Lookup</a></font><br>\n<form name=\"data\" method=\"post\">\n<input type=\"text\" name=\"host\" placeholder=\"site.com\" required></input><br>\n<input type=\"submit\" name='submit' value=\"Submit\"><br>\n</form>";
	
	$hostname = htmlspecialchars($_POST['host']);
	
	function curl($url){
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		$data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			return ($httpcode>=200 && $httpcode<300) ? $data : false;
	}
	
	if($_POST['submit']){
		$curl = curl("http://api.hackertarget.com/whois/?q=".$hostname);
		$result = htmlspecialchars($curl);
		
		echo "<textarea style='width: 942px; height: 245px; background-color: transparent; border: 1px solid aquamarine; color: white; text-shadow: 2px 0px 4px black, 3px 0px 5px black, 0px 3px 4px black; font-family: Courier; font-size: 15px;' readonly>".$result."\n</textarea>";
	}
	echo "</center>";
?>

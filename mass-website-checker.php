<html>
<head>
<title>Website Checker (HTTP/HTTPS)</title>
</head>
<body><style>@import url("//fonts.googleapis.com/css?family=Iceland");@import url("//fonts.googleapis.com/css?family=Courier");@import url("//fonts.googleapis.com/css?family=Quicksand");@import url("//fonts.googleapis.com/css?family=Monospace");body{background-color: #202124; color: #d9d9d9; text-align: center;font-family:Quicksand;}textarea{background-color:transparent;color:aquamarine;font-family:Monospace;}</style>
<table width="100%" height="100%">
<td align="center">
<font face='Iceland' size='7'>
<a href='javascript:window.location.reload(true)' style='text-decoration: none; text-shadow: 2px 0px 4px black, 3px 0px 5px black, 0px 3px 4px black; font-weight: bold;color:red;'>Website Checker (HTTP/HTTPS)</a>
</font><br>
<form method='POST' action>
<textarea type='text' class='form-control' type='text' style='color: white; width: 450px; height: 150px;' placeholder='site.com' name='site' value='<?=htmlspecialchars(@$_REQUEST['name']);?>' required></textarea>
<br><input type='submit' class='btn btn-success' name='submit' value='Submit'></form>
<?php
// this is Mass Website Checker (HTTP or HTTPS)
// hope this tool helps all of you

function has_ssl( $domain ) {
	$ssl_check = @fsockopen( 'ssl://' . $domain, 443, $errno, $errstr, 30 );
	$res = !! $ssl_check;
	if ( $ssl_check ) {
		fclose( $ssl_check );
	}
	return $res;
}
	
$url = explode("\r\n",$_POST['site']);
	if($_POST['submit']){
		
		foreach ($url as $sites){
			if (function_exists('curl_exec')) {
				$domain = 'https://'.$sites.'/';
				$ch = curl_init($domain);
					  curl_setopt($ch, CURLOPT_HEADER, true);
					  curl_setopt($ch, CURLOPT_NOBODY, true);
					  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
					  curl_setopt($ch, CURLOPT_TIMEOUT,10);
				$output = curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
							curl_close($ch);
							
					if ($httpcode == null) {
						print_r('<font color="#ff0000" face="Courier" size="3">(<a href="http://'.$sites.'" target="_blank" style="text-decoration: none; color: #ff0000;">'.$sites.'</a> | IP Host : '.gethostbyname($sites).') SERVER HTTP | SSL Disabled</font><br>');
					} else {
						print_r('<font color="#00ff00" face="Courier" size="3">(<a href="https://'.$sites.'" target="_blank" style="text-decoration: none; color: #00ff00;">'.$sites.'</a> | IP Host : '.gethostbyname($sites).') SERVER HTTP(s) | SSL Enabled</font><br>');
					}
			}
			
			elseif (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
				print_r('<font color="#00ff00" face="Courier" size="3">(<a href="https://'.$sites.'" target="_blank" style="text-decoration: none; color: #00ff00;">'.$sites.'</a> | IP Host : '.gethostbyname($sites).') SERVER HTTP(s) | SSL Enabled</font><br>');
			} else {
				if (has_ssl($sites) == null) {
					print_r('<font color="#ff0000" face="Courier" size="3">(<a href="http://'.$sites.'" target="_blank" style="text-decoration: none; color: #ff0000;">'.$sites.'</a> | IP Host : '.gethostbyname($sites).') SERVER HTTP | SSL Disabled</font><br>');
				} else {
					print_r('<font color="#00ff00" face="Courier" size="3">(<a href="https://'.$sites.'" target="_blank" style="text-decoration: none; color: #00ff00;">'.$sites.'</a> | IP Host : '.gethostbyname($sites).') SERVER HTTP(s) | SSL Enabled</font><br>');
				}
			}
		}
	}
?>
</td>
</table>
</body>
</html>

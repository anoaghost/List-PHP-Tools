<?php
// Zone-H Mass Poster
echo "<html>\n<head><title>Zone-H Mass Poster</title>\n</head>\n<body>\n<style>@import url(\"//fonts.googleapis.com/css?family=Iceland\");@import url(\"//fonts.googleapis.com/css?family=Iceberg\");@import url(\"//fonts.googleapis.com/css?family=Quicksand\");body{background-color:#212121;color: white;text-shadow: 1px 0px 2px black, 1px 0px 2px black, 0px 1px 2px black;font-family:Quicksand;text-align:center;}a{text-decoration: none;}</style>\n<table width=\"100%\" height=\"100%\">\n<td align=\"center\">\n<center><font face='Iceland' size='7'><a href='".htmlspecialchars($_SERVER['PHP_SELF'])."' style='text-decoration: none; text-shadow: 2px 0px 4px black, 3px 0px 5px black, 0px 3px 4px black; font-weight: bold; color:red;'>Zone-H Mass Poster</a></font><br>\n";

$submit = $_POST['submit'];
if($_POST['submit']) {
	$domain = explode("\r\n", $_POST['url']);
	$nick =  $_POST['nick'];
	echo "</br>\n";
	echo "<br>Defacer Onhold: <a href='http://www.zone-h.org/archive/notifier=$nick/published=0' target='_blank'>http://www.zone-h.org/archive/notifier=$nick/published=0</a><br>\n";
	echo "Defacer Archive: <a href='http://www.zone-h.org/archive/notifier=$nick' target='_blank'>http://www.zone-h.org/archive/notifier=$nick</a><br><br>\n";
	
	function zoneh($url,$nick) {
		$ch = curl_init("http://www.zone-h.com/notify/single");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "defacer=$nick&domain1=$url&hackmode=1&reason=1&submit=Send");
			return curl_exec($ch);
			curl_close($ch);
	}
	
	foreach($domain as $url) {
		$zoneh = zoneh($url,$nick);
		if(preg_match("/color=\"red\">OK<\/font><\/li>/i", $zoneh)) {
			echo "$url -> <font color=lime>OK</font><br>\n";
			} else {
				echo "$url -> <font color=red>ERROR</font><br>\n";
			}
	}
} else {
	echo "<form method='post'><u style='color: lime; font-size:15px; font-family: Iceberg'>Defacer</u>: <br>\n<input type='text' name='nick' size='50' placeholder='Notifier' style='background-color: transparent; color: lime; border: 1px solid aquamarine;'><br>\n<u style='color: lime; font-size:15px; font-family: Iceberg;'>Domains</u>: <br>\n<textarea style='width: 450px; height: 150px; background-color: transparent; color: red; border: 1px solid aquamarine;' name='url' required></textarea><br>\n<input type='submit' name='submit' value='Submit' style='width: 450px; border: 1px solid aquamarine;'>\n</form>\n";
	}
	echo "</center>\n</td>\n</table>\n</body>\n</html>\n";
?>

<html>
<head>
<title>View Source URL</title>
<link rel="stylesheet" href="//markdownmonster.west-wind.com/docs/templates/scripts/highlightjs/styles/vs2015.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.11.0/highlight.min.js"></script>
</head>
<body>
<style>
body {
	background-color:#212121;
	color: white;
}

.result {
    display: none;
    white-space: pre-wrap;
    word-break: break-word;
    width: 100%;
    margin: 10px auto;
    padding: 0px 10px 10px 20px;
    font-size: 13px;
    overflow-y: scroll;
    border: 1px solid #d6d6d6;
    background: #151313;
    height: 100%;
}
</style>
<table width="100%" height="100%">
<td align="center">
<center>
<font face='Iceland' size='7'><a href='javascript:window.assign("//anoaghost.github.io")' style='text-decoration: none; text-shadow: 2px 0px 4px black, 3px 0px 5px black, 0px 3px 4px black; font-weight: bold;color:red;'>View Source Website or URL</a></font><br>
<form name="data" method="post">
<label for="host">URL:</label><br><input type="text" name="host" placeholder="URL" required></input><br>
<input type="submit" name='submit' value="Submit"><br>
</form>
</center>
<?php
$url = htmlspecialchars($_POST['host']);
$parseurl = parse_url($url)['host'];
if($_POST['submit']){
	$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
	$content = curl_exec($ch);
		curl_close($ch);
	$result = htmlspecialchars($content);
		
	echo "<center><b>URL : ".$url."<br>\n IP : ".gethostbyname($parseurl)."</b></center><br><pre class=\"result\" style=\"width: 950px; height: 450px !important; margin: 20px auto 0px; padding: 7px; text-align: left !important; display: block;\"><code class=\"language-html\">".$result."\n</code></pre>";
}
?>
<script>
function highlightCode() {
    var pres = document.querySelectorAll("pre>code");
    for (var i = 0; i < pres.length; i++) {
        hljs.highlightBlock(pres[i]);
    }
}
highlightCode();
</script>
</td>
</table>
</body>
</html>

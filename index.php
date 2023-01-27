<!DOCTYPE html>
<html>
<head>
  <title>force-physical-location-visit</title>
  <meta charset="UTF-8">
  <script src="easy.qrcode.js"></script>
</head>

<body>
<center>
<h1><a href="index.php">force-physical-location-visit</a></h1>
<?php
// Remember to change the following password:
$secret_password = "uc489u937gnc34";

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
	 $url = "https://";   
else  
	 $url = "http://";   
$url.= $_SERVER['HTTP_HOST'];   
$url.= $_SERVER['REQUEST_URI'];    
$days = $_POST['days'];
$link = $_GET['l'];

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

if (isset($days)) {
	$passwords = "";
	$today = date("Ymd");
	$entries = "";
	for ($i = 1; $i <= $days; $i++) {
		$date = new DateTime($today);
		$date->modify('+'.$i.' day');
		$today_plus = $date->format('Ymd');
		$link = $today_plus.randomPassword();
		$hash = substr(hash('ripemd160', $link.$secret_password), 0, 10);
		$passwords = $passwords.$hash;
		$hyperlink = $url."?l=".$link;
		$entries =  $entries."<div style='float:left;margin:10px;'>Day ".$i."<br><small>".$hyperlink."</small><br><div id='qrcode".$i."'></div>";
		$entries =  $entries."<script>var qrcode = new QRCode(document.getElementById('qrcode".$i."'),{text: '".$hyperlink."'});</script>";
		$entries =  $entries."</div>";
	}
	echo "<p>Encrypt valueable data (e. g. important passwords or family photos) with this key:</p><p>".$passwords."</p>";
	echo "<p>To get the key back, visit the correct URL on each day between 00:00 - 23:59, otherwise your password will be lost.<br>To force yourself to visit a physical location, you can print out the following QR codes and place the paper on the location. Then, you are <i>forced</i> to go there on each day.</p>".$entries;
}
else if (isset($link)) {
	$today = date("Ymd");
	if ($today == substr($link, 0, 8)) {
		$hash = substr(hash('ripemd160', $link.$secret_password), 0, 10);
		echo "Save this part of your password:<br>".$hash;
	}
	else {
		echo "Wrong link for today.";
	}
} else {
	echo "<p>How many days are you technically going to force yourself to visit a physical location?</p>
	<form action='index.php' method='post'>
	<p><input name='days' id='days' min='1' style='width:70px;' type='number' value='3'> days</p>
	<p><input type='submit' style='padding:10px 30px;' value='Start'></p>
	</form>
	<small><a href='https://github.com/772/force-physical-location-visit'>Source code</a> | Use at your own risk</small>";
}
?>
</center>
  <script>
	function setPasswordAndLink() {
		charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
		password = "";
		for (var i = 0, n = charset.length; i < 42; ++i) {
			password += charset.charAt(Math.floor(Math.random() * n));
		}
		document.getElementById("password").value = password;
	}
    setPasswordAndLink();
  </script>
</body>
</html>

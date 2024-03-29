<!DOCTYPE html>
<html>
<head>
  <title>force-physical-location-visit</title>
  <meta charset="UTF-8">
  <script src="easy.qrcode.js"></script>
  <style>
  @media print
  {
    .no-print, .no-print *
    {
      display: none !important;
    }
  }
  </style>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <center>
    <h1>force-physical-location-visit.com</h1>

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
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!/()=?_-';
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
		$tomorrow = "";
		if ($i == 1)
			$tomorrow = " (Tommorow)";
		$entries =  $entries."<div style='width:310px;float:left;margin:10px;'>Day ".$i.$tomorrow."<br><small>".$hyperlink."</small><br><div id='qrcode".$i."'></div>";
		$entries =  $entries."<script>var qrcode = new QRCode(document.getElementById('qrcode".$i."'),{text: '".$hyperlink."'});</script>";
		$entries =  $entries."</div>";
	}
	echo "<p class='no-print'>Encrypt valueable data (e. g. important passwords or family photos in a zip file) with this key: ".$passwords."</p>";
	echo "<p>To get the full key back, visit the correct URL on each day between 00:00 - 23:59, otherwise your password will be <b>lost</b>. To force yourself to visit a physical location, you can print out the following QR codes and place the paper on the location.</p>".$entries;
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
	</form>";
}
?>

    <a href="https://github.com/772/force-physical-location-visit" class="github-corner no-print" aria-label="View source on GitHub"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#000; color:#fff; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>
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

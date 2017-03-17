<?php
session_start();
$login_id = $_POST['username'];
$password = $_POST['password'];



$link = mysql_connect('localhost', 'root', '');
if (!$link) {
	die('Could not connect: '.mysql_error());
}
else {
echo 'Connected successfully to localhost';
}
	
	$db_selected = mysql_select_db('etf_scraper', $link);
if (!$db_selected) {
    die ('Can\'t use etf_scraper : ' . mysql_error());
}
else
	echo 'Connected successfully to database';

$result = mysql_query("SELECT * FROM user_pass WHERE user = '$login_id' AND pass = '$password'");

	if ($result !== true) {
		$url = "Login.html?login=invalid";
		header('Location: '.$url);
	}
	if (mysql_num_rows($result)) {
		session_start();
		$_SESSION['user_id'] = $_POST['username'];
		$_SESSION['user_password'] = $_POST['password'];
		$_SESSION['logged_in'] = true;
		$url = "user_area_page.php?login=loggedin";
		header('Location: '.$url);
	}
?>
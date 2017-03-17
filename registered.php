<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$user = $_POST['username'];
$pass = $_POST['password'];
$email = $_POST['email'];

$link = mysql_connect('localhost', 'root', '');
if (!$link) {
	die('Could not connect: '.mysql_error());
}
else {
	echo 'Creating Account... ';
}
	
$db_selected = mysql_select_db('etf_scraper', $link);
if (!$db_selected) {
	die ('Can\'t use etf_scraper : ' . mysql_error());
}
else {
	echo 'Connecting to database... ';
}

$query = "INSERT INTO user_pass (first_name, last_name, user, pass, email)
VALUES ('$firstname', '$lastname', '$user', '$pass', '$email')";

if (mysql_query($query) == TRUE) {
	echo "<script>alert('Account created successfully!');</script>";
	session_start();
	$_SESSION['user_id'] = $_POST['username'];
	$_SESSION['user_password'] = $_POST['password'];
	$_SESSION['logged_in'] = true;
	$url = "user_area_page.php?login=registered";
	header('Location: '.$url);
}
else {
	echo "<script>alert('Error Occurred.')</script>";
	$url = "register.html?error";
	header('Location: '.$url);
}
?>

<html>
<!--
Author: Harrison W. Lee
Purpose: Displays page once user successfully logs in or registers a new account.
		 Displays search bar for user to input ETF symbol.
		 Redirects to data display page after user inputs symbol for search.
		 
-->
<title>ETF Search</title>
<head>
<?php
session_start();
if (!$_SESSION['logged_in']) {
	header('Location: Login.html');
	die();
}
echo "
		<script>
			url = window.location.href;
			if (url.includes('registered')) {
				alert('Account created successfully!');
			}
		</script>
		";
echo "
		<script>
			url = window.location.href;
			if (url.includes('loggedin')) {
				alert('Login successful. Welcome back.');
			}
		</script>
		";
echo "
		<script>
			url = window.location.href;
			if (url.includes('unknown')) {
				alert('No symbol found. Please enter a valid ETF symbol.');
			}
		</script>
		";
?>
	<link rel = "stylesheet" type = "text/css" href = "style-signin.css">
	<body id = "body-color">
		<div id = "Outer" style = "width: 100%">
			<div id = "Sign-In">
				<fieldset style = "width: 30%">
					<legend>
						ETF Symbol Search
					</legend>
					<form method = "POST"  name = "loginform" action = "results.php">
						ETF Symbol
						<br/>
							<input type = "text" name = "ETFsym" size = "40">
						<br/>
						<p id = "ETFsym"> 
							<input type = "submit" value = "SEARCH" id = "ETFsym">
						</p>				
					</form>
				</fieldset>
			</div>
		</div>
</head>
</body>
</html>

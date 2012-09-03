<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Running Statistics: Forgot Password</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>
	<body>
		<div class="container">
			<div class="heading">
				Running Statistics: Forgot Password
			</div>
			<div class="main">
				<br /> <br />

<?php
if( !isset($_POST['user_name']) )
{
?>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p>
						Give us your username and we'll send you your password in an email to the email address specified while registering on our website.
					</p>
					<p>
						Username: <input type="text" name="user_name" /> <br /> <br />
						<input type="submit" value="submit" />
						<a href="login.php">Back to Login Page</a>
					</p>
				</form>
<?php
}
else
{
	/*
	 * Send an email to the user's email address
	 *
	 */
	mysql_connect("localhost", "vikas");
	mysql_select_db("RunningStatistics");

	$query = "SELECT * FROM UserInformation WHERE user_name=\"{$user_name}\";";
	$result = mysql_query($query);

	// Valid user; Do nothing for invalid user :P
	if(mysql_num_rows($result) == 1)
	{
		$row = mysql_fetch_array($result);
		$to = $row['email_id'];
		$subject = "Password";
		$message = "Your password is " . $row['password'] . ".\n";

		mail($to, $subject, $message);
	}

	mysql_free_result($result);
	mysql_close();
	header("Location: login.php");
}
?>
			</div>
		</div>
	</body>
</html>

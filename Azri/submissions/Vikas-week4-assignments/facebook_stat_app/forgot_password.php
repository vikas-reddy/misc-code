<?php
if(isset($_POST['back_to_login']))
{
	header("Location: login.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Facebook Forgot Password</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>
	<body>
		<div class="container">
			<div class="heading">
				Facebook Forgot Password
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
						<input type="submit" name="back_to_login" value="Back to Login Page" />
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
	mysql_select_db("Facebook_StatMsg");

	$query = "SELECT * FROM UserInformation WHERE user_name=\"{$user_name}\";";
	$result = mysql_query($query);

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

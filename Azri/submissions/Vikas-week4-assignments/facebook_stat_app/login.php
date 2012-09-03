<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Facebook Login</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>
	<body>
		<div class="container">
			<div class="heading">
				Facebook Login
			</div>
			<div class="main">
				<br /> <br />

<?php

if( !isset($_POST['user_name'], $_POST['password']) or 
	(!$_POST['user_name'] and !$_POST['password'])
  )
{

?>

				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<table>
					<tr>
						<td>Username:</td>
						<td> <input type="text" name="user_name" value="<?php echo $_POST['user_name'];?>"/> </td>
					</tr>
					<tr>
						<td>Password:</td>
						<td> <input type="password" name="password" value="<?php echo $_POST['password'];?>"/> </td>
					</tr>
				</table>
				<p>
				<input type="submit" name="login_type" value="login" />
				<input type="reset" value="Reset" />
				</p>
				<p>
					Doesn't have an account yet? <a href="register.php">Register</a> <br />
					Forgot your password? <a href="forgot_password.php">Forgot Password</a>
				</p>
				</form>

<?php
}
else
{
	// Local variables
	$user_name = mysql_escape_string($_POST['user_name']);
	$password  = mysql_escape_string($_POST['password']);

	// Database connection
	mysql_connect("localhost", "vikas") or die(":( ERROR: " . mysql_error());
	mysql_select_db("Facebook_StatMsg") or die(":( ERROR: " . mysql_error());

	$query  = "SELECT name FROM UserInformation WHERE ";
	$query .= "user_name=\"" . $user_name . "\" AND ";
	$query .= "password=\""  . $password  . "\";";

	$result = mysql_query($query);

	// Wrong password or New user
	if(mysql_num_rows($result) == 0)
	{
		echo "Username and Password do not match! Try again.<br />";
		echo "<p> <a href=\"login.php\">Back to login page</a> </p>";
		echo "<p> Are you a new user? <a href=\"register.php\">Go to registration page</a> </p>";

		mysql_free_result($result);
		mysql_close();
		exit;
	}
	else
	{
		// Name of the user
		$row = mysql_fetch_array($result);
		$name = $row['name'];

		session_start();
		$_SESSION['user_name'] = $_POST['user_name'];
		$_SESSION['name'] = $name;

		mysql_free_result($result);
		mysql_close();

		header ("Location: home.php");
	}
}
?>

			</div>
		</div>
	</body>
</html>

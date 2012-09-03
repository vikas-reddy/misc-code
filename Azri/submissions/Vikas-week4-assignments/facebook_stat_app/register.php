<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Facebook Register</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>
	<body>
		<div class="container">
			<div class="heading">
				Facebook Register
			</div>
			<div class="main">
				<br /> <br />

<?php

if( (!isset($_POST['user_name'], $_POST['name'], $_POST['password1'], $_POST['password2'])) or 
	($_POST['password1'] != $_POST['password2']))
{

	if($_POST['password1'] != $_POST['password2'])
	{
?>
				<span style="color: red;"> Passwords do not match!! </span>
<?php
	}
?>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<table>
						<tr>
						<td>Username:</td>
						<td> <input type="text" name="user_name" value="<?php echo $_POST['user_name'];?>" /> </td>
						</tr>
						<tr>
						<td>Name:</td>
						<td> <input type="text" name="name" value="<?php echo $_POST['name'];?>" /> </td>
						</tr>
						<tr>
						<td>Password:</td>
						<td> <input type="password" name="password1" /> </td>
						</tr>
						<tr>
						<td>Retype Password:</td>
						<td> <input type="password" name="password2" /> </td>
						</tr>
						<tr>
						<td>Email ID:</td>
						<td> <input type="text" name="email_id" /> </td>
						</tr>
					</table>
					<p>
					<input type="submit" name="login_type" value="register" />
					<input type="reset" value="Reset" />
					<a href="login.php">Back to Login Page</a>
					</p>
				</form>

<?php
}
else
{
	// Local variables
	$user_name = mysql_escape_string($_POST['user_name']);
	$password  = mysql_escape_string($_POST['password1']);
	$name      = mysql_escape_string($_POST['name']);
	$email_id  = mysql_escape_string($_POST['email_id']);

	mysql_connect("localhost", "vikas");
	mysql_select_db("Facebook_StatMsg");

	$query = "SELECT user_name FROM UserInformation WHERE ";
	$query .= "user_name=\"" . $_POST['user_name'] . "\";";

	// Using regexps check whether input is valid

	$result = mysql_query($query);
	$row    = mysql_fetch_array($result);


	// Duplicate entry
	if(mysql_num_rows($result) == 1)
	{
?>

					<span style="color:red;">
						Username <?php echo $_POST['user_name'];?> is already in use. Choose another one.
					</span><br />

					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<table>
						<tr>
						<td>Username:</td>
						<td> <input type="text" name="user_name" value="<?php echo $_POST['user_name'];?>" /> </td>
						</tr>
						<tr>
						<td>Name:</td>
						<td> <input type="text" name="name" value="<?php echo $_POST['name'];?>" /> </td>
						</tr>
						<tr>
						<td>Password:</td>
						<td> <input type="password" name="password1" value="<?php echo $_POST['password1'];?>"/> </td>
						</tr>
						<tr>
						<td>Retype Password:</td>
						<td> <input type="password" name="password2" value="<?php echo $_POST['password2'];?>"/> </td>
						</tr>
						<tr>
						<td>Email ID:</td>
						<td> <input type="text" name="email_id" value="<?php echo $_POST['email_id'];?>"/> </td>
						</tr>
					</table>
					<p>
					<input type="submit" name="login_type" value="register" />
					<input type="reset" value="Reset" />
					<a href="login.php">Back to Login Page</a>
					</p>
				</form>
				<p> <a href="register.php">Back to registration page</a> </p>;

<?php
		mysql_free_result($result);
		mysql_close();
		exit;
	}

	// Insertion in Authentication table
	$query  = "INSERT INTO UserInformation (user_name, name, password, email_id) values (\"{$user_name}\", \"{$name}\", \"{$password}\", \"{$email_id}\");";

	mysql_query($query);


	// Creating other tables for the user
	$query  = "CREATE TABLE {$user_name}_flist (frnd_uname CHAR(50) NOT NULL, 
		PRIMARY KEY(frnd_uname), FOREIGN KEY (frnd_uname) REFERENCES UserInformation(user_name));";
	mysql_query($query);

	$query  = "CREATE TABLE {$user_name}_stat (frnd_uname CHAR(50) NOT NULL, 
		rating INT, comment BLOB, PRIMARY KEY(frnd_uname), FOREIGN KEY (frnd_uname) REFERENCES UserInformation(user_name));";
	mysql_query($query);

	$query  = "CREATE TABLE {$user_name}_invitations (frnd_uname CHAR(50) NOT NULL, 
		PRIMARY KEY(frnd_uname), FOREIGN KEY (frnd_uname) REFERENCES UserInformation(user_name));";
	mysql_query($query);

	mysql_free_result($result);
	mysql_close();

	session_start();
	$_SESSION['user_name'] = $_POST['user_name'];
	$_SESSION['name']      = $_POST['name'];

	header("Location: home.php");

}
?>
			</div>
		</div>
	</body>
</html>

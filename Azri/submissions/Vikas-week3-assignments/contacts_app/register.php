<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>
	<body>
		<div class="container">
			<div class="heading">
				Register
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

	mysql_connect("localhost", "root", "vikky123");
	mysql_select_db("Contacts");

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
	$query  = "INSERT INTO UserInformation VALUES (";
	$query .= "\"" . $user_name . "\", \"" . $name . "\", \"" . $password . "\");";

	mysql_query($query);


	// Table for user
	$query  = "CREATE TABLE " . $user_name . "_flist (";
	$query .= "FID INT NOT NULL AUTO_INCREMENT, ";
	$query .= "Name CHAR(50), Email CHAR(50), ";
	$query .= "Website_Url CHAR(60), Contact_No CHAR(15), ";
	$query .= "Address CHAR(100), PRIMARY KEY(FID) );";

	mysql_query($query);

	mysql_free_result($result);
	mysql_close();

	session_start();
	$_SESSION['user_name'] = $_POST['user_name'];
	$_SESSION['name']      = $_POST['name'];

	header("Location: inbox.php");

}
?>
			</div>
		</div>
	</body>
</html>

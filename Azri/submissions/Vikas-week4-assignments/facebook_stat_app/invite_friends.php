<?php
session_start();

if(!isset($_SESSION['user_name']) or !$_SESSION['user_name'])
{
	header("Location: login.php");
}
if(isset($_POST['logout']))
{
	session_destroy();
	$_SESSION = array();
	header("Location: login.php");
}
if(isset($_POST['back_to_home']))
{
	header("Location: home.php");
}

$user_name = $_SESSION['user_name'];
$name      = $_SESSION['name'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Facebook: Inviting Friends</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>

	<body>
		<div class="container">
			<div class="heading">
				Facebook: Inviting Friends
			</div>
			<div class="main">
				<!-- Logout Form -->
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p style="text-align:right;"><input type="submit" name="logout" value="Logout" /></p>

<?php
if(!isset($_POST['email']) or !$_POST['email'])
{
?>
					<p>Enter the email address of your friend to which an invitation is to be sent</p>
					<p>Email Address: <input type="text" name="email" /></p>
					<p><input type="submit" name="send" value="Send" /></p>
<?php
}
else
{
	$email = $_POST['email'];

	/*
	 * To send email
	 *
	 */
	//Check whether already a Facebook account exists
	mysql_connect("localhost", "vikas");
	mysql_select_db("Facebook_StatMsg");

	$query  = "SELECT user_name FROM UserInformation WHERE email_id=\"{$email}\";";
	$result = mysql_query($query);

	if(mysql_num_rows($result) == 1)
	{
		$row  = mysql_fetch_array($result);
		$user = $row['user_name'];
		//Send an invitation to the existing user $user

		$query = "INSERT INTO {$user}_invitations VALUES (\"$user_name\");";
		mysql_query($query);
	}
	else
	{
		$subject = "Facebook Invitation";
		$message = "Hey {$email},\n Your friend {$user_name} has sent an invitation to
					Facebook. Please <a href=\"http://localhost/~vikas/facebook_stat_app/register.php\">
					click here to register yourself with Facebook. It's an awesome
					application built by <a href=\"mailto:vikasreddy.iiit@gmail.com\">Vikas Reddy</a>";

		mail($email, $subject, $message);
	}
	mysql_free_result($result);
	mysql_close();
?>
					<p>Successfully sent invitation to <span style="font-weight:bold"><?php echo $email;?>.</span></p>
<?php
}
?>
					<p class="center"><input type="submit" name="back_to_home" value="Back to Home" /></p>
				</form>
			</div>
		</div>
	</body>
</html>

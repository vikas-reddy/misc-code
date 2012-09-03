<?php
/*
 * Automatic redirection to login page for unauthorised users
 * Logout Button
 *
 */


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
	unset($_SESSION['frnd_uname']);
	header("Location: home.php");
}

$user_name = $_SESSION['user_name'];
$name      = $_SESSION['name'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Facebook: Accept/Reject Friend Request</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>

	<body>
		<div class="container">
			<div class="heading">
				Facebook: Accept/Reject Friend Request
			</div>
			<div class="main">
				<!-- Logout Button -->
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p style="text-align:right;"><input type="submit" name="logout" value="Logout" /></p>

<?php
// Database connection
mysql_connect("localhost", "vikas");
mysql_select_db("Facebook_StatMsg");

$frnd_uname = $_GET['frnd_uname'];

$query = "DELETE FROM {$user_name}_invitations WHERE frnd_uname=\"{$frnd_uname}\"";
mysql_query($query);


if($_GET['accept'] == "yes")
{
	$query = "INSERT INTO {$user_name}_flist VALUES (\"{$frnd_uname}\");";
	mysql_query($query);
}

header("Location: home.php");

mysql_close();
?>

				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p style="text-align:center;"><input type="submit" name="back_to_home" value="Back to Home" /> </p>
				</form>
			</div>
		</div>
	</body>
</html>

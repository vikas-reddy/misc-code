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
		<title>Facebook: Rating/Commenting Friends' Status Messages</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>

	<body>
		<div class="container">
			<div class="heading">
				Facebook: Rating/Commenting Friends' Status Messages
			</div>
			<div class="main">
				<!-- Logout Button -->
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p style="text-align:right;"><input type="submit" name="logout" value="Logout" /></p>

<?php
// Database connection
mysql_connect("localhost", "vikas");
mysql_select_db("Facebook_StatMsg");


if(!isset($_POST['save']))
{
	// Saving frnd_uname to edit as a session variable
	$frnd_uname = $_GET['frnd_uname'];
	$_SESSION['frnd_uname'] = $frnd_uname;

	// Displaying information
	$query = "SELECT stat_msg,name FROM UserInformation WHERE user_name=\"{$frnd_uname}\";";
	$result= mysql_query($query);
	$row   = mysql_fetch_array($result);
	echo "<p> Rate <b>{$row['name']}</b>'s status message <b>{$row['stat_msg']}</b></p>";
	mysql_free_result($result);

	// Displaying existing rating/comments
	$query = "SELECT rating,comment FROM {$frnd_uname}_stat WHERE frnd_uname=\"{$user_name}\";";
	$result= mysql_query($query);
	if(mysql_num_rows($result) == 1)
	{
		$row   = mysql_fetch_array($result);
		$rating = $row['rating'];
		$comment = $row['comment'];
	}
	mysql_free_result($result);
?>
					<table border="0">
						<tr>
							<td>Rating:</td>
							<td><input type="text" name="rating" size="1" value="<?php echo $rating;?>" /></td>
						</tr>
						<tr>
							<td>Comment:</td>
							<td><input type="text" name="comment" size="40" value="<?php echo $comment;?>" /></td>
						</tr>
					</table>
					<p>
						<input type="submit" name="save" value="Save" />
						<input type="submit" name="back_to_home" value="Back to Home" />
					</p>
				</form>
<?php
}
else
{
	// Getting required data into local vars
	$frnd_uname = $_SESSION['frnd_uname'];
	$rating  = $_POST['rating'];
	$comment = $_POST['comment'];

	$query  = "SELECT * FROM {$frnd_uname}_stat WHERE frnd_uname=\"{$user_name}\";";
	$result = mysql_query($query);

	// If a comment already doesn't exist
	if(mysql_num_rows($result) == 0)
	{
		$query  = "INSERT INTO {$frnd_uname}_stat VALUES (\"{$user_name}\", \"{$rating}\", \"{$comment}\");";
	}
	else if(mysql_num_rows($result) == 1)
	{
		$query  = "UPDATE {$frnd_uname}_stat SET rating=\"{$rating}\", 
			comment=\"{$comment}\" WHERE frnd_uname=\"{$user_name}\";";
	}

	mysql_query($query);

?>
		Your ratings and comments are successfully saved! <br />
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<p style="text-align:center;"><input type="submit" name="back_to_home" value="Back to Home" /> </p>
		</form>

<?php
}
mysql_close();
?>

			</div>
		</div>
	</body>
</html>

<?php
session_start();

// Redirect to login page
if(!isset($_SESSION['user_name']) or !$_SESSION['user_name'])
{
	header("Location: login.php");
}
if(isset($_POST['back_to_home']))
{
	header("Location: home.php");
}

$user_name = $_SESSION['user_name'];
$name      = $_SESSION['name'];

if(isset($_POST['logout']))
{
	session_destroy();
	$_SESSION = array();
	header("Location: login.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Facebook: Comments for <?php echo $_SESSION['name'];?>'s Status Message</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>

	<body>
		<div class="container">
			<div class="heading">
				Facebook: Comments for <?php echo $_SESSION['name'];?>'s Status Message
			</div>
			<div class="main">
				<!-- Logout Form -->
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p style="text-align:right;"><input type="submit" name="logout" value="Logout" /></p>
				
				<p style="font-size:12pt;text-decoration:underline;">Comments for your status message</p>

<?php
$user_name = $_SESSION['user_name'];
$name = $_SESSION['name'];

mysql_connect("localhost", "vikas");
mysql_select_db("Facebook_StatMsg");


// Listing comments for your status message
$query  = "SELECT name,rating,comment FROM {$user_name}_stat,UserInformation WHERE user_name=frnd_uname;";
$result = mysql_query($query);

echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"5\">";
echo "<tr> <th>Friend Name</th> <th>Rating</th> <th>Comment</th></tr>";
while ($row = mysql_fetch_array($result))
{
	echo "<tr>";

	echo "<td>";
	echo $row['name'];
	echo "</td>";

	echo "<td>";
	echo $row['rating'];
	echo "</td>";

	echo "<td>";
	echo $row['comment'];
	echo "</td>";

	echo "</tr>";
}
echo "</table>";

mysql_free_result($result);
mysql_close();
?>
					<p class="center"><input type="submit" name="back_to_home" value="Back to Home" /></p>
				</form>
			</div>
		</div>
	</body>
</html>

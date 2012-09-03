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

$user_name = $_SESSION['user_name'];
$name      = $_SESSION['name'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Modifying <?php echo $_SESSION['name'];?>'s Friend List</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>

	<body>
		<div class="container">
			<div class="heading">
				Modifying <?php echo $_SESSION['name'];?>'s Friend List
			</div>
			<div class="main">
				<!-- Logout Form -->
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p style="text-align:right;"><input type="submit" name="logout" value="Logout" /></p>

<?php
if(!isset($_POST['delete']))
{
	$FID = $_GET['FID'];
	$_SESSION['FID'] = $FID;
?>
					<p>Do you really wanna delete? <input type="submit" name="delete" value="Delete" /></p>
				</form>
<?php
}
else
{
	echo "</form>";
	$FID = $_SESSION['FID'];

	mysql_connect("localhost", "root", "vikky123");
	mysql_select_db("Contacts");

	$query = "DELETE FROM " . $user_name . "_flist WHERE FID=\"" . $FID . "\";";
	mysql_query($query);

	mysql_close();

	echo "<p>Successfully deleted entry!</p>";
}
?>
				<form action="inbox.php" method="post">
					<p class="center"><input type="submit" value="Back to Inbox" /></p>
				</form>

			</div>
		</div>
	</body>
</html>

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

$user_name = $_SESSION['user_name'];
$name      = $_SESSION['name'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>Editing <?php echo $_SESSION['name'];?>'s Friend List</title>
		<link rel="stylesheet" type="text/css" href="../Azri_stylesheet.css" />
	</head>

	<body>
		<div class="container">
			<div class="heading">
				Editing <?php echo $_SESSION['name'];?>'s Friend List
			</div>
			<div class="main">
				<!-- Logout Button -->
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<p style="text-align:right;"><input type="submit" name="logout" value="Logout" /></p>
				</form>

<?php
// Database connection
mysql_connect("localhost", "root", "vikky123");
mysql_select_db("Contacts");


if(!isset($_POST['save']))
{
	// Saving FID to edit as a session variable
	$FID = $_GET['FID'];
	$_SESSION['FID'] = $FID;

	$query = "SELECT * FROM " . $user_name . "_flist WHERE FID=\"" . $FID . "\";";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

	mysql_free_result($result);
?>

				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
					<table border="1" cellspacing="0" cellpadding="4">
						<tr>
							<td>Name</td>
							<td><input type="text" name="Name" size="40" value="<?php echo $row['Name'];?>" /></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><input type="text" name="Email" size="40" value="<?php echo $row['Email'];?>" /></td>
						</tr>
						<tr>
							<td>Website_Url</td>
							<td><input type="text" name="Website_Url" size="40" value="<?php echo $row['Website_Url'];?>" /></td>
						</tr>
						<tr>
							<td>Contact_No</td>
							<td><input type="text" name="Contact_No" size="15" value="<?php echo $row['Contact_No'];?>" /></td>
						</tr>
						<tr>
							<td>Address</td>
							<td><input type="text" name="Address" size="60" value="<?php echo $row['Address'];?>" /></td>
						</tr>
					</table>
					<p style="text-align:center;"><input type="submit" name="save" value="Save" /></p>
				</form>
				<form action="inbox.php" method="post">
					<p style="text-align:center;"><input type="submit" value="Back to Inbox" /></p>
				</form>

<?php
}
else
{
	$query  = "UPDATE " . $_SESSION['user_name'] . "_flist SET ";
	$query .= "Name = \"" . $_POST['Name'] . "\", ";
	$query .= "Email = \"" . $_POST['Email'] . "\", ";
	$query .= "Website_Url = \"" . $_POST['Website_Url'] . "\", ";
	$query .= "Contact_No = \"" . $_POST['Contact_No'] . "\", ";
	$query .= "Address = \"" . $_POST['Address'] . "\" ";
	$query .= "WHERE FID=\"" . $_SESSION['FID'] . "\";";

	mysql_query($query);
?>

		Editing successfully finished! <br />
		<form action="inbox.php" method="post">
			<p style="text-align:center;"><input type="submit" value="Back to Inbox" /> </p>
		</form>

<?php
}
mysql_close();
?>

			</div>
		</div>
	</body>
</html>

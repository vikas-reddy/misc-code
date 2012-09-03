<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>PHP Time Convert</title>
		<link rel="stylesheet" type="text/css" href="Azri_First_Assignment.css" />
	</head>
	<body bgcolor="gray">
		<span class="heading">PHP Time Convert</span>
		<br /> <br />

		<?php
			if($_GET['Time'] == NULL) {
		?>

		<form action="php_time_convert.php" method="get">
			<p>Give time in seconds: <input type="text" name="Time" /> </p>
			<p><input type="submit" /></p>
		</form>

		<?php
		}
		else {

			// Actual Calculation
			$TimeInSecs = (int)$_GET['Time'];

			/*
			 * Assuming that an year consists of 60*60*24*30*12 seconds
			 * i.e., an year consists of 12 months with each month having 30 days
			 *
			 */
			$Years   = ($TimeInSecs)/ (60*60*24*30*12);
			$Months  = ($TimeInSecs % (60*60*24*30*12)) / (60*60*24*30);
			$Days    = ($TimeInSecs % (60*60*24*30))    / (60*60*24);
			$Hours   = ($TimeInSecs % (60*60*24))       / (60*60);
			$Minutes = ($TimeInSecs % (60*60))          / (60);
			$Seconds = ($TimeInSecs % (60));


			echo "$TimeInSecs seconds, when presented in readable format, is<br /> <br /> <b>";
			echo (int)$Years . " Years, " . 
				 (int)$Months . " Months, " . 
				 (int)$Days . " Days, " . 
				 (int)$Hours . " Hours, " . 
				 (int)$Minutes . " Minutes and " . 
				 (int)$Seconds . " Seconds <br />";
			echo "</b>";

		}
		?>

	</body>
</html>


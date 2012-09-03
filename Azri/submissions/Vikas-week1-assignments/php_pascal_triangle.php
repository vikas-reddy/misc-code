<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/xhtml1-strict.dtd">
<html>
	<head>
		<title>PHP Pascal Triangle</title>
		<link rel="stylesheet" type="text/css" href="Azri_First_Assignment.css" />
	</head>
	<body bgcolor="gray">
		<span class="heading">PHP Pascal Triangle</span>
		<br /> <br />

		<?php
			function nCm($n, $m)
			{
				if( $n == 0 or $m == 0)
				{
					return 1;
				}

				$product = 1;
				for( $i=1; $i<=$m; $i++)
				{
					$product *= ($n-($i-1))/(float)$i;
				}
				return $product;
			}

			// Pascal Triangle
			$n = 7;
			for( $i = 0; $i <= $n; $i++)
			{
				// Printing spaces
				for( $k = 0; $k < $n - $i ; $k++)
				{
					echo "_";
					//printf(" ");
				}

				// Printing numbers
				for( $j = 0; $j <= $i; $j++ )
				{
					//echo nCm($i,$j) . "_";
					printf("%d_", nCm($i,$j));
				}
				echo "<br />";
			}
		?>

	</body>
</html>


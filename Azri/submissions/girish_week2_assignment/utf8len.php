
<?php
function utf8_strlen($str)
{
	$count = 0;

	for($i = 0; $i < strlen($str); $i++)
	{
		$value = ord($str[$i]);
		if($value > 127)
		{
			if($value >= 192 && $value <= 223)
				$i++;
			elseif($value >= 224 && $value <= 239)
				$i = $i + 2;
			elseif($value >= 240 && $value <= 247)
				$i = $i + 3;
			else
				die('Not a UTF-8 compatible string');
		}

		$count++;
	}

	return $count;
}
?>

<?php

// Input is set here
$str = "ÃŠ sÃ¥ Ã¥";

echo "String: {$str}\n";
echo "String Length: " . mb_strlen($str, "UTF-8") . "\n";

?>

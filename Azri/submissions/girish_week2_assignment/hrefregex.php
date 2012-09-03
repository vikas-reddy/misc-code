<?php
$url_match="((http|ftp|gopher|https)://[^\s]+)";
echo preg_replace($url_match, "<a href='$0' target=_new> $0 </a>","http://192.168.36.504")."\n" ;
echo preg_replace($url_match, "<a href='$0' target=_new> $0 </a>","http://google.com")."\n" ;

?>

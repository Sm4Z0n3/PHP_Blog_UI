<?php
$title = $_POST["title"];
$body = $_POST["body"];
$text = 'blog/i/'.$_COOKIE['usw']."_".$title.".hblog";
file_put_contents($text,$body);

echo '<meta http-equiv="refresh" content="0; url=/">';
?>
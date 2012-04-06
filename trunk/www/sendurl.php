<?php
$url = $_POST['urlsender'];

$url = 'start '.$url;
shell_exec($url);
echo '<meta http-equiv="refresh" content="0; URL=messagerie.php">';
?>
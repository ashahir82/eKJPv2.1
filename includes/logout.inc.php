<?php
session_start();
session_destroy();
$URL="index.php";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
?>
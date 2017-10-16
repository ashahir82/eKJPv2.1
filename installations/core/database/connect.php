<?php
$connect_error ='Harap maaf, laman ini mengalami masalah sambungan pangkalan data.';
mysql_connect($cfg_host,$cfg_user,$cfg_password) or die($connect_error);
mysql_select_db($cfg_db) or die($connect_error);
?>
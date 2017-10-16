<?php
$parts = explode(DIRECTORY_SEPARATOR, JPATH_BASE);
array_pop($parts);
define('JPATH_ROOT', implode(DIRECTORY_SEPARATOR, $parts));
define('JPATH_CONFIGURATION', JPATH_ROOT);
define('JPATH_INSTALLATION',  JPATH_ROOT . DIRECTORY_SEPARATOR . 'installation');
define('JDIR',$parts[count($parts)-1]);
?>
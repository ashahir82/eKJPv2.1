<?php
$parts = explode(DIRECTORY_SEPARATOR, JPATH_BASE);
define('JPATH_ROOT', implode(DIRECTORY_SEPARATOR, $parts));
define('JPATH_CONFIGURATION', JPATH_ROOT);
define('JPATH_INSTALLATION',  JPATH_ROOT . DIRECTORY_SEPARATOR . 'installation');
define('JDIR',$parts[count($parts)-1]);

if (file_exists(JPATH_CONFIGURATION . '/configuration.php')) {
	//Global Define
	require JPATH_CONFIGURATION . '/configuration.php';
	$config = new JConfig;

	//Database
	$cfg_host = $config->host;
	$cfg_user = $config->user;
	$cfg_password = $config->password;
	$cfg_db = $config->db;

	//Institute
	$cfg_institute = $config->institute;
	$cfg_short_inst = $config->short_inst;
	$cfg_division = $config->division;
	$cfg_address = $config->address;
	$cfg_telno = $config->telno;
	$cfg_extention = $config->extention;
	$cfg_faxno = $config->faxno;
	$cfg_email = $config->email;
	$cfg_website = $config->website;
	
	//Admin
	$cfg_username = $config->username;
	$cfg_pass = $config->pass;
	$cfg_fullname = $config->fullname;
	$cfg_notel = $config->notel;
	$cfg_email_admin = $config->email_admin;
	
	//Letter
	$cfg_register_period = $config->register_period;
	$cfg_slogan = $config->slogan;
}
?>
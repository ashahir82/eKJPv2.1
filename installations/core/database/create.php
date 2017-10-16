<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

define('JPATH_BASE', realpath(__DIR__ . '/../..'));
include '../define.php';
include '../init.php';

$rows = array();
$rowsResult = array();

if(isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "create" && isset($_GET['dbhost']) && isset($_GET['dbuser']) && isset($_GET['dbpass']) && isset($_GET['dbname']) && isset($_GET['fullname']) && isset($_GET['notel']) && isset($_GET['email']) && isset($_GET['username']) && isset($_GET['pass']) && isset($_GET['institute']) && isset($_GET['inst_short']) && isset($_GET['division']) && isset($_GET['address']) && isset($_GET['inst_notel']) && isset($_GET['inst_extention']) && isset($_GET['inst_nofax']) && isset($_GET['inst_email']) && isset($_GET['inst_website']) && isset($_GET['slogan']) && isset($_GET['registration'])) {
	$dbhost=sanitize($_GET['dbhost']);
	$dbuser=sanitize($_GET['dbuser']);
	$dbpass=sanitize($_GET['dbpass']);
	$dbname=sanitize($_GET['dbname']);
	$fullname=sanitize($_GET['fullname']);
	$username=sanitize($_GET['username']);
	$institute=sanitize($_GET['institute']);
	$inst_short=sanitize($_GET['inst_short']);
	$division=sanitize($_GET['division']);
	$address=sanitize($_GET['address']);
	$inst_notel=sanitize($_GET['inst_notel']);
	$inst_extention=sanitize($_GET['inst_extention']);
	$inst_nofax=sanitize($_GET['inst_nofax']);
	$inst_email=sanitize($_GET['inst_email']);
	$inst_website=sanitize($_GET['inst_website']);
	$slogan=sanitize($_GET['slogan']);
	$registration=sanitize($_GET['registration']);
	$notel=sanitize($_GET['notel']);
	$email=sanitize($_GET['email']);
	$pass=sanitize($_GET['pass']);
	
	if (empty($notel) === false && is_numeric($notel) !== true) {
		$errors[] = 'No Telefon hanya mengandungi nombor sahaja.';
	}
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errors[] = 'Alamat email yang sah diperlukan';
	}
	if (empty($inst_notel) === false && is_numeric($inst_notel) !== true) {
		$errors[] = 'No Telefon Institut hanya mengandungi nombor sahaja.';
	}
	if (empty($inst_extention) === false && is_numeric($inst_extention) !== true) {
		$errors[] = 'No sambungan Institut hanya mengandungi nombor sahaja.';
	}
	if (empty($inst_nofax) === false && is_numeric($inst_nofax) !== true) {
		$errors[] = 'No Faks Institut hanya mengandungi nombor sahaja.';
	}
	if (filter_var($inst_email, FILTER_VALIDATE_EMAIL) === false) {
		$errors[] = 'Alamat email Institut yang sah diperlukan';
	}
	if (is_writable(JPATH_CONFIGURATION) === false) {
		$errors[] = 'Konfogurasi sistem tidak boleh di cipta. Sila ubah <i>Folder Permissions</i> pada direktori sistem eKJP';
	}
	
	if (empty($errors) === true) {
		$dbStat = createDB($dbhost, $dbuser, $dbpass, $dbname, JPATH_INSTALLATION);
		if ($dbStat === 0) {
			$errors[] = 'Fail pangkalan data tidak wujud';
		} else if ($dbStat === 1) {
			$errors[] = 'Pangkalan data tidak berjaya di hubung';
		} else if ($dbStat === 2) {
			$errors[] = 'Pangkalan data tidak berjaya di bina';
		} else if ($dbStat === 3) {
			$errors[] = 'Pangkalan data tidak berjaya di muat naik';
		} else if($dbStat === true) {
			$dbStat = createUser($dbhost, $dbuser, $dbpass, $dbname, $username, $pass, $fullname, $notel, $email);
			if ($dbStat === 4) {
				$errors[] = 'Pangkalan data tidak berjaya dihubung';
			} else if ($dbStat === 5) {
				$errors[] = 'Pengguna tidak berjaya dicipta';
			}
		}
		
		if (empty($errors) === false){
			$rows['errors'] = $errors;
		} else {
			//write config file
			$string = '<?php
class JConfig {
	public $offline = "0";
	public $offline_message = "This site is down for maintenance.<br /> Please check back again soon.";
	public $display_offline_message = "1";
	
	//Database
	public $host = "'. $dbhost. '";
	public $user = "'. $dbuser. '";
	public $password = "'. $dbpass. '";
	public $db = "'. $dbname. '";
	
	//Institute
	public $institute = "'. $institute. '";
	public $short_inst = "'. $inst_short. '";
	public $division = "'. $division. '";
	public $address = "'. $address. '";
	public $telno = "'. $inst_notel. '";
	public $extention = "'. $inst_extention. '";
	public $faxno = "'. $inst_nofax. '";
	public $email = "'. $inst_email. '";
	public $website = "'. $inst_website. '";
	
	//Admin
	public $username = "'. $username. '";
	public $pass = "'. $pass. '";
	public $fullname = "'. $fullname. '";
	public $notel = "'. $notel. '";
	public $email_admin = "'. $email. '";
	
	//Letter
	public $register_period = "'. $registration. '";
	public $slogan = "'. $slogan. '";
}
?>';
			
			$fp = FOPEN(JPATH_CONFIGURATION . "/configuration.php", "w+");
			if (FWRITE($fp, $string) === false) {
				$errors[] = 'Fail konfigurasi tidak berjaya di bina.';
			}
			FCLOSE($fp);
			//end write config
			
			//create db, import data
			$URL="../index.php";
			$rows['success'] = $URL;
		}
	} else if (empty($errors) === false){
		$rows['errors'] = $errors;
	}
	echo json_encode($rows);
}

function createDB($hn, $un, $ps, $db, $loc) {
	$dbhost = $hn;
	$dbuser = $un;
	$dbpass = $ps;
	$database = $db;
	$location = $loc;
	
	// Name of the file
	$filename = $location . "/db/ekjp.sql";
	if (!file_exists($filename)) {
		return 0;
	} else {
		// Connect to MySQL server
		$conn = mysql_connect($dbhost, $dbuser, $dbpass);
		if (!$conn) {
			return 1;
		} else {
			$sql = "CREATE DATABASE " . $database;
			$dbsql = mysql_query($sql);
			if (!$dbsql) {
				return 2;
			} else {
				// Select database
				mysql_select_db($database);

				// Temporary variable, used to store current query
				$templine = '';
				// Read in entire file
				$lines = file($filename);
				// Loop through each line
				foreach ($lines as $line)
				{
					// Skip it if it's a comment
					if (substr($line, 0, 2) == '--' || $line == '')
					continue;

					// Add this line to the current segment
					$templine .= $line;
					// If it has a semicolon at the end, it's the end of the query
					if (substr(trim($line), -1, 1) == ';')
					{
						// Perform the query
						if(!mysql_query($templine)) {
							$errors[] = 'Pangkalan data tidak berjaya di muat naik';
							exit;
						}
						// Reset temp variable to empty
						$templine = '';
					}
				}
			}
		}
		if (empty($errors) === false){
			return 3;
		} else {
			return true;
		}
	}
}

function createUser($hn, $un, $ps, $db, $username, $password, $fullname, $notel, $email) {
	$dbhost = $hn;
	$dbuser = $un;
	$dbpass = $ps;
	$database = $db;
	$username = $username;
	$password = $password;
	$fullname = $fullname;
	$notel = $notel;
	$email = $email;
	
	// Create connection
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	// Check connection
	if (!$conn) {
		return 4;
	} else {
		mysql_select_db($database);
	}
	
	$register_data = array(
		'username' => $username,
		'fullname' => $fullname,
		'telnum' => $notel,
		'level' => 1,
		'active' => 1,
		'email' => $email,
		'pass' => $password
	);
	
	array_walk ($register_data,'array_sanitize');
	$register_data['pass'] = md5($register_data['pass']);
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	
	$sql = mysql_query ("INSERT INTO `users` ($fields) VALUES ($data)");

	if ($sql) {
		return true;
	} else {
		return 5;
	}

	mysql_close($conn);
}
?>
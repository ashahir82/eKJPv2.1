<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

define('JPATH_BASE', realpath(__DIR__ . '/..'));
include '../core/define.php';
include '../core/init.php';

$rows = array();
$lists = array();
$email = array();
$i = 0;
$ls = 0;
if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "allEmail") {
	$result = mysql_query("SELECT DISTINCT `email` FROM `apply` ORDER BY `name`");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rows[] = array(
				'email' => $row['email'],
			);
			if ($i < 100) {
				$i++;
			} else {
				$i = 0;
				$lists[] = array(
					'list' => $rows,
				);
				unset($rows);
			}
		}
	} else {
		$errors[]  = 'No record found';
	}
	
	if (!empty($errors)) {
		$email['errors']  = $errors;
	} else {
		$email['success']  = $lists;
	}
	echo json_encode($email);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "login") {
	$username = $_GET['username'];
	$password = $_GET['password'];
	
	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'Anda perlu mengisi pengenalan dan kata lalaun';
	} else if (user_exists($username) === false) {
		$errors[] = 'Pengguna tidak wujud. Adakah anda sudah mendaftar?';
	} else if (user_active($username) === false) {
		$errors[] = 'Akaun anda tidak aktif. Sila semak e-mel anda untuk pautan pengaktifan akaun.';
	} else {
		if (strlen($password) > 32) {
			$errors[] = 'Kata laluan terlalu panjang';
		}
		
		$login = login($username, $password);
		$logintime = date("l, j M Y - H:i A");
		
		if ($login === false) {
			$errors[] = 'Kombinasi pengenalan / kata laluan anda salah';
		} else {
			$_SESSION['user_id'] = $login;
			$_SESSION['last_login'] = last_login($login);
			
			$_SESSION['logintime'] = $logintime;
			mysql_query("UPDATE `users` SET `last_login` = '$logintime' WHERE `id` = '$_SESSION[user_id]'");
			
			$URL="index.php";
		}
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	} else {
		$rows['success']  = $URL;
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "checkProfile") {
	// username and password sent from Form
	$noic=sanitize($_GET['noic']);
	
	if (empty($errors) === true) {
		if (preg_match("/\\s/", $noic) == true) {
			$errors[] = 'No kad pengenalan tidak boleh mempunyai ruang.';
		}
		if (is_numeric($noic) !== true) {
			$errors[] = 'No kad pengenalan hanya mengandungi nombor sahaja.';
		}
		if (strlen($noic) <> 12) {
			$errors[] = 'No kad pengenalan anda tidak sah.';
		}
		if (noic_apply($noic) == false) {
			$errors[] = 'Tiada maklumat permohonan kursus bernombor kad pengenalan \'' . $noic . '\' ditemui.';
		}
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	} else {
		$query = mysql_query("SELECT * FROM `apply` WHERE `noic` = '$noic' ORDER BY `apply_id`");
		if (mysql_num_rows($query) != 0) {
			while (($row = mysql_fetch_assoc($query)) != false) {
				$rows['success'] = array(
					'name' => $row['name'],
					'noic' => $row['noic'],
					'nationality' => $row['nationality'],
					'address' => $row['address'],
					'postcode' => $row['postcode'],
					'notel' => $row['notel'],
					'email' => $row['email'],
				);
			}
		}
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "saveProfile") {
	$name = sanitize($_GET['name']);
	$noic = sanitize($_GET['noic']);
	$nationality = sanitize($_GET['nationality']);
	$address = str_replace('\n', "\n", $_GET['address']);
	$postcode = sanitize($_GET['postcode']);
	$notel = sanitize($_GET['notel']);
	$email = sanitize($_GET['email']);
	
	if (mohon_ic_exists($noic) === false) {
		$errors[] = 'No kad pengenalan tidak wujud.';
	}
	if (preg_match("/\\s/", $noic) == true) {
		$errors[] = 'No kad pengenalan tidak boleh mempunyai ruang.';
	}
	if (is_numeric($noic) !== true) {
		$errors[] = 'No kad pengenalan hanya mengandungi nombor sahaja.';
	}
	if (strlen($noic) <> 12) {
		$errors[] = 'No kad pengenalan anda tidak sah.';
	}
	if (is_numeric($postcode) !== true) {
		$errors[] = 'Poskod hanya mengandungi nombor sahaja.';
	}
	if (strlen($postcode) <> 5) {
		$errors[] = 'Poskod anda tidak sah.';
	}
	if (empty($notel) === false && is_numeric($notel) !== true) {
		$errors[] = 'No Telefon hanya mengandungi nombor sahaja.';
	}
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errors[] = 'Alamat email yang sah diperlukan';
	}
	
	if (empty($errors) === true) {
		$addtime = date("j M Y - H:i");
		//mohon update
		$update_data = array(
			'name' => ucwords(strtolower($name)),
			'nationality' => $nationality,
			'address' => ucwords(strtolower($address)),
			'postcode' => $postcode,
			'notel' => $notel,
			'email' => $email,
			'created_on' => $addtime
		);
		update_pemohon($noic, $update_data);
		
		$rows['success'] = 'Operasi berjaya';
	} else {
		$rows['errors']  = $errors;
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "addAllList") {
	$result = mysql_query("SELECT * FROM `users` ORDER BY `id`");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rows[] = array(
				'id' => $row['id'],
				'username' => $row['username'],
				'fullname' => $row['fullname'],
				'level' => users_level($row['level']),
				'last_login' => $row['last_login'],
				'active' => $row['active'],
			);
		}
	} else {
		$errors[]  = 'No record found';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "userDetail" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$result = mysql_query("SELECT * FROM `users` WHERE `id` = $id ORDER BY `id`");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rows['success'] = array(
				'id' => $row['id'],
				'username' => $row['username'],
				'fullname' => $row['fullname'],
				'telnum' => $row['telnum'],
				'email' => $row['email'],
				'active' => $row['active'],
				'level' => $row['level'],
				'last_login' => $row['last_login']
			);
		}
	} else {
		$errors['errors']  = 'No record found';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "userSave") {
	$username = sanitize($_GET['username']);
	$fullname = sanitize($_GET['fullname']);
	$telnum = sanitize($_GET['telnum']);
	$email = sanitize($_GET['email']);
	$level = sanitize($_GET['level']);
	$active = sanitize($_GET['active']);
	
	if (user_exists($username) === true) {
		$errors[] = 'Nama pengguna \'' . $username . '\' sudah didaftarkan.';
	}
	if (preg_match("/\\s/", $username) == true) {
		$errors[] = 'Nama pengguna tidak boleh mempunyai ruang.';
	}
	if (empty($telnum) === false && is_numeric($telnum) !== true) {
		$errors[] = 'No. telefon hanya mengandungi nombor sahaja.';
	}
	if (email_exists($email) === true) {
		$errors[] = 'Alamat email \'' . $email . '\' sudah didaftarkan.';
	}
	
	if (empty($errors) === true) {
		$addtime = date("j M Y - H:i");
		$add_data = array(
			'username' => $username,
			'fullname' => $fullname,
			'telnum' => $telnum,
			'email' => $email,
			'level' => $level,
			'active' => $active,
			'pass' => $username,
		);
		register_user($add_data);
		$rows['success'] = 'Operasi berjaya';
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	}
	
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "userEdit" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$username = sanitize($_GET['username']);
	$fullname = sanitize($_GET['fullname']);
	$telnum = sanitize($_GET['telnum']);
	$email = sanitize($_GET['email']);
	$level = sanitize($_GET['level']);
	$active = sanitize($_GET['active']);
	
	if (user_id_exists($id) === true) {
		$rowc = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = $id"));
			
		if (count_user() === true && ($rowc['level'] !== $level || $rowc['active'] !== $active)) {
			$errors[] = 'Aplikasi memerlukan sekurangnya seorang pentadbir aktif.';
		}
		if (user_exists($username) === true && $rowc['username'] !== $username) {
			$errors[] = 'Nama pengguna \'' . $username . '\' sudah didaftarkan.';
		}
		if (preg_match("/\\s/", $username) == true) {
			$errors[] = 'Nama pengguna tidak boleh mempunyai ruang.';
		}
		if (empty($telnum) === false && is_numeric($telnum) !== true) {
			$errors[] = 'No. telefon hanya mengandungi nombor sahaja.';
		}
		if (email_exists($email) === true && $rowc['email'] !== $email) {
			$errors[] = 'Alamat email \'' . $email . '\' sudah didaftarkan.';
		}
		
		if (empty($errors) === true) {
			$addtime = date("j M Y - H:i");
			$update_data = array(
				'username' => $username,
				'fullname' => $fullname,
				'telnum' => $telnum,
				'email' => $email,
				'level' => $level,
				'active' => $active,
			);
			update_user($id, $update_data);
			$rows['success'] = 'Operasi berjaya';
			
		}
	} else {
		$errors[] = 'Harap maaf, pengguna tidak wujud.';
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	}
	
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "userDelete" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	if(count_user() === false) {
		if (user_id_exists($id) === true) {
			$delete = mysql_query("DELETE FROM `users` WHERE `id` = $id");
		} else {
			$errors[] = 'Harap maaf, pengguna tidak wujud.';
		}
	} else {
		$errors[] = 'Harap maaf, aplikasi memerlukan sekurangnya seorang pentadbir.';
	}
	
	if($delete) {
		$rows['success'] = 'Operasi berjaya';
	} else {
		$errors[] = 'Operasi tidak berjaya';
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	}
	
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "passSave" && isset($_GET['id']) && isset($_GET['old_pass']) && isset($_GET['new_pass']) && isset($_GET['repeat_pass'])) {
	$id = $_GET['id'];
	$old_pass = $_GET['old_pass'];
	$new_pass = $_GET['new_pass'];
	$repeat_pass = $_GET['repeat_pass'];
	
	if (user_id_exists($id) === true) {
		$rowc = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = $id"));
		
		if (md5($old_pass) === $rowc['pass']) {
			if (trim($new_pass) !== trim($repeat_pass)) {
				$errors[] = 'Kata laluan baru anda tidak sama.';
			}
			if (strlen($new_pass) < 8) {
				$errors[] = 'Kata laluan anda kurang daripada 8 karektor.';
			}
			if (strlen($new_pass) > 32) {
				$errors[] = 'Kata laluan anda lebih daripada 32 karektor.';
			}
		} else {
			$errors[] = 'Kata laluan semasa anda tidak sama.';
		}
		
		if (empty($errors) === true) {
			change_password($id, $new_pass);
		}
	} else {
		$errors[] = 'Harap maaf, pengguna tidak wujud.';
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	} else {
		$rows['success']  = 'Kata laluan berjaya disimpan.';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "saveSetting" && isset($_GET['dbhost']) && isset($_GET['dbuser']) && isset($_GET['dbpass']) && isset($_GET['dbname']) && isset($_GET['institute']) && isset($_GET['inst_short']) && isset($_GET['division']) && isset($_GET['address']) && isset($_GET['inst_notel']) && isset($_GET['inst_extention']) && isset($_GET['inst_nofax']) && isset($_GET['inst_email']) && isset($_GET['inst_website']) && isset($_GET['slogan']) && isset($_GET['registration'])) {
	$dbhost=sanitize($_GET['dbhost']);
	$dbuser=sanitize($_GET['dbuser']);
	$dbpass=sanitize($_GET['dbpass']);
	$dbname=sanitize($_GET['dbname']);
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
	
	if (empty($errors) === true){
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
	}
	if (empty($errors) === false){
		$rows['errors'] = $errors;
	} else {
		$URL="index.php?p=setting";
		$rows['success'] = $URL;
	}
	echo json_encode($rows);
}
?>
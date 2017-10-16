<?php
function count_user() {
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `level` = 1");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_exists($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `username` = '$username'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_id_exists($user_id) {
	$user_id = sanitize($user_id);
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `id` = '$user_id'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_idmd5_exists($user_id) {
	$user_id = sanitize($user_id);
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE md5(`id`) = '$user_id'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function email_exists($email) {
	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `email` = '$email'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function register_user($register_data) {
	array_walk ($register_data,'array_sanitize');
	$register_data['pass'] = md5($register_data['pass']);
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	
	mysql_query ("INSERT INTO `users` ($fields) VALUES ($data)");
}

function user_active($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `username` = '$username' AND `active` = 1");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_id_from_username($username) {
	$username = sanitize($username);
	$query = mysql_query("SELECT `id` FROM `users` WHERE `username` = '$username'");
	return mysql_result($query, 0, 'id');
}

function fullname_from_userid($userid) {
	$userid = sanitize($userid);
	$query = mysql_query("SELECT `fullname` FROM `users` WHERE `id` = '$userid'");
	return mysql_result($query, 0, 'fullname');
}

function institute_from_userid($userid) {
	$userid = sanitize($userid);
	$query = mysql_query("SELECT `institute` FROM `users` WHERE `id` = '$userid'");
	return mysql_result($query, 0, 'institute');
}

function login($username, $password) {
	$user_id = user_id_from_username($username);
	
	$username = sanitize($username);
	$password = md5($password);
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `username` = '$username' AND `pass` = '$password'");
	return (mysql_result($query, 0) == 1) ? $user_id : false;
}

function last_login($user_id) {
	$user_id = (int)$user_id;
	$query = mysql_query("SELECT `last_login` FROM `users` WHERE `id` = $user_id");
	return mysql_result($query, 0, 'last_login');
}

function logged_in () {
	return (isset($_SESSION['user_id'])) ? true : false;
}

function user_data($user_id) {
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if ($func_num_args > 1) {
		unset ($func_get_args[0]);
		
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `id` = '$user_id'"));
		return $data;
	}
}

function has_access($user_id, $level) {
	$user_id = (int)$user_id;
	$level = (int)$level;
	
	$query = mysql_query("SELECT COUNT(`id`) FROM `users` WHERE `id` = $user_id AND `level` = $level");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function users_level($level) {
	$level = (int)$level;
	$query = mysql_query("SELECT `name` FROM `level` WHERE `level_id` = $level");
	if (mysql_num_rows($query) != 0) {
		return mysql_result($query, 0, 'name');
	} else {
		return $level;
	}
}

function change_password($user_id, $password) {
	$user_id = (int)$user_id;
	$password = md5($password);
	
	mysql_query("UPDATE `users` SET `pass` = '$password' WHERE `id` = $user_id");
}

function update_user($user_id, $update_data) {
	$update = array();
	array_walk ($update_data,'array_sanitize');
	
	foreach ($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	mysql_query("UPDATE `users` SET " . implode(', ',$update) . " WHERE `id` = '" .$user_id . "'");
}

//Resigter User 
function add_select_institute($institute) {
	$institute = (int)$institute;
	$query = "SELECT `id`, `institute` FROM `institute`";
	$result = mysql_query($query);
	if($result)
		{
			echo "<select name='institute' required='required'>";
			echo "<option value=''>Pilih Institut...</option>";
			while ($row = mysql_fetch_array($result)) 
			{
				if ($row['id'] == $institute) {
					echo "<option value='".$row['id']."' selected='selected' >".$row['institute']."</option>";
			   } else {
				   echo "<option value='".$row['id']."'>".$row['institute']."</option>";
			   }
			}
			echo "</select>";
		}
}

function institute_name($institute_id) {
	$institute_id = (int)$institute_id;
	$query = mysql_query("SELECT `institute` FROM `institute` WHERE `id` = $institute_id");
	if (mysql_num_rows($query) != 0) {
		return mysql_result($query, 0, 'institute');
	} else {
		return $institute_id;
	}
}

// Message Board
function message_id_exists($message_id) {
	$message_id = sanitize($message_id);
	$query = mysql_query("SELECT COUNT(`id`) FROM `message` WHERE md5(`id`) = '$message_id'");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function register_message($register_data) {
	array_walk ($register_data,'array_sanitize');
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	
	mysql_query ("INSERT INTO `message` ($fields) VALUES ($data)");
}

function update_message($message_id, $update_data) {
	$message_id = sanitize($message_id);
	$update = array();
	array_walk ($update_data,'array_sanitize');
	
	foreach ($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	mysql_query("UPDATE `message` SET " . implode(', ',$update) . " WHERE md5(`id`) = '$message_id'");
}
?>
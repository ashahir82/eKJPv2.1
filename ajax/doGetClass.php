<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

define('JPATH_BASE', realpath(__DIR__ . '/..'));
include '../core/define.php';
include '../core/init.php';

$rows = array();
if(isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "addAllClass") {	
	$result = mysql_query("SELECT `CL`.*, `C`.`code`, `C`.`name` FROM `class` AS CL INNER JOIN `course` AS C ON `CL`.`course_id`=`C`.`course_id` WHERE `CL`.`active` = 1 ORDER BY `CL`.`class_id` DESC");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			if ($row['time_start'] <= 11) {
				$time_start = $row['time_start'] . '.00 Pagi';
			} else if ($row['time_start'] >= 13 AND $row['time_start'] <= 18) {
				$time_start = $row['time_start'] . '.00 Petang';
			} else if ($row['time_start'] >= 19 AND $row['time_start'] <= 24) {
				$time_start = $row['time_start'] . '.00 Malam';
			} else {
				$time_start = $row['time_start'] . '.00 Tengah Hari';
			}
			
			if ($row['time_end'] <= 11) {
				$time_end = $row['time_end'] . '.00 Pagi';
			} else if ($row['time_end'] >= 13 AND $row['time_end'] <= 18) {
				$time_end = ($row['time_end'] - 12) . '.00 Petang';
			} else if ($row['time_end'] >= 19 AND $row['time_end'] <= 24) {
				$time_end = ($row['time_end'] - 12) . '.00 Malam';
			} else {
				$time_end = $row['time_end'] . '.00 Tengah Hari';
			}
										
			$rows[] = array(
				'id' => $row['class_id'],
				'course' => $row['course_id'],
				'code' => $row['code'],
				'name' => $row['name'],
				'date_start' => $row['date_start'],
				'date_end' => $row['date_end'],
				'time_start' => $time_start,
				'time_end' => $time_end,
				'complete' => $row['complete'] == 0 ? "Aktif" : "Selesai",
				'created' => $row['created_on'],
			);
		}
	} else {
		$errors[]  = 'No record found';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "viewClass" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$result = mysql_query("SELECT * FROM `class` WHERE `active` = 1 AND `class_id` = $id");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rowsResult = array();
			if ($row['complete'] == 0) {
				$result = mysql_query("SELECT * FROM `course_apply` INNER JOIN `apply` ON `course_apply`.`noic` = `apply`.`noic` WHERE `course_apply`.`course` = " . $row['course_id'] . " AND (`course_apply`.`class` = " . $row['class_id'] . " OR `course_apply`.`class` IS NULL) ORDER BY `course_apply`.`course_apply_id`");
			} else if ($row['complete'] == 1) {
				$result = mysql_query("SELECT * FROM `course_apply` INNER JOIN `apply` ON `course_apply`.`noic` = `apply`.`noic` WHERE `course_apply`.`course` = " . $row['course_id'] . " AND `course_apply`.`class` = " . $row['class_id'] . " ORDER BY `course_apply`.`course_apply_id`");
			}
			while ($rowResult = mysql_fetch_assoc($result)) {
				$rowsResult[] = array(
					'id' => $rowResult['course_apply_id'],
					'name' => $rowResult['name'],
					'noic' => $rowResult['noic'],
					'gender' => (substr($rowResult['noic'],-1)%2) ? "Lelaki" : "Perempuan",
					'notel' => $rowResult['notel'],
					'email' => $rowResult['email'],
					'clas' => $rowResult['class'],
					'active' => $rowResult['active'],
				);
			}
			
			$rows['success'] = array(
				'id' => $row['class_id'],
				'course' => course_name($row['course_id']),
				'date_start' => $row['date_start'],
				'date_end' => $row['date_end'],
				'start_time' => $row['time_start'],
				'end_time' => $row['time_end'],
				'complete' => $row['complete'],
				'participant' => $rowsResult,
			);
		}
	} else {
		$errors['errors']  = 'No record found';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "classDetail" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$result = mysql_query("SELECT * FROM `class` WHERE `active` = 1 AND `class_id` = $id");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$selected_start = explode("/", $row['date_start']);
			$selected_end = explode("/", $row['date_end']);
			
			$rows['success'] = array(
				'id' => $row['course_id'],
				'start_day' => $selected_start[0],
				'start_month' => $selected_start[1],
				'start_year' => $selected_start[2],
				'end_day' => $selected_end[0],
				'end_month' => $selected_end[1],
				'end_year' => $selected_end[2],
				'start_time' => $row['time_start'],
				'end_time' => $row['time_end'],
				'classType' => $row['classType'],
				'complete' => $row['complete'],
			);
		}
	} else {
		$errors['errors']  = 'No record found';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "classSave") {
	$course = sanitize($_GET['course']);
	$start_day = sanitize($_GET['start_day']);
	$start_month = sanitize($_GET['start_month']);
	$start_year = sanitize($_GET['start_year']);
	$end_day = sanitize($_GET['end_day']);
	$end_month = sanitize($_GET['end_month']);
	$end_year = sanitize($_GET['end_year']);
	$start_time = sanitize($_GET['start_time']);
	$end_time = sanitize($_GET['end_time']);
	$classType = sanitize($_GET['classType']);
	$complete = sanitize($_GET['complete']);
	
	if (classes_exists($course) ===true) {
		$errors[] = 'Kursus \'' . course_name($course) . '\' sudah didaftarkan dan masih aktif.';
	}
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	} else {
		$addtime = date("j M Y - H:i");
		$add_data = array(
			'course_id' => $course,
			'date_start' => $start_day . "/" . $start_month . "/" .$start_year,
			'date_end' => $end_day . "/" . $end_month . "/" .$end_year,
			'time_start' => $start_time,
			'time_end' => $end_time,
			'classType' => $classType,
			'complete' => $complete,
			'created_on' => $addtime
		);
		add_class($add_data);
		
		mysql_query("UPDATE `course_apply` SET `status` = 3 WHERE `course` = $course AND (`status` = 1 OR `status` = 2)");
		
		$rows['success'] = 'Operasi berjaya';
	}
	
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "classEdit" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$course = sanitize($_GET['course']);
	$start_day = sanitize($_GET['start_day']);
	$start_month = sanitize($_GET['start_month']);
	$start_year = sanitize($_GET['start_year']);
	$end_day = sanitize($_GET['end_day']);
	$end_month = sanitize($_GET['end_month']);
	$end_year = sanitize($_GET['end_year']);
	$start_time = sanitize($_GET['start_time']);
	$end_time = sanitize($_GET['end_time']);
	$classType = sanitize($_GET['classType']);
	$complete = sanitize($_GET['complete']);
	
	if (class_id_exists($id) === true) {
		if (empty($errors) === true) {
			$addtime = date("j M Y - H:i");
			$update_data = array(
				'course_id' => $course,
				'date_start' => $start_day . "/" . $start_month . "/" .$start_year,
				'date_end' => $end_day . "/" . $end_month . "/" .$end_year,
				'time_start' => $start_time,
				'time_end' => $end_time,
				'classType' => $classType,
				'complete' => $complete,
				'created_on' => $addtime
			);
			update_class($id, $update_data);
			
			if ($complete == 1) { 
				mysql_query("UPDATE `course_apply` SET `status` = 2 WHERE `course` = $course AND `class` IS NULL");
				mysql_query("UPDATE `course_apply` SET `status` = 5 WHERE `course` = $course AND `class` IS NOT NULL");
			} else if ($complete == 0) { 
				mysql_query("UPDATE `course_apply` SET `status` = 3 WHERE `course` = $course AND `status` <> 4");
			}
			
			$rows['success'] = 'Operasi berjaya';
		}
	} else {
		$errors[] = 'Harap maaf, kursus tidak wujud.';
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	}
	
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "classDelete" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$result = mysql_query("SELECT * FROM `class` WHERE `active` = 1 AND `class_id` = $id");
	if (mysql_num_rows($result) != 0) {
		while ($row = mysql_fetch_assoc($result)) {
			if (class_id_exists($id) === true) {
				$delete = mysql_query("UPDATE `class` SET `active` = 0 WHERE `class_id` = $id");
			} else {
				$errors[] = 'Harap maaf, kelas tidak wujud.';
			}
			
			if($delete) {
				mysql_query("UPDATE `course_apply` SET `status` = 2 WHERE `course` = " . $row['course_id'] . " AND `class` IS NULL");
				mysql_query("UPDATE `course_apply` SET `status` = 5 WHERE `course` = " . $row['course_id'] . " AND `class` IS NOT NULL");
				$rows['success'] = 'Operasi berjaya';
			} else {
				$errors[] = 'Operasi tidak berjaya';
			}
		}
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	}
	
	echo json_encode($rows);
}
?>
<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

define('JPATH_BASE', realpath(__DIR__ . '/..'));
include '../core/define.php';
include '../core/init.php';

$rows = array();
if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "addList") {
	$result = mysql_query("SELECT * FROM `course` WHERE `active` = 1 ORDER BY `department`, `code`");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rows[] = array(
				'id' => $row['course_id'],
				'code' => $row['code'],
				'name' => $row['name'],
				'department' => department_name($row['department']),
				'content' => $row['contents'],
				'duration' => $row['duration'],
				'dur_term' => $row['dur_term'],
				'fee' => $row['fee']
			);
		}
	} else {
		$errors[]  = 'No record found';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "addAllList") {
	$result = mysql_query("SELECT * FROM `course` WHERE `active` = 1 ORDER BY `department`, `code`");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rows[] = array(
				'id' => $row['course_id'],
				'code' => $row['code'],
				'name' => $row['name'],
				'category' => category_name($row['category']),
				'department' => department_name($row['department']),
				'content' => $row['contents'],
				'duration' => $row['duration'],
				'dur_term' => $row['dur_term'],
				'fee' => $row['fee'],
				'active' => $row['active'],
			);
		}
	} else {
		$errors[]  = 'No record found';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "courseDetail" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$result = mysql_query("SELECT * FROM `course` WHERE `active` = 1 AND `course_id` = $id ORDER BY `department`, `code`");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rows['success'] = array(
				'id' => $row['course_id'],
				'code' => $row['code'],
				'name' => $row['name'],
				'category' => $row['category'],
				'department' => $row['department'],
				'content' => $row['contents'],
				'prerequisite' => $row['prerequisite'],
				'duration' => $row['duration'],
				'dur_term' => $row['dur_term'],
				'fee' => $row['fee'],
				'active' => $row['active'],
			);
		}
	} else {
		$errors['errors']  = 'No record found';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "courseSave") {
	$code = sanitize($_GET['code']);
	$name = sanitize($_GET['name']);
	$category = sanitize($_GET['category']);
	$department = sanitize($_GET['department']);
	$content = str_replace('\n', "\n", $_GET['content']);
	$prerequisite = sanitize($_GET['prerequisite']);
	$fee = sanitize($_GET['fee']);
	$duration = sanitize($_GET['duration']);
	$dur_term = sanitize($_GET['dur_term']);
	
	if (course_exists($code) === true) {
		$errors[] = 'Kod kursus \'' . $code . '\' sudah didaftarkan.';
	}
	if (is_numeric($fee) !== true) {
		$errors[] = 'Yuran kursus hanya mengandungi nombor sahaja.';
	}
	if (is_numeric($duration) !== true) {
		$errors[] = 'Tempoh latihan hanya mengandungi nombor sahaja.';
	}
	if (empty($errors) === true) {
		$addtime = date("j M Y - H:i");
		$add_data = array(
			'code' => strtoupper($code),
			'name' => strtoupper($name),
			'category' => $category,
			'department' => $department,
			'contents' => $content,
			'prerequisite' => $prerequisite,
			'fee' => $fee,
			'duration' => $duration,
			'dur_term' => $dur_term,
			'created_on' => $addtime
		);
		add_course($add_data);
		$rows['success'] = 'Operasi berjaya';
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	}
	
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "courseEdit" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$code = sanitize($_GET['code']);
	$name = sanitize($_GET['name']);
	$category = sanitize($_GET['category']);
	$department = sanitize($_GET['department']);
	$content = str_replace('\n', "\n", $_GET['content']);
	$prerequisite = sanitize($_GET['prerequisite']);
	$fee = sanitize($_GET['fee']);
	$duration = sanitize($_GET['duration']);
	$dur_term = sanitize($_GET['dur_term']);
	
	if (course_id_exists($id) === true) {
		$rowc = mysql_fetch_array(mysql_query("SELECT * FROM `course` WHERE `course_id` = $id"));
			
		if (course_exists($code) === true && $rowc['code'] !== $code) {
			$errors[] = 'Kod kursus \'' . $code . '\' sudah didaftarkan.';
		}
		if (is_numeric($fee) !== true) {
			$errors[] = 'Yuran kursus hanya mengandungi nombor sahaja.';
		}
		if (is_numeric($duration) !== true) {
			$errors[] = 'Tempoh latihan hanya mengandungi nombor sahaja.';
		}
		if (empty($errors) === true) {
			$addtime = date("j M Y - H:i");
			$update_data = array(
				'code' => strtoupper($code),
				'name' => strtoupper($name),
				'category' => $category,
				'department' => $department,
				'contents' => $content,
				'prerequisite' => $prerequisite,
				'fee' => $fee,
				'duration' => $duration,
				'dur_term' => $dur_term,
				'created_on' => $addtime
			);
			update_course($id, $update_data);
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

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "courseDelete" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	if (course_id_exists($id) === true) {
		$delete = mysql_query("UPDATE `course` SET `active` = 0 WHERE `course_id` = $id");
	} else {
		$errors[] = 'Harap maaf, kursus tidak wujud.';
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

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "getCourse" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$result = mysql_query("SELECT * FROM `course` WHERE `active` = 1 AND `course_id` = $id");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			echo '<div class="row">
				<div class="col-md-3"><strong>Kod Kursus :</strong></div>
				<div class="col-md-9">'.$row['code'].'</div>
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Nama Kursus :</strong></div>
				<div class="col-md-9">'.$row['name'].'</div>
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Bidang :</strong></div>
				<div class="col-md-9">' . department_name($row['department']) . '</div>
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Kandungan :</strong></div>
				<div class="col-md-9">'.nl2br($row['contents']).'</div>
			</div>';
			if (empty($row['prerequisite']) === false) {
				echo '<div class="row">
				<div class="col-md-3"><strong>Pra Syarat :</strong></div>
				<div class="col-md-9"><ul>';
					$prerequisite = explode(',',$row['prerequisite']);
					$array_prerequisite = count($prerequisite);
					for($i=0; $i < $array_prerequisite ; $i++){
						echo '<li>' . $prerequisite[$i] . '</li>';
					}
					echo '</ul></div>';
			}
			echo '</div>
			<div class="row">
				<div class="col-md-3"><strong>Tempoh Kursus :</strong></div>
				<div class="col-md-9">'.$row['duration'].' '.$row['dur_term'].'</div>
			</div>
			<div class="row">
				<div class="col-md-3"><strong>Yuran Kursus :</strong></div>
				<div class="col-md-9">RM'.$row['fee'].'.00</div>
			</div>';
		}
	}
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "getApply" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$result = mysql_query("SELECT * FROM `course` WHERE `active` = 1 AND `course_id` = $id");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			echo '<div id="error"></div>
			<div class="form-group">
				<label for="recipient-name" class="control-label">Kod Kursus :</label>
				<p class="form-control-static">'.$row['code'].'</p>
			</div>
			<div class="form-group">
				<label for="recipient-name" class="control-label">Nama Kursus :</label>
				<p class="form-control-static">'.$row['name'].'</p>
			</div>
			<div class="form-group">
				<label for="noic" class="control-label">No. Kad Pengenalan <span class="text-danger">*</span>:</label>
				<input type="text" class="form-control" id="noic" name="noic">
				<input type="hidden" class="form-control" id="course" name="course" value="'.$row['course_id'].'">
			</div>';
		}
	}
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "addAllDepart") {
	$result = mysql_query("SELECT * FROM `department` ORDER BY `depart_id`");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rows[] = array(
				'id' => $row['depart_id'],
				'name' => $row['name'],
			);
		}
	} else {
		$errors[] = 'Harap maaf, bahagian\bengkel tidak wujud.';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "departDetail" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$result = mysql_query("SELECT * FROM `department` WHERE `depart_id` = $id ORDER BY `depart_id`");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rows['success'] = array(
				'id' => $row['depart_id'],
				'name' => $row['name'],
			);
		}
	} else {
		$errors[] = 'Harap maaf, bahagian\bengkel tidak wujud.';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "departSave") {
	$name = sanitize($_GET['name']);
	
	if (depart_exists($name) === true) {
		$errors[] = 'Nama bahagian\bengkel \'' . $name . '\' sudah didaftarkan.';
	}
	
	if (empty($errors) === true) {
		$addtime = date("j M Y - H:i");
		$add_data = array(
			'name' => $name,
		);
		register_depart($add_data);
		$rows['success'] = 'Operasi berjaya';
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	}
	
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "departEdit" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$name = sanitize($_GET['name']);
	
	if (depart_id_exists($id) === true) {
		$rowc = mysql_fetch_array(mysql_query("SELECT * FROM `department` WHERE `depart_id` = $id"));
			
		if (depart_exists($name) === true && $rowc['name'] !== $name) {
			$errors[] = 'Nama bahagian\bengkel \'' . $name . '\' sudah didaftarkan.';
		}
		
		if (empty($errors) === true) {
			$addtime = date("j M Y - H:i");
			$update_data = array(
				'name' => $name,
			);
			update_depart($id, $update_data);
			$rows['success'] = 'Operasi berjaya';
			
		}
	} else {
		$errors[] = 'Harap maaf, bahagian\bengkel tidak wujud.';
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	}
	
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "departDelete" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	if (depart_id_exists($id) === true) {
		$delete = mysql_query("DELETE FROM `class` WHERE `course_id` IN (SELECT `course_id` FROM `course` WHERE `department` = '$id')");
		$delete = mysql_query("DELETE FROM `course_apply` WHERE `course` IN (SELECT `course_id` FROM `course` WHERE `department` = '$id')");
		$delete = mysql_query("DELETE FROM `course` WHERE `department` = '$id'");
		$delete = mysql_query("DELETE FROM `department` WHERE `depart_id` = $id");
	} else {
		$errors[] = 'Harap maaf, bahagian\bengkel tidak wujud.';
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

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "addAllCat") {
	$result = mysql_query("SELECT * FROM `category` ORDER BY `cat_id`");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rows[] = array(
				'id' => $row['cat_id'],
				'name' => $row['name'],
			);
		}
	} else {
		$errors[] = 'Harap maaf, kategori tidak wujud.';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "catDetail" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$result = mysql_query("SELECT * FROM `category` WHERE `cat_id` = $id ORDER BY `cat_id`");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rows['success'] = array(
				'id' => $row['cat_id'],
				'name' => $row['name'],
			);
		}
	} else {
		$errors[] = 'Harap maaf, kategori tidak wujud.';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "catSave") {
	$name = sanitize($_GET['name']);
	
	if (cat_exists($name) === true) {
		$errors[] = 'Nama kategori \'' . $name . '\' sudah didaftarkan.';
	}
	
	if (empty($errors) === true) {
		$addtime = date("j M Y - H:i");
		$add_data = array(
			'name' => $name,
		);
		register_cat($add_data);
		$rows['success'] = 'Operasi berjaya';
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	}
	
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "catEdit" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$name = sanitize($_GET['name']);
	
	if (cat_id_exists($id) === true) {
		$rowc = mysql_fetch_array(mysql_query("SELECT * FROM `category` WHERE `cat_id` = $id"));
			
		if (cat_exists($name) === true && $rowc['name'] !== $name) {
			$errors[] = 'Nama kategori \'' . $name . '\' sudah didaftarkan.';
		}
		
		if (empty($errors) === true) {
			$addtime = date("j M Y - H:i");
			$update_data = array(
				'name' => $name,
			);
			update_cat($id, $update_data);
			$rows['success'] = 'Operasi berjaya';
			
		}
	} else {
		$errors[] = 'Harap maaf, kategori tidak wujud.';
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	}
	
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "catDelete" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	if (cat_id_exists($id) === true) {
		$delete = mysql_query("DELETE FROM `category` WHERE `cat_id` = $id");
	} else {
		$errors[] = 'Harap maaf, kategori tidak wujud.';
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
?>
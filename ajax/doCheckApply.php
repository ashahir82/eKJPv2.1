<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

define('JPATH_BASE', realpath(__DIR__ . '/..'));
include '../core/define.php';
include '../core/init.php';

$rows = array();
$rowsResult = array();

if(isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "checkKP" && isset($_GET['noic']) && isset($_GET['course'])) {
	// username and password sent from Form
	$noic=sanitize($_GET['noic']);
	$course=sanitize($_GET['course']);
	
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
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	} else {
		$URL="index.php?p=apply.course&cid=" . $course . "&noic=" . $noic;
		$rows['success']  = $URL;
	}
	echo json_encode($rows);
}

if(isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "checkApply" && isset($_GET['noic'])) {
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
				$result = mysql_query("SELECT * FROM `course_apply` WHERE `noic` = " . $row['noic'] . " AND `active` = 1 ORDER BY `course_apply_id`");
				if (mysql_num_rows($result) != 0) {
					while (($rowResult = mysql_fetch_assoc($result)) != false) {
						$rowsResult[] = array(
							'caid' => $rowResult['course_apply_id'],
							'cid' => $rowResult['course'],
							'code' => course_code($rowResult['course']),
							'name' => course_name($rowResult['course']),
							'created' => $rowResult['created_on'],
							'stat' => status_name($rowResult['status'])
						);
					}
				} else {
				}
				$rows['success'] = array(
					'name' => $row['name'],
					'noic' => $row['noic'],
					'notel' => $row['notel'],
					'email' => $row['email'],
					'course' => $rowsResult
				);
			}
		}
	}
	echo json_encode($rows);
}

if(isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "applyCourse" && isset($_GET['cid']) && isset($_GET['noic'])) {
	// username and password sent from Form
	$cid=sanitize($_GET['cid']);
	$noic=sanitize($_GET['noic']);
	
	//course detail
	if (course_id_exists($cid) === true) {
		$cquery = mysql_query("SELECT * FROM `course` WHERE `course_id` = $cid");
		$rowc = mysql_fetch_array($cquery);
		$course = array(
			'id' => $rowc['course_id'],
			'code' => $rowc['code'],
			'course' => $rowc['name'],
			'category' => category_name($rowc['category']),
			'department' => department_name($rowc['department']),
			'content' => $rowc['contents'],
			'prerequisite' => $rowc['prerequisite'],
		);
	} else {
		$errors[] = 'Harap maaf, kursus tidak wujud.';
	}
	
	//User detail
	if (preg_match("/\\s/", $noic) == true) {
		$errors[] = 'No kad pengenalan tidak boleh mempunyai ruang.';
	}
	if (is_numeric($noic) !== true) {
		$errors[] = 'No kad pengenalan hanya mengandungi nombor sahaja.';
	}
	if (strlen($noic) <> 12) {
		$errors[] = 'No kad pengenalan anda tidak sah.';
	}
	
	if (noic_apply($noic) == true) {
		$uquery = mysql_query("SELECT * FROM `apply` WHERE `noic` = '$noic'");
		if (mysql_num_rows($uquery) != 0) {
			$rowu = mysql_fetch_array($uquery);
			$user = array(
				'name' => $rowu['name'],
				'noic' => $rowu['noic'],
				'nationality' => $rowu['nationality'],
				'address' => $rowu['address'],
				'postcode' => $rowu['postcode'],
				'notel' => $rowu['notel'],
				'email' => $rowu['email'],
			);
		}
	} else {
		$user = array(
			'noic' => $noic,
		);
	}
	
	if (!empty($errors)) {
		$rows['errors']  = $errors;
	} else {
		$rows['success'] = array_merge($course, $user);
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "saveApply") {
	$id = sanitize($_GET['id']);
	$time = sanitize($_GET['time']);
	$name = sanitize($_GET['name']);
	$noic = sanitize($_GET['noic']);
	$nationality = sanitize($_GET['nationality']);
	$address = str_replace('\n', "\n", $_GET['address']);
	$postcode = sanitize($_GET['postcode']);
	$notel = sanitize($_GET['notel']);
	$email = sanitize($_GET['email']);
	$accept = sanitize($_GET['accept']);
	
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
	 if (noic_kursus_exists($noic, $id)) {
		$errors[] = 'Anda mempunyai permohonan kursus ini yang masih aktif atau anda pernah menyertai kursus ini. Sila buat semakan permohonan.';
	 }
	if (empty($errors) === true) {
		//Get address
		$url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
		$url .= $_SERVER['SERVER_NAME'];
		$url .= $_SERVER['REQUEST_URI'];
		$urls = dirname(dirname($url));
		
		$addtime = date("j M Y - H:i");
		if (mohon_ic_exists($noic) === true) {
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
		} else {
			//mohon baru
			$add_data = array(
				'name' => ucwords(strtolower($name)),
				'noic' => $noic,
				'nationality' => $nationality,
				'address' => ucwords(strtolower($address)),
				'postcode' => $postcode,
				'notel' => $notel,
				'email' => $email,
				'created_on' => $addtime
			);
			add_pemohon($add_data);
		}
		
		$add_data = array(
			'course' => $id,
			'noic' => $noic,
			'time' => $time,
			'created_on' => $addtime
		);
		add_mohon_kursus($add_data);
		$mohon_kursus_id = add_mohon_kursus_id($add_data);
		
		$rows['success'] = array(
			'name' => $name,
			'noic' => $noic,
			'notel' => $notel,
			'email' => $email,
			'apply' => $mohon_kursus_id,
			'id' => $id,
			'code' => course_code($id),
			'course' => course_name($id),
			'created_on' => $addtime,
			'weblink' => $urls
		);
	} else {
		$rows['errors']  = $errors;
	}
	echo json_encode($rows);
}

if(isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "addAllApply") {
	//$result = mysql_query("SELECT `CA`.`course_apply_id` AS id, `A`.`name` AS name, `A`.`notel`, `A`.`email`, `CA`.`noic`, `C`.`code`, `C`.`name` AS course, `S`.`name` AS status , `CA`.`created_on` AS created, `CA`.`time` FROM `course_apply` AS CA INNER JOIN `apply` AS A ON `CA`.`noic`=`A`.`noic` INNER JOIN `course` AS C ON `CA`.`course`=`C`.`course_id` INNER JOIN `status` AS S ON `CA`.`status`=`S`.`status_id` WHERE `CA`.`active` = 1 AND `C`.`active` = 1 AND YEAR(STR_TO_DATE(`CA`.`created_on`,'%e %b %Y - %H:%i')) = '2017' ORDER BY `course_apply_id` DESC");
	$result = mysql_query("SELECT `CA`.`course_apply_id` AS id, `A`.`name` AS name, `A`.`notel`, `A`.`email`, `CA`.`noic`, `C`.`code`, `C`.`name` AS course, `S`.`name` AS status , `CA`.`created_on` AS created, `CA`.`time` FROM `course_apply` AS CA INNER JOIN `apply` AS A ON `CA`.`noic`=`A`.`noic` INNER JOIN `course` AS C ON `CA`.`course`=`C`.`course_id` INNER JOIN `status` AS S ON `CA`.`status`=`S`.`status_id` WHERE `CA`.`active` = 1 AND `C`.`active` = 1 AND (`CA`.`status` = 1 OR `CA`.`status` = 2 OR `CA`.`status` = 3) ORDER BY `course_apply_id` DESC");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			$rows[] = array(
				'id' => $row['id'],
				'name' => $row['name'],
				'noic' => $row['noic'],
				'notel' => $row['notel'],
				'email' => $row['email'],
				'code' => $row['code'],
				'course' => $row['course'],
				'stat' => $row['status'],
				'time' => $row['time'],
				'created' => $row['created'],
			);
		}
	} else {
		$errors[]  = 'No record found';
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "getApplyDetails" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	$result = mysql_query("SELECT `CA`.`course_apply_id` AS id, `A`.`name` AS name, `A`.`notel`, `A`.`email`, `CA`.`noic`, `C`.`code`, `C`.`name` AS course, `CA`.`class`, `CA`.`status`, `CA`.`created_on` AS created, `CA`.`time` FROM `course_apply` AS CA INNER JOIN `apply` AS A ON `CA`.`noic`=`A`.`noic` INNER JOIN `course` AS C ON `CA`.`course`=`C`.`course_id` INNER JOIN `status` AS S ON `CA`.`status`=`S`.`status_id` WHERE `CA`.`active` = 1 AND `CA`.`course_apply_id` = $id ORDER BY `course_apply_id` DESC");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			echo '<div id="error"></div>
			<div class="row">
				<div class="col-md-4"><strong>Kod Kursus :</strong></div>
				<div class="col-md-8">'.$row['code'].' - '.$row['course'].'</div>
				<input type="hidden" class="form-control" id="course" name="course" value="'.$row['id'].'">
			</div>
			<div class="row">
				<div class="col-md-4"><strong>Waktu Latihan :</strong></div>
				<div class="col-md-8">';
				if ($row['time'] == 1) { echo 'Hari Bekerja'; } else if ($row['time'] == 2) { echo 'Hujung Minggu'; }
			echo '</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>Nama Pemohon :</strong></div>
				<div class="col-md-8">' . $row['name'] . '</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>No. Kad Pengenalan :</strong></div>
				<div class="col-md-8">'.$row['noic'].'</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>Tarikh :</strong></div>
				<div class="col-md-8">'.$row['created'].'</div>
			</div>
			<hr>';
			if (empty($row['class']) === false) {
				echo '<div class="row">
					<div class="col-md-4"><strong>Kelas :</strong></div>
						<div class="col-md-4">'.$row['class'].'</div>
						<div class="col-md-4">
							<label>
								<input type="checkbox" id="noclass" name="noclass"> Padam?
							</label>
						</div>
					}
				</div>';
			}
			echo '<div class="row">
				<div class="col-md-4"><strong>Status :</strong></div>
				<div class="col-md-8">
					<select name="status" class="form-control" id="status">';
						if ($row['status'] == 1) { echo '<option value="1" selected="selected">Proses Semakan</option>'; } else { echo '<option value="1">Proses Semakan</option>'; }
						if ($row['status'] == 2) { echo '<option value="2" selected="selected">Proses Pengesahan</option>'; } else { echo '<option value="2">Proses Pengesahan</option>'; }
						if ($row['status'] == 3) { echo '<option value="3" selected="selected">Permohonan Diterima</option>'; } else { echo '<option value="3">Permohonan Diterima</option>'; }
						if ($row['status'] == 4) { echo '<option value="4" selected="selected">Permohonan Ditolak</option>'; } else { echo '<option value="4">Permohonan Ditolak</option>'; }
						if ($row['status'] == 5) { echo '<option value="5" selected="selected">Selesai</option>'; } else { echo '<option value="5">Selesai</option>'; }
			echo '</select>
				</div>
			</div>';
		}
	}
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "getEnroll" && isset($_GET['id'])) {
	$id = sanitize($_GET['id']);
	//Get address
	$url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
	$url .= $_SERVER['SERVER_NAME'];
	$url .= $_SERVER['REQUEST_URI'];
	$actual_link = dirname(dirname($url));

	$result = mysql_query("SELECT `CA`.`course_apply_id` AS id, `A`.`name` AS name, `A`.`notel`, `A`.`email`, `CA`.`noic`, `C`.`course_id` AS cid, `C`.`code` , `C`.`name` AS course, `CA`.`status` AS STATUS , `CA`.`created_on` AS created, `CA`.`class` , `CL`.`class_id`, `CL`.`date_start` , `CL`.`date_end` , `CL`.`time_start` , `CL`.`time_end` FROM `course_apply` AS CA INNER JOIN `apply` AS A ON `CA`.`noic` = `A`.`noic` INNER JOIN `course` AS C ON `CA`.`course` = `C`.`course_id` INNER JOIN `class` AS CL ON `CA`.`course` = `CL`.`course_id` INNER JOIN `status` AS S ON `CA`.`status` = `S`.`status_id` WHERE `CA`.`active` =1 AND `CA`.`course_apply_id` = $id AND `CL`.`complete` = 0 AND `CL`.`active` = 1 ORDER BY `CA`.`course_apply_id` DESC");
	//$result = mysql_query("SELECT  `CA`.`course_apply_id` AS id,  `A`.`name` AS name,  `A`.`notel` ,  `A`.`email`,  `CA`.`noic` ,  `C`.`course_id` AS cid,  `C`.`code` ,  `C`.`name` AS course, `CA`.`status` AS STATUS ,  `CA`.`created_on` AS created,  `CA`.`class` , `CL`.`class_id`,  `CL`.`date_start` ,  `CL`.`date_end` ,  `CL`.`time_start` ,  `CL`.`time_end` FROM  `course_apply` AS CA INNER JOIN  `apply` AS A ON  `CA`.`noic` =  `A`.`noic` INNER JOIN  `course` AS C ON  `CA`.`course` =  `C`.`course_id` INNER JOIN  `class` AS CL ON  `CA`.`course` =  `CL`.`course_id` INNER JOIN  `status` AS S ON  `CA`.`status` =  `S`.`status_id` WHERE  `CA`.`active` =1 AND `Cl`.`complete` = 0 ORDER BY  `CA`.`course_apply_id` DESC ");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_assoc($result)) {
			echo '<div id="result"></div>
			<div class="row">
				<div class="col-md-4"><strong>Nama Pemohon :</strong></div>
				<div class="col-md-8">' . $row['name'] . '</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>No. Kad Pengenalan :</strong></div>
				<div class="col-md-8">'.$row['noic'].'</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>Kod Kursus :</strong></div>
				<div class="col-md-8">'.$row['code'].' - '.$row['course'].'</div>
				<input type="hidden" class="form-control" id="course" name="course" value="'.$row['id'].'">
			</div>
			<div class="row">
				<div class="col-md-4"><strong>Tarikh :</strong></div>
				<div class="col-md-8">'.$row['date_start'].' - '.$row['date_end'].'</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>Masa :</strong></div>
				<div class="col-md-8">';
				if ($row['time_start'] <= 11) {
					echo $row['time_start'] . '.00 Pagi';
				} else if ($row['time_start'] >= 13 AND $row['time_start'] <= 18) {
					echo $row['time_start'] . '.00 Petang';
				} else if ($row['time_start'] >= 19 AND $row['time_start'] <= 24) {
					echo $row['time_start'] . '.00 Malam';
				} else {
					echo $row['time_start'] . '.00 Tengah Hari';
				}
				echo ' hingga ';
				if ($row['time_end'] <= 11) {
					echo $row['time_end'] . '.00 Pagi';
				} else if ($row['time_end'] >= 13 AND $row['time_end'] <= 18) {
					echo ($row['time_end'] - 12) . '.00 Petang';
				} else if ($row['time_end'] >= 19 AND $row['time_end'] <= 24) {
					echo ($row['time_end'] - 12) . '.00 Malam';
				} else {
					echo $row['time_end'] . '.00 Tengah Hari';
				}				
				echo '</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-4"><strong>Pengesahan :</strong></div>
				<div class="col-md-8" id="displayAccept">';
				if (empty($row['class']) == true) {
					echo '<div class="checkbox">
						<label>
							<input type="checkbox" id="accept" name="accept"> Saya setuju dengan tawaran kursus di atas.
						</label>
					</div>
					<input type="hidden" class="form-control" id="noic" name="noic" value="'.$row['noic'].'">
					<input type="hidden" class="form-control" id="class" name="class" value="'.$row['class_id'].'">
					<input type="hidden" class="form-control" id="capply" name="capply" value="'.$row['id'].'">
					<button type="button" class="btn btn-success btn-xs" id="saveEnroll">Simpan</button>';
				} else {
					echo '<a href="widgets/conform.letter.php?cid='.$row['cid'].'&noic='.$row['noic'].'&caid='.$row['id'].'" target="_blank" class="btn btn-success btn-xs" role="button"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Surat Tawaran</a>';
				}
				echo '</div>
			</div>
			<div class="row">
				<div class="col-md-4"><strong>Kod QR :</strong></div>
				<div class="col-md-8 text-center"><img src="'.$actual_link.'/qr_img/php/qr_img.php?d='.$actual_link.'/widgets%2Fconform.letter.php%3Fcid%3D'.$row['cid'].'%26noic%3D'.$row['noic'].'%26caid%3D'.$row['id'].'" alt="qr-code" align="center" width="132" height="132" >
				<p>Sila imbas kod QR untuk muat-turun surat tawaran di peranti mudah alih.</p></div>
			</div>';
		}
	} else {
		echo 'Tiada Rekod Ditemui.';
	}
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "saveEnroll" && isset($_GET['class']) && isset($_GET['capply'])) {
	$class = sanitize($_GET['class']);
	$capply = sanitize($_GET['capply']);
	if (mohon_kursus_id_exists($capply) === true && class_id_exists($class)) {
		$delete = mysql_query("UPDATE `course_apply` SET `class` = $class WHERE `course_apply_id` = $capply");
	} else {
		$errors[] = 'Harap maaf, permohonan tidak wujud.';
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

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "enrollSave" && isset($_GET['class']) && isset($_GET['capply']) && isset($_GET['cnot'])) {
	$class = sanitize($_GET['class']);
	$capply = sanitize($_GET['capply']);
	$cnot = sanitize($_GET['cnot']);
	
	if (class_id_exists($class) === true) {
		$class_id = $class;
		$update = explode(',',$capply);
		$remove = explode(',',$cnot);
		
		if (empty($capply) === false) {
			$id = count($update);
			if (count($id) > 0) {
				foreach ($update as $id_d) {
					$sql = "UPDATE `course_apply` SET `status` = 3 , `class` = '$class_id' WHERE `course_apply_id` = '$id_d'";
					$update = mysql_query($sql);
				}
			}
		}
		
		if (empty($cnot) === false) {
			$id = count($remove);
			if (count($id) > 0) {
				foreach ($remove as $id_d) {
					$sql = "UPDATE `course_apply` SET `status` = 3 , `class` = NULL WHERE `course_apply_id` = '$id_d'";
					$update = mysql_query($sql);
				}
			}
		}
		
		if($update) {
			$rows['success'] = 'Operasi berjaya';
		} else {
			$errors[] = 'Operasi tidak berjaya';
		}
	} else {
		$errors[] = 'Harap maaf, permohonan tidak wujud.';
	}
		
	if (empty($errors) === false){
		$rows['errors']  = $errors;
	}
	echo json_encode($rows);
}

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "saveApplyDetails" && isset($_GET['course']) && isset($_GET['status'])) {
	$id = sanitize($_GET['course']);
	$noclass = sanitize($_GET['noclass']);
	$status = sanitize($_GET['status']);
	
	if (mohon_kursus_id_exists($id) === true) {
		if ($noclass == 1) {
			$delete = mysql_query("UPDATE `course_apply` SET `status` = $status, `class` = NULL WHERE `course_apply_id` = $id");
		} else {
			$delete = mysql_query("UPDATE `course_apply` SET `status` = $status WHERE `course_apply_id` = $id");
		}
	} else {
		$errors[] = 'Harap maaf, permohonan tidak wujud.';
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

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "delApplyDetail" && isset($_GET['course']) && isset($_GET['status'])) {
	$id = sanitize($_GET['course']);
	$status = sanitize($_GET['status']);
	if (mohon_kursus_id_exists($id) === true) {
		$delete = mysql_query("UPDATE `course_apply` SET `active` = 0 WHERE `course_apply_id` = $id");
	} else {
		$errors[] = 'Harap maaf, permohonan tidak wujud.';
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

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "applyYes") {
	$delete = mysql_query("UPDATE `course_apply` as `ca`, (SELECT `course_id`, `active` FROM `class` WHERE `active` = 1) as `temp` SET `status` = 3 WHERE `temp`.`course_id` = `ca`.`course` AND (`ca`.`status` = 1 OR `ca`.`status` = 2)");
	
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

if (isset($_GET['action']) && empty($_GET['action']) === false && $_GET['action'] == "applyNo") {
	$delete = mysql_query("UPDATE `course_apply` as `ca`, (SELECT `course_id`, `active` FROM `course` WHERE `active` = 0) as `temp` SET `status` = 6 WHERE `temp`.`course_id` = `ca`.`course` AND `ca`.`status` <> 5");
	
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
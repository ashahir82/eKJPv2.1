<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

define('JPATH_BASE', realpath(__DIR__ . '/..'));
include '../core/define.php';
include '../core/init.php';

$rows = array();
$dates = array();
$days = array();
$step = '+1 day';
$output_format = 'd-m-Y';
$pos = 0;

$result = mysql_query("SELECT `CL`.* ,`C`.`code`, `C`.`name` FROM `class` AS `CL` INNER JOIN `course` AS `C` ON `CL`.`course_id` = `C`.`course_id` WHERE `CL`.`complete` = 0 AND `CL`.`active` = 1");
if (mysql_num_rows($result) != 0) {
	// output data of each row
	while ($row = mysql_fetch_assoc($result)) {
		$start = strtotime(str_replace('/', '-', $row['date_start']));
		$end = strtotime(str_replace('/', '-', $row['date_end']));
		unset($curr);
		unset($dates);
		unset($days);
		unset($day);
		
		$today = strtotime('-1 day', time());
		$difference = $start - $today;
		$datediff = floor($difference / 86400);

		while( $start <= $end ) {
			$dates[] = date($output_format, $start);
			$start = strtotime($step, $start);
		}
		
		foreach($dates as $dt) {			
			$curr = date("D", strtotime($dt));
			if ($row['classType'] == 1) {
				if ($curr == 'Mon' || $curr == 'Tue' || $curr == 'Wed' || $curr == 'Thu' || $curr == 'Fri') {
					$day .= $dt . '(' . $curr . '), ';
				}
			} else if ($row['classType'] == 2) {
				if ($curr == 'Sat' || $curr == 'Sun') {
					$day .= $dt . '(' . $curr . '), ';
				}
			} else if ($row['classType'] == 3) {
				$day .= $dt . '(' . $curr . '), ';
			} else if ($row['classType'] == 4) {
				if ($curr == 'Sun') {
					$day .= $dt . '(' . $curr . '), ';
				}
			}
		}
		
		$indicator .= '<li data-target="#carousel-example-generic" data-slide-to="' . $pos . '"';
		($pos == 0) ? $indicator .= ' class="active"' : $indicator .= '';
		$indicator .= '></li>';
		
		$content .= '<div class="item';
		($pos == 0) ? $content .= ' active' : $content .= '';
		$content .= '">
					<div class="item-content">
						<h3 class="text-blue events-title">' . $row['name'] . '</h3>
						<div class-"row">
							<div class="pull-left" style="width:100px">';
								if ($datediff < 0) {
									$content .= '<p class="calendar">0</i><em>Tamat</em></p>';
								} else if ($datediff > 0) {
									$content .= '<p class="calendar">'.$datediff.'<em>Hari lagi</em></p>';
								} else {
									$content .= '<p class="calendar">'.$datediff.'<em>Hari Ini</em></p>';
								}
								$content .= '
							</div>
							<div style="margin-left:100px;">
								<dl class="dl-horizontal">
									<dt class="text-green">Kod Kursus</dt>
									<dd>' . $row['code'] . '</dd>
									<dt class="text-green">Tajuk Kursus</dt>
									<dd>' . $row['name'] . '</dd>
									<dt class="text-green">Tarikh Kursus</dt>
									<dd>' . $day . '</dd>
									<dt class="text-green">Jenis Latihan</dt>';
									if ($row['classType'] == 1) {
										$content .= '<dd>Hari Bekerja</dd>';
									} else if ($row['classType'] == 2) {
										$content .= '<dd>Hujung Minggu</dd>';
									} else if ($row['classType'] == 3) {
										$content .= '<dd>Setiap Hari</dd>';
									} else if ($row['classType'] == 4) {
										$content .= '<dd>Setiap Ahad</dd>';
									}
								$content .= '
								</dl>
							</div>
						</div>
					</div>
				</div>';
		$pos += 1;
	}
	
	echo '<!-- Indicators -->
			<ol class="carousel-indicators">' . $indicator . '</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner event-list text-left" role="listbox">' . $content . '</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>';
	//echo json_encode($rows);
}
?>
<?php
define('JPATH_BASE', realpath(__DIR__ . '/..'));
include '../core/define.php';
include '../core/init.php';
require_once('../tcpdf/tcpdf.php');

if (isset($_GET['cid']) === true && empty($_GET['cid']) === false && isset($_GET['noic']) === true && empty($_GET['noic']) === false && isset($_GET['caid']) === true && empty($_GET['caid']) === false) {
	$course = (int)$_GET['cid'];
	$noic = $_GET['noic'];
	$apply = (int)$_GET['caid'];
}
// create new PDF document
$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator('HIKK ILPKL');
$pdf->SetAuthor('Ahmad Shahir Bin Husin @ Mukti');
$pdf->SetTitle('eKJP');
$pdf->SetSubject('Surat Setuju Terima Kursus');
$pdf->SetKeywords('eKJP, Kursus Jangka Pendek, Atas Talian, HIKK ILPKL');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins('15', '15', '15');

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// set font
$pdf->SetFont('helvetica', '', 10, '', true);

// add a page
$pdf->AddPage();

// Set some content to print
$crow = mysql_fetch_assoc(mysql_query("SELECT * FROM `course` WHERE `course_id` = " . $course));
$nrow = mysql_fetch_assoc(mysql_query("SELECT * FROM `apply` WHERE `noic` = " . $noic));
$arow = mysql_fetch_assoc(mysql_query("SELECT * FROM `course_apply` WHERE `course_apply_id` = " . $apply));
$clrow = mysql_fetch_assoc(mysql_query("SELECT * FROM `class` WHERE `class_id` = " . $arow['class']));

$html = '
<html>
<head>
<title>Surat Permohonan Kursus Jangka Pendek ILPKL</title>
<link href="../css/print.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" id="header" class="header">
      <tr>
        <td width="120"><img src="../images/jata-negara.png" width="101" height="80" alt="logo-jata-negara"></td>
        <td width="300"><span style="font-size: 10px">' . strtoupper($cfg_institute) . '<br />JABATAN TENAGA MANUSIA<br />(KEMENTERIAN SUMBER MANUSIA)<br />' . strtoupper($cfg_address) . '</span></td>
        <td width="200"><span style="font-size: 10px">Telefon Pejabat : ' . $cfg_telno . '<br />Faks : ' . $cfg_faxno . '<br />E-mel : ' . $cfg_email . '<br />Laman Web : ' . $cfg_website . '</span></td>
      </tr>
    </table>
	<br />
    <hr />
	<br />
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="160">Tarikh</td>
        <td width="20">:</td>
        <td width="440">' . date("j F Y") . '</td>
      </tr>
    </table>
    <p>' . $nrow['name'] . '<br />
    ' . $nrow['noic'] . '<br />
    ' . nl2br($nrow['address']) . '</p>
    <p>Tuan / Puan,</p>
    <h3>Tawaran Mengikuti Kursus Jangka Pendek</h3>
    <p>Terima kasih kerana memilih ' . ucwords(strtolower($cfg_institute)) . ' (' . strtoupper($cfg_short_inst) . ') untuk meningkatkan kemahiran dan pengetahuan anda dalam bidang industri pilihan anda.</p>
    <p>2. Sukacita dimaklumkan bahawa tuan/puan ditawarkan mengikuti Kursus Jangka Pendek di ' . ucwords(strtolower($cfg_institute)) . ' seperti ketetapan berikut:</p>
  <table width="100%" border="0" cellpadding="0" cellspacing="5" id="details">
      <tr>
        <td width="160">Nama Kursus</td>
        <td width="20">:</td>
        <td width="440">' . $crow['code'] . ' - ' . $crow['name'] . '</td>
      </tr>
      <tr>
        <td>Tarikh Mula Kursus</td>
        <td>:</td>
        <td>';
		
		$date = DateTime::createFromFormat('j/n/Y', $clrow['date_start']);
		
		$html .= $date->format('j F Y');
		$html .= '</td>
      </tr>
      <tr>
        <td>Tarikh Tamat Kursus</td>
        <td>:</td>
        <td>';
		
		$date = DateTime::createFromFormat('j/n/Y', $clrow['date_end']);
		
		$html .= $date->format('j F Y');
		$html .= '</td>
      </tr>
      <tr>
        <td>Tarikh Pendaftaran Kursus</td>
        <td>:</td>
        <td>';
		
		$date = DateTime::createFromFormat('j/n/Y', $clrow['date_start']);
		//$date->modify('-{$cfg_register_period} days');
		$date->modify('-9 day');
		
		$html .= $date->format('j F Y');
		
		$html .= '<strong> (Wajib)</strong></td>
      </tr>
      <tr>
        <td>Masa Kursus</td>
        <td>:</td>
        <td>';

            if ($clrow['time_start'] <= 11) {
                $html .= $clrow['time_start'] . '.00 Pagi';
            } else if ($clrow['time_start'] >= 13 AND $clrow['time_start'] <= 18) {
                $html .= $clrow['time_start'] . '.00 Petang';
            } else if ($clrow['time_start'] >= 19 AND $clrow['time_start'] <= 24) {
                $html .= $clrow['time_start'] . '.00 Malam';
            } else {
                $html .= $clrow['time_start'] . '.00 Tengah Hari';
            }
            $html .= ' hingga ';
            if ($clrow['time_end'] <= 11) {
                $html .= $clrow['time_end'] . '.00 Pagi';
            } else if ($clrow['time_end'] >= 13 AND $clrow['time_end'] <= 18) {
                $html .= ($clrow['time_end'] - 12) . '.00 Petang';
            } else if ($clrow['time_end'] >= 19 AND $clrow['time_end'] <= 24) {
                $html .= ($clrow['time_end'] - 12) . '.00 Malam';
            } else {
                $html .= $clrow['time_end'] . '.00 Tengah Hari';
            }
			
			//tempoh
			$start = strtotime(str_replace('/', '-', $clrow['date_start']));
			$end = strtotime(str_replace('/', '-', $clrow['date_end']));
			$dates = array();
			$step = '+1 day';
			$output_format = 'd-m-Y';
			$days = 0;

			while( $start <= $end ) {
				$dates[] = date($output_format, $start);
				$start = strtotime($step, $start);
			}
			
			foreach($dates as $dt) {			
				$curr = date("D", strtotime($dt));
				if ($clrow['classType'] == 1) {
					if ($curr == 'Mon' || $curr == 'Tue' || $curr == 'Wed' || $curr == 'Thu' || $curr == 'Fri') {
						$day .= $dt . '(' . $curr . '), ';
						$days += 1;
					}
				} else if ($clrow['classType'] == 2) {
					if ($curr == 'Sat' || $curr == 'Sun') {
						$day .= $dt . '(' . $curr . '), ';
						$days += 1;
					}
				} else if ($clrow['classType'] == 3) {
					$day .= $dt . '(' . $curr . '), ';
					$days += 1;
				} else if ($clrow['classType'] == 4) {
					if ($curr == 'Sun') {
						$day .= $dt . '(' . $curr . '), ';
						$days += 1;
					}
				}
			}
			
	$html .= '
        </td>
      </tr>
      <tr>
        <td>Tempoh Kursus</td>
        <td>:</td>
        <td>' . $days . ' Hari<br/>(' . $day . ')</td>
      </tr>
      <tr>
        <td>Yuran Kursus</td>
        <td>:</td>
        <td>RM' . $crow['fee'] . '.00</td>
      </tr>
      <tr>
        <td>Kaedah Bayaran</td>
        <td>:</td>
        <td>Rujuk Lampiran 1</td>
      </tr>
      <tr>
        <td>Persijilan</td>
        <td>:</td>
        <td>Sijil Penyertaan</td>
      </tr>
    </table>
    <p>3. Kerjasama pihak tuan untuk mengemukakan borang pengesahan kehadiran beserta bayaran yuran kursus (dalam bentuk <strong>Local Order (LO)</strong> atau <strong>Money Order</strong> atau <strong>Bank Draf</strong> atas nama <strong>Pengarah ' . ucwords(strtolower($cfg_institute)) . '</strong> pada hari pendaftaran. Bayaran yuran kursus boleh dibuat di <strong>' . ucwords(strtolower($cfg_division)) . ', ' . ucwords(strtolower($cfg_institute)) . '</strong> dengan cara datang sendiri atau melalui pos.</p>
    <p>4. Sebarang pertanyaan dan kemusykilan, sila hubungi <strong>' . ucwords(strtolower($cfg_division)) . '</strong> di talian <strong>' . $cfg_telno . '</strong> sambungan <strong>' . $cfg_extention . '</strong>.</p>
    <p>Sekian, terima kasih.</p>
    <p></p>
    <p><strong><em>"BERKHIDMAT UNTUK NEGARA"<br />"' . ucwords(strtolower($cfg_slogan)) . '"</em></strong></p>
    <p></p>
    <p>** Cetakan komputer, tandatangan tidak diperlukan.</p>
    <p></p>
    <p><strong>' . ucwords(strtolower($cfg_division)) . '<br />' . ucwords(strtolower($cfg_institute)) . '</strong></p>
<div class="page-break"></div>
<h2 style="text-align: center;">BORANG PENGESAHAN KEHADIRAN</h2>
<br />
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="150">Nama</td>
    <td width="10">:</td>
    <td colspan="4">' . $nrow['name'] . '</td>
  </tr>
  <tr>
    <td width="150">No. Kad Pengenalan</td>
    <td width="10">:</td>
    <td colspan="4">' . $nrow['noic'] . '</td>
  </tr>
  <tr>
    <td width="150">No. Telefon</td>
    <td width="10">:</td>
    <td width="150">' . $nrow['notel'] . '</td>
    <td width="150">Tarikh</td>
    <td width="10">:</td>
    <td width="150">' . date("j F Y") . '</td>
  </tr>
</table>
<br />
<hr />
<br />
<br />
<p>Kepada</p>
<p>' . ucwords(strtolower($cfg_division)) . '<br />' . ucwords(strtolower($cfg_institute)) . '<br />' . ucwords(strtolower($cfg_address)) . '</p>
<p>Tuan/Puan,</p>
<h3>Kursus Jangka Pendek ' . ucwords(strtolower($crow['name'])) . '</h3>
<br />
<p>Merujuk kepada perkara di atas, saya <strong>BERSETUJU / TIDAK BERSETUJU *</strong> mengikuti Kursus Jangka Pendek (' . ucwords(strtolower($crow['name'])) . ') seperti yang terkandung dalam surat tawaran.</p>
<p>2. Bersama ini disertakan yuran kursus sebanyak <strong>RM' . $crow['fee'] . '.00</strong> dalam bentuk <strong>Local Order (LO) / Money Order / Bank Draf *</strong> atas nama <strong>Pengarah ' . ucwords(strtolower($cfg_institute)) . '</strong> bernombor ____________________.</p>
<p>3. Sekian untuk makluman dan tindakan pihak tuan.</p>
<p>Sekian, terima kasih.</p>
<br />
<br />
<br />
<br />
<br />
<br />
<p>..............................</p>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<p><strong>** Sila FAKS ATAU POS borang jawapan ini atau telefon samada bersetuju atau tidak bersetuju kepada ' . ucwords(strtolower($cfg_division)) . ' di No. Faks ' . ucwords(strtolower($cfg_faxno)) . ' atau No. Telefon ' . ucwords(strtolower($cfg_telno)) . ' sambungan ' . ucwords(strtolower($cfg_extention)) . '.</strong></p>';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$filerename = 'Setuju Terima -' . $nrow['name'] . '.pdf';
$pdf->Output($filerename, 'I');
?>
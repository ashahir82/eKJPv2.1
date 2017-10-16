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
$pdf->SetSubject('Surat Permohonan Kursus');
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
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];

$html = '
<html>
<head>
<title>Surat Permohonan Kursus Jangka Pendek ILPKL</title>
<link href="../css/print.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="18" colspan="4" align="center"><strong><img src="../images/jata-negara.png" width="101" height="80" alt="logo-jata-negara"></strong></td>
  </tr>
  <tr>
    <td height="18" colspan="4" align="center"><h2>' . strtoupper($cfg_institute) . '</h2></td>
  </tr>
  <tr>
    <td height="18" colspan="4" align="center"><h3>Permohonan Kursus Secara Atas Talian</h3></td>
  </tr>
  <tr>
    <td height="18" colspan="4" align="center"><h3>(Online)</h3></td>
  </tr>
  <tr>
    <td height="18" colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="18">&nbsp;</td>
    <td height="18">&nbsp;</td>
    <td height="18"><strong>Tarikh</strong></td>
    <td height="18">: ' . $arow['created_on'] . '</td>
  </tr>
  <tr>
    <td height="18" colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="18"><strong>Nama</strong></td>
    <td height="18" colspan="3">: ' . $nrow['name'] . '</td>
  </tr>
  <tr>
    <td height="18"><strong>No. Kad Pengenalan</strong></td>
    <td height="18" colspan="3">: ' . $nrow['noic'] . '</td>
  </tr>
  <tr>
    <td height="18" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="4">Tuan/Puan,</td>
  </tr>
  <tr>
    <td height="18" colspan="4" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="4"><strong>PERMOHONAN KURSUS ' . $crow['name'] . ' (' . $crow['code'] . ')</strong></td>
  </tr>
  <tr>
    <td height="18" colspan="4"><strong>TEMPAT : ' . strtoupper($cfg_institute) . '</strong></td>
  </tr>
  <tr>
    <td height="18" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="4">Adalah dimaklumkan bahawa permohonan tuan/puan telah didaftar dan akan diproses. Sekiranya permohonan anda berjaya, <strong>surat tawaran akan dikeluarkan.</strong></td>
  </tr>
  <tr>
    <td height="18" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="4">2. Tuan/puan boleh menyemak status permohonan kursus yang dipohon melalui portal rasmi ' . ucwords(strtolower($cfg_institute)) . ' di <strong><em>' . $cfg_website . '</em></strong> dari masa ke semasa.</td>
  </tr>
  <tr>
    <td height="18" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="4">Sekian, terima kasih.</td>
  </tr>
  <tr>
    <td height="18" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="4"><strong><em>"BERKHIDMAT UNTUK NEGARA"</strong></em></td>
  </tr>
  <tr>
    <td height="18" colspan="4"><strong><em>"' . strtoupper($cfg_slogan) . '"</strong></em></td>
  </tr>
  <tr>
    <td height="18" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="4"><strong>(' . strtoupper($cfg_division) . ')</strong></td>
  </tr>
  <tr>
    <td height="18" colspan="4">b.p. Pengarah ' . ucwords(strtolower($cfg_institute)) . '</td>
  </tr>
  <tr>
    <td height="18" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="3"><strong>Nota :</strong></td>
	<td height="72" rowspan="7" align="center"><img src="'.$actual_link.'/ekjp/qr_img/php/qr_img.php?d=www.ilpkl.gov.my/ekjp/widgets%2Fapply.letter.php%3Fcid%3D'.$course.'%26noic%3D'.$noic.'%26caid%3D'.$apply.'" alt="qr-code" align="center" width="132" height="132" ></td>
  </tr>
  <tr>
    <td height="18" colspan="3">Sebarang pertanyaan mengenai permohonan ini sila hubungi:</td>
  </tr>
  <tr>
    <td height="18">No. Telefon</td>
    <td height="18" colspan="2"> : ' . $cfg_telno . ' (samb : ' . $cfg_extention . ')</td>
  </tr>
  <tr>
    <td height="18">No. Faksimili</td>
    <td height="18" colspan="2"> : ' . $cfg_faxno . '</td>
  </tr>
  <tr>
    <td height="18">Alamat Email</td>
    <td height="18" colspan="2"> : ' . $cfg_email . '</td>
  </tr>
  <tr>
    <td height="18" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="3">Sila imbas kod QR untuk muat-turun borang permohonan di peranti mudah alih.</td>
  </tr>
</table>
</body>
</html>';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$filerename = 'Permohonan Kursus -' . $nrow['name'] . '.pdf';
$pdf->Output($filerename, 'I');
?>
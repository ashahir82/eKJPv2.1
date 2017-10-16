<?php
function sanitize($data) {
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function array_sanitize (&$item) {
	$item =  htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function output_errors($errors) {
	return '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> ' . implode('</div><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> ', $errors) . '</div>';
}
?>
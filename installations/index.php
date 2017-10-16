<?php
define('JPATH_BASE', __DIR__);
include 'core/define.php';

/*
 * Check if a configuration file already exists.
 */
if (file_exists(JPATH_CONFIGURATION . '/configuration.php') && !file_exists(JPATH_INSTALLATION . '/index.php'))
{
	header('Location: ../index.php');
	exit();
} else if (!file_exists(JPATH_CONFIGURATION . '/configuration.php') && file_exists(JPATH_INSTALLATION . '/index.php'))
{
	include 'core/init.php';
	?>
	<html lang="ms">
		<?php
		include 'overall/head.php';
		?>
		<body>
			<?php
			include 'overall/navbar.php';
			include 'overall/content.php';
			include 'overall/footer.php';
			?>
		</body>
	</html>
	<?php
}
?>
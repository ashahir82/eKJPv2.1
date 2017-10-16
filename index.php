<?php
define('JPATH_BASE', __DIR__);
include 'core/define.php';

// Installation check, and check on removal of the install directory.
if (!file_exists(JPATH_CONFIGURATION . '/configuration.php'))
{
	if (file_exists(JPATH_INSTALLATION . '/index.php'))
	{
		//If no config file and installation index exists
		header('Location: ' . substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], 'index.php')) . 'installation/index.php');
		exit;
	}
	else
	{
		//if no config file and no installation index exists
		echo 'No configuration file found and no installation code available. Exiting...';
		exit;
	}
} else if (file_exists(JPATH_CONFIGURATION . '/configuration.php'))
{
	if (file_exists(JPATH_INSTALLATION . '/index.php'))
	{
		echo 'Tahniah<br>Installasi Sistem Jangka Pendek berjaya.<br>Sila padam/buang folder <i>installation</i> untuk menggunakan sistem ini.';
		exit;
	}
	else
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
}
?>
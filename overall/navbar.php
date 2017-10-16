<h1 class="v4-tease">Sistem Pengurusan Kursus Jangka Pendek</h1>
<div class="navbar navbar-default navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand"><img height="25" alt="Brand" src="images/logo.png"></a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-ex-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="http://<?php echo $cfg_website; ?>" target="_self"><span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> Portal <?php echo strtoupper($cfg_short_inst); ?></a>
				</li>
				<li class="active">
					<a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Utama</a>
				</li>
				<li>
					<?php
					if (logged_in() === true) {
						echo '<a href="index.php?p=logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Keluar</a>';
					} else {
						echo '<a href="index.php?p=login"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Log Masuk</a>';
					}
					?>
				</li>
			</ul>
		</div>
	</div>
</div>
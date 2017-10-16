<?php
protect_page();
?>
<div class="section">
	<div class="container text-center">
		<div class="row text-left">
			<?php if ($user_data['level'] == 1) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<a href="index.php?p=setting">
							<span class="info-box-icon bg-navy"><i class="fa fa-cog fa-fw"></i></span>
						</a>
						<div class="info-box-content">
							<span class="info-box-text">Tetapan Global</span>
							<span class="info-box-number"><small>Papar dan sunting tetapan aplikasi.</small></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<a href="index.php?p=users">
							<span class="info-box-icon bg-teal"><i class="fa fa-user fa-fw"></i></span>
						</a>
						<div class="info-box-content">
							<span class="info-box-text">Pengguna Aplikasi</span>
							<span class="info-box-number"><small>Papar dan daftar pengguna aplikasi.</small></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->

				<!-- fix for small devices only -->
				<div class="clearfix visible-sm-block"></div>

				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<a href="index.php?p=depart">
							<span class="info-box-icon bg-orange"><i class="fa fa-university fa-fw"></i></span>
						</a>
						<div class="info-box-content">
							<span class="info-box-text">Bahagian / Bengkel</span>
							<span class="info-box-number"><small>Papar dan daftar bahagian / bengkel.</small></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
					</div>
				<!-- /.col -->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="info-box">
						<a href="index.php?p=category">
							<span class="info-box-icon bg-maroon"><i class="fa fa-tasks fa-fw"></i></span>
						</a>
						<div class="info-box-content">
							<span class="info-box-text">Kategori Program</span>
							<span class="info-box-number"><small>Papar dan daftar kategori program.</small></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
			</div>
			<hr>
		<?php } ?>
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="circle-tile">
					<a href="index.php?p=apply">
						<div class="circle-tile-heading bg-blue">
							<i class="fa fa-file-text fa-fw fa-2x"></i>
						</div>
					</a>
					<div class="circle-tile-content bg-blue">
						<div class="circle-tile-description text-faded">
							Permohonan mengikuti kursus jangka pendek melalui laman aplikasi eKJP.
						</div>
						<a href="index.php?p=apply" class="circle-tile-footer">Permohonan Kursus <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="circle-tile">
					<a href="index.php?p=course">
						<div class="circle-tile-heading bg-green">
							<i class="fa fa-newspaper-o fa-fw fa-2x"></i>
						</div>
					</a>
					<div class="circle-tile-content bg-green">
						<div class="circle-tile-description text-faded">
							Senarai dan daftar kursus jangka pendek yang akan ditawarkan.
						</div>
						<a href="index.php?p=course" class="circle-tile-footer">Daftar Kursus <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="circle-tile">
					<a href="index.php?p=application">
						<div class="circle-tile-heading bg-orange">
							<i class="fa fa-search fa-fw fa-2x"></i>
						</div>
					</a>
					<div class="circle-tile-content bg-orange">
						<div class="circle-tile-description text-faded">
							Senarai dan semak status permohonan kursus jangka pendek.
						</div>
						<a href="index.php?p=application" class="circle-tile-footer">Semakan Permohonan <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="circle-tile">
					<a href="index.php?p=class">
						<div class="circle-tile-heading bg-yellow">
							<i class="fa fa-calendar-o fa-fw fa-2x"></i>
						</div>
					</a>
					<div class="circle-tile-content bg-yellow">
						<div class="circle-tile-description text-faded">
							Senarai dan daftar kursus jangka pendek yang dijalankan.
						</div>
						<a href="index.php?p=class" class="circle-tile-footer">Senarai Kursus <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="circle-tile">
					<a href="index.php?p=guide">
						<div class="circle-tile-heading bg-red">
							<i class="fa fa-tasks fa-fw fa-2x"></i>
						</div>
					</a>
					<div class="circle-tile-content bg-red">
						<div class="circle-tile-description text-faded">
							Panduan permohonan kursus jangka pendek melalui laman aplikasi eKJP.
						</div>
						<a href="index.php?p=guide" class="circle-tile-footer">Panduan Permohonan <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="circle-tile">
					<a href="index.php?p=term">
						<div class="circle-tile-heading bg-purple">
							<i class="fa fa-bars fa-fw fa-2x"></i>
						</div>
					</a>
					<div class="circle-tile-content bg-purple">
						<div class="circle-tile-description text-faded">
							Syarat-syarat permohonan kursus jangka pendek melalui laman aplikasi eKJP.
						</div>
						<a href="index.php?p=term" class="circle-tile-footer">Syarat Permohonan <i class="fa fa-chevron-circle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
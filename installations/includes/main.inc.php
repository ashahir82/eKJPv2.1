<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Konfigurasi Sistem</h2>
			<hr class="half-rule">
		</div>
		<div id="error"></div>
		<form action="" method="post" class="form-horizontal applyForm">
			<div id="sf1" class="frm">
				<h4 class="text-center text-primary">SELAMAT DATANG</h4>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-8">
						<p>Selamat datang ke Sistem Kursus Jangka Pendek Institut Latihan Jabatan Tenaga Manusia. Sistem ini diwujudkan untuk membantu pihak Institut dalam pelaksaaan kursus jangka pendek dan separuh masa.</p>
						<p>Laman ini akan membantu anda untuk menyiapkan pemasangan sistem ini. Jika terdapat sebarang masalah atau pertanyaan sila hubungi Pembangun Aplikasi, Ahmad Shahir BIn Husin @ Mukti, Institut Latihan Perindustrian Kuala Lumpur (ILPKL) di talian 03-7981 7495/6 atau e-mel di alamat ashahir@jtm.gov.my.</p>
						<p>Terima kasih kerana menggunakan sistem ini.</p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-success open1" type="button">Kemudian <span class="fa fa-arrow-right"></span></button> 
					</div>
				</div>
			</div>
			<div id="sf2" class="frm" style="display: none;">
				<h4 class="text-center text-primary">PANGKALAN DATA</h4>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Hostname <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="dbhost" placeholder="Hostname" name="dbhost">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Username <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="dbuser" placeholder="Username" name="dbuser">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Katalaluan</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="dbpass" placeholder="Katalaluan" name="dbpass">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Nama Pangkalan Data <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="dbname" placeholder="Nama Pangkalan Data" name="dbname">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="index.php" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
						<!-- back2 unique class name  -->
						<button class="btn btn-warning back2" type="button"><span class="fa fa-arrow-left"></span> Sebelum</button> 
						<!-- open2 unique class name -->
						<button class="btn btn-success open2" type="button">Kemudian <span class="fa fa-arrow-right"></span></button> 
					</div>
				</div>
			</div>
			<div id="sf3" class="frm" style="display: none;">
				<h4 class="text-center text-primary">PENTADBIR SISTEM</h4>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Nama Penuh <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="fullname" placeholder="Nama Penuh" name="fullname">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">No. Telefon <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="notel" placeholder="No. Telefon" name="notel">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Alamat E-mel <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="email" placeholder="Alamat E-mel" name="email">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Nama Pengguna <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="username" placeholder="Nama Pengguna" name="username">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Katalaluan <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="password" placeholder="Katalaluan" name="password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="index.php" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
						<!-- back2 unique class name  -->
						<button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Sebelum</button> 
						<!-- open2 unique class name -->
						<button class="btn btn-success open3" type="button">Kemudian <span class="fa fa-arrow-right"></span></button> 
					</div>
				</div>
			</div>
			<div id="sf4" class="frm" style="display: none;">
				<h4 class="text-center text-primary">PROFIL INSTITUT</h4>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Nama Institut <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="institute" placeholder="Nama Institut" name="institute">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Singkatan Institut <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inst_short" placeholder="Singkatan Institut" name="inst_short">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Bahagian / Unit <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="division" placeholder="Bahagian / Unit" name="division">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Alamat Institut <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="address" placeholder="Alamat Institut" name="address">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">No. Telefon <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inst_notel" placeholder="No. Telefon" name="inst_notel">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Sambungan <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inst_extention" placeholder="Sambungan" name="inst_extention">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">No. Faks <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inst_nofax" placeholder="No. Faks" name="inst_nofax">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Alamat E-mel <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inst_email" placeholder="Alamat E-mel" name="inst_email">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Laman Web / Portal <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="inst_website" placeholder="Laman Web / Portal" name="inst_website">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="index.php" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
						<!-- back2 unique class name  -->
						<button class="btn btn-warning back4" type="button"><span class="fa fa-arrow-left"></span> Sebelum</button> 
						<!-- open2 unique class name -->
						<button class="btn btn-success open4" type="button">Kemudian <span class="fa fa-arrow-right"></span></button> 
					</div>
				</div>
			</div>
			<div id="sf5" class="frm" style="display: none;">
				<h4 class="text-center text-primary">SURAT PERMOHONAN/TAWARAN</h4>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Slogan Surat <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="slogan" placeholder="Slogan Surat" name="slogan">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Tempoh Pendaftaran <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="registration" placeholder="Tempoh Pendaftaran" name="registration" min="1">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="index.php" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
						<!-- back2 unique class name  -->
						<button class="btn btn-warning back5" type="button"><span class="fa fa-arrow-left"></span> Sebelum</button> 
						<button type="button" class="btn btn-success" id="saveApply"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Install</button>
					</div>
				</div>
			</div>
		</form>
		<hr class="half-rule">
	</div>
</div>
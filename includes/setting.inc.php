<?php
protect_page();
?>
<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Konfigurasi Sistem</h2>
			<hr class="half-rule">
		</div>
		<div id="error"></div>
			<form action="" method="post" class="form-horizontal applyForm">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#data" aria-controls="data" role="tab" data-toggle="tab">Data</a></li>
					<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Institut</a></li>
					<li role="presentation"><a href="#letter" aria-controls="letter" role="tab" data-toggle="tab">Surat</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="data">
						<h4 class="text-center text-primary">PANGKALAN DATA</h4>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Hostname <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="dbhost" placeholder="Hostname" name="dbhost" value="<?php echo $cfg_host; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Username <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="dbuser" placeholder="Username" name="dbuser" value="<?php echo $cfg_user; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Katalaluan</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="dbpass" placeholder="Katalaluan" name="dbpass" value="<?php echo $cfg_password; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Nama Pangkalan Data <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="dbname" placeholder="Nama Pangkalan Data" name="dbname" value="<?php echo $cfg_db; ?>">
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="profile">
						<h4 class="text-center text-primary">PROFIL INSTITUT</h4>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Nama Institut <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="institute" placeholder="Nama Institut" name="institute" value="<?php echo $cfg_institute; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Singkatan Institut <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inst_short" placeholder="Singkatan Institut" name="inst_short" value="<?php echo $cfg_short_inst; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Bahagian / Unit <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="division" placeholder="Bahagian / Unit" name="division" value="<?php echo $cfg_division; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Alamat Institut <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="address" placeholder="Alamat Institut" name="address" value="<?php echo $cfg_address; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">No. Telefon <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inst_notel" placeholder="No. Telefon" name="inst_notel" value="<?php echo $cfg_telno; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Sambungan <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inst_extention" placeholder="Sambungan" name="inst_extention" value="<?php echo $cfg_extention; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">No. Faks <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inst_nofax" placeholder="No. Faks" name="inst_nofax" value="<?php echo $cfg_faxno; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Alamat E-mel <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inst_email" placeholder="Alamat E-mel" name="inst_email" value="<?php echo $cfg_email; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Laman Web / Portal <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inst_website" placeholder="Laman Web / Portal" name="inst_website" value="<?php echo $cfg_website; ?>">
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="letter">
						<h4 class="text-center text-primary">SURAT PERMOHONAN/TAWARAN</h4>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Slogan Surat <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="slogan" placeholder="Slogan Surat" name="slogan" value="<?php echo $cfg_slogan; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Tempoh Pendaftaran <span class="text-danger">*</span></label>
							<div class="col-sm-10">
								<input type="number" class="form-control" id="registration" placeholder="Tempoh Pendaftaran" name="registration" min="1" value="<?php echo $cfg_register_period; ?>">
							</div>
						</div>
					</div>
				</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="button" class="btn btn-success" id="saveSetting"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan</button>
					<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
				</div>
			</div>
		</form>
		<hr class="half-rule">
	</div>
</div>
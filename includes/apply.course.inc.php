<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Permohonan Kursus</h2>
			<hr class="half-rule">
		</div>
		<div id="error"></div>
		<form action="" method="post" class="form-horizontal applyForm">
			<h4 class="text-center text-primary">KURSUS DIPOHON</h4>
			<div class="form-group">
				<label class="col-sm-2 control-label">Kategori Kursus</label>
				<div class="col-sm-10">
					<p class="form-control-static" id="category"></p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Bidang Kursus</label>
				<div class="col-sm-10">
					<p class="form-control-static" id="department"></p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Nama Kursus</label>
				<div class="col-sm-10">
					<p class="form-control-static" id="course"></p>
					<input type="hidden" class="form-control" id="id" name="id">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Waktu Latihan <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<select class="form-control" id="time" name="time">
						<option value=''>Sila pilih Waktu Latihan...</option>
						<option value='1' <?php if (empty($_POST) === false && empty($_POST) === false) { if ($_POST['time'] == '1') { echo 'selected="selected"'; } } ?>>Hari Bekerja</option>
						<option value='2' <?php if (empty($_POST) === false && empty($_POST) === false) { if ($_POST['time'] == '2') { echo 'selected="selected"'; } } ?>>Hujung Minggu</option>
					</select>
				</div>
			</div>
			<div class="form-group praSyarat" id="praSyarat">
				<label class="col-sm-2 control-label">Pra-Syarat <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="prerequisite" name="prerequisite"> Saya faham dan memenuhi syarat yang dinyatakan.
						</label>
					</div>
					<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-sm">Baca Pra-Syarat</button>
				</div>
			</div>
			<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header bg-primary">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h5 class="modal-title">Pra-Syarat Kursus</h5>
						</div>
						<div class="modal-body">
							<p class="text-warning">Untuk mengikuti kursus ini, pemohon perlu memenuhi pra-syarat berikut:</p>
							<ol id="preList">
							</ol>
							<p class="text-warning">Kegagalan peserta untuk mematuhi pra-syarat ini boleh mengganggu kelancaran kursus.</p>
						</div>
						<div class="modal-footer bg-primary">
							<button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Tutup</button>
						</div>
					</div>
				</div>
			</div>
			<h4 class="text-center text-primary">BUTIR-BUTIR PERIBADI</h4>
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Nama <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="name" placeholder="Nama penuh" name="name">
				</div>
			</div>
			<div class="form-group">
				<label for="noic" class="col-sm-2 control-label">No. KP <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="noic" placeholder="No kad pengenalan" name="noic" readonly>
				</div>
			</div>
			<div class="form-group">
				<label for="nationality" class="col-sm-2 control-label">Kewarganegaraan <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<select class="form-control" id="nationality" placeholder="Status warganegara" name="nationality">
						<option value=''>Sila pilih Kewarganegaraan...</option>
						<option value='1'>Warganeraga</option>
						<option value='2'>Bukan Warganegara</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">Alamat <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<textarea class="form-control" rows="3" id="address" placeholder="Alamat surat menyurat" name="address"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="postcode" class="col-sm-2 control-label">Poskod <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="postcode" placeholder="Poskod" name="postcode">
				</div>
			</div>
			<div class="form-group">
				<label for="notel" class="col-sm-2 control-label">No. Telefon <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="notel" placeholder="No telefon" name="notel">
				</div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Alamat E-mel <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="email" placeholder="Alamat e-mel" name="email">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<small class="text-danger">* Saya mengaku bahawa segala maklumat diri dan maklumat perkara yang dikemukakan oleh saya adalah benar dan saya bertanggungjawab ke atasnya.</small>
				</div>
				<div class="col-sm-offset-2 col-sm-10">
					<small class="text-danger">* ILPKL berhak untuk menolak permohonan yang dikemukakan oleh saya sekiranya didapati maklumat yang diberikan adalah palsu.</small>
				</div>
				<div class="col-sm-offset-2 col-sm-10">
					<small class="text-danger">* ILPKL tidak bertanggungjawab terhadap sebarang kehilangan dan kerosakan yang dialami kerana menggunakan perkhidmatan eKursus ini.</small>
				</div>
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="accept" name="accept"> Bersetuju dengan syarat di atas
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="button" class="btn btn-success" id="saveApplyCourse"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Daftar</button>
					<a href="index.php?p=apply" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
				</div>
			</div>
			<?php if(isset($_GET['cid']) && isset($_GET['noic'])) { ?>
			<script language="javascript" type="text/javascript">loadApplyCourse(<?php echo $_GET['cid']; ?>, <?php echo $_GET['noic']; ?>);</script>
			<?php } else { ?>
			<script language="javascript" type="text/javascript">$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');</script>
			<?php } ?>
		</form>
		<hr class="half-rule">
	</div>
</div>
<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Maklumat Pemohon</h2>
			<hr class="half-rule">
		</div>
		<div id="error"></div>
		<form action="" method="post" class="form-horizontal applyForm">
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
					<input type="text" class="form-control" id="noic" placeholder="No kad pengenalan" name="noic">
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
					<button type="button" class="btn btn-success" id="saveApplyCourse"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan</button>
					<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
				</div>
			</div>
		</form>
		<hr class="half-rule">
	</div>
</div>
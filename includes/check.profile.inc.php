<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Semakan Profile Pemohon</h2>
			<hr class="half-rule">
		</div>
		<div id="error"></div>
		<div class="row">
			<div class="col-md-12 profileCheck">
				<form class="form-horizontal">
					<div class="form-group">
						<div class="col-sm-2">
							<label for="noic" class="control-label">Kad Pengenalan <span class="text-danger">*</span></label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="noic" name="noic" placeholder="Kad Pengenalan">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-success" id="checkProfile" name="checkProfile"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Semak</button>
							<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<form action="" method="post" class="form-horizontal profileForm"  style="display: none">
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
					<button type="button" class="btn btn-success" id="saveProfile"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan</button>
					<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
				</div>
			</div>
		</form>
		<hr class="half-rule">
	</div>
</div>
<?php
protect_page();
?>
<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Senarai Peserta Kursus</h2>
			<hr class="half-rule">
		</div>
		<div id="error"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Panel title</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Kursus</label>
							<div class="col-sm-10">
								<p class="form-control-static" id="course"></p>
								<input type="hidden" class="form-control" id="class" name="class" value="<?php echo $_GET['cid']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Tarikh Kursus</label>
							<div class="col-sm-10">
								<p class="form-control-static" id="date"></p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Waktu Kursus</label>
							<div class="col-sm-10">
								<p class="form-control-static" id="time"></p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="button" class="btn btn-success" id="enrollSave"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan</button>
								<a href="index.php?p=class" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
							</div>
						</div>
						<table class="table table-hover table-condensed small" id="displayresult">
							<thead>
								<tr class="info">
									<th>Bil</th>
									<th>Pemohon</th>
									<th>No. Telefon / E-mel</th>
									<th>Setuju</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<div class="panel-footer small" id="displayemail">
						Alamat Email Pemohon
					</div>
				</div>
			</div>
		</div>
		<hr class="half-rule">
	</div>
	<?php if(isset($_GET['cid'])) { ?>
	<script language="javascript" type="text/javascript">loadClass(<?php echo $_GET['cid']; ?>);</script>
	<?php } else { ?>
	<script language="javascript" type="text/javascript">$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');</script>
	<?php } ?>
</div>
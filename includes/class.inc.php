<?php
protect_page();
?>
<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Senarai Kursus Dijalankan</h2>
			<hr class="half-rule">
		</div>
		<div id="result"></div>
		
		<div class="row">
			<div class="col-md-12 filterForm">
				<a data-toggle="modal" href="#courseDetail" data-id="add" id="regClass" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah</a>
				<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
				<!--<div class="col-sm-4 col-md-3">
					<div class="input-group">
						<div class="input-group-addon">Carian</div>
						<input name="search" type="text" class="form-control" id="searchBox" placeholder="Nama kursus" onkeyup="searchClassList()">
					</div>
				</div>
				<div class="col-sm-4 col-md-3">
					<div class="input-group">
						<div class="input-group-addon">Status</div>
						<select name="status" class="form-control" id="selectBox" onchange="searchClassList()">
							<option value=''>Semua Status</option>
							<option value='Aktif'>Aktif</option>
							<option value='Selesai'>Selesai</option>
						</select>
					</div>
				</div>
				<a data-toggle="modal" href="#courseDetail" data-id="add" id="regClass" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah</a>
				<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>-->
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-condensed small" id="displayresult">
						<thead>
							<tr class="bg-primary">
								<th>ID</th>
								<th>Nama Kursus</th>
                                <th>Tarikh Kursus</th>
                                <th>Masa Kursus</th>
                                <th>Aktif</th>
                                <th>Tindakan</th>
							</tr>
						</thead>
						<tfoot>
							<tr class="bg-primary">
								<th>ID</th>
								<th>Nama Kursus</th>
                                <th>Tarikh Kursus</th>
                                <th>Masa Kursus</th>
                                <th>Aktif</th>
                                <th>Tindakan</th>
							</tr>
						</tfoot>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="modal fade" tabindex="-1" role="dialog" id="courseDetail">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
								<div class="modal-header bg-primary">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h3 class="modal-title text-center">Daftar Kursus</h3>
								</div>
								<div class="modal-body">
									<div id="error"></div>
									<form action="" method="post" class="form-horizontal">
										<div class="form-group">
											<label for="course" class="col-sm-3 control-label">Nama Kursus <span class="text-danger">*</span></label>
											<div class="col-sm-9">
												<select class="form-control" id="course" placeholder="Status warganegara" name="course">
													<option value=''>Sila pilih...</option>
													<?php
														$course_result = mysql_query("SELECT * FROM `course` WHERE `active` = 1 ORDER BY `course_id`");
														while($c=mysql_fetch_array($course_result)) {
																echo "<option value='".$c['course_id']."'>".$c['code']." - ".ucwords(strtolower($c['name']))."</option>";
														}
													?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="course" class="col-sm-3 control-label">Waktu Latihan <span class="text-danger">*</span></label>
											<div class="col-sm-9">
												<select class="form-control" id="classType" placeholder="Status warganegara" name="classType">
													<option value=''>Sila pilih...</option>
													<option value='1' <?php if (empty($_POST) === false && empty($_POST) === false) { if ($_POST['classType'] == '1') { echo 'selected="selected"'; } } ?>>Hari Bekerja</option>
													<option value='2' <?php if (empty($_POST) === false && empty($_POST) === false) { if ($_POST['classType'] == '2') { echo 'selected="selected"'; } } ?>>Hujung Minggu</option>
													<option value='3' <?php if (empty($_POST) === false && empty($_POST) === false) { if ($_POST['classType'] == '3') { echo 'selected="selected"'; } } ?>>Setiap Hari</option>
													<option value='4' <?php if (empty($_POST) === false && empty($_POST) === false) { if ($_POST['classType'] == '4') { echo 'selected="selected"'; } } ?>>Setiap Ahad</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="noic" class="col-sm-3 control-label">Tarikh Mula <span class="text-danger">*</span></label>
											<div class="col-sm-9 popupForm">
												<?php echo date_dropdown($date_start, "start"); ?>
											</div>
										</div>
										<div class="form-group">
											<label for="category" class="col-sm-3 control-label">Tarikh Tamat <span class="text-danger">*</span></label>
											<div class="col-sm-9 popupForm">
												<?php echo date_dropdown($date_start, "end"); ?>
											</div>
										</div>
										<div class="form-group">
											<label for="department" class="col-sm-3 control-label">Waktu Mula <span class="text-danger">*</span></label>
											<div class="col-sm-9">
												<?php echo time_dropdown($time_start, "start"); ?>
											</div>
										</div>
										<div class="form-group">
											<label for="content" class="col-sm-3 control-label">Taktu Tamat <span class="text-danger">*</span></label>
											<div class="col-sm-9">
												<?php echo time_dropdown($time_start, "end"); ?>
											</div>
										</div>
										<div class="form-group">
											<label for="prerequisite" class="col-sm-3 control-label">Aktif</label>
											<div class="col-sm-9">
												<label>
													<input type="checkbox" id="complete" name="complete"> Kursus selesai?
												</label>
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer bg-primary">
									<button type="button" class="btn btn-success" id="saveClass"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan</button>
									<button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</button>
								</div>
							</form>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<script language="javascript" type="text/javascript">loadAllClass();</script>
			</div>
		</div>
		<hr class="half-rule">
	</div>
</div>
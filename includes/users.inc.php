<?php
protect_page();
?>
<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Daftar Pengguna</h2>
			<hr class="half-rule">
		</div>
		<div id="result"></div>
		
		<div class="row">
			<div class="col-md-12">
				<a data-toggle="modal" href="#courseDetail" data-id="add" id="regUser" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah</a>
				<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
				<!--<form action="" method="post" class="form-inline">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Carian</div>
							<input name="search" type="text" class="form-control" id="searchBox" placeholder="Nama kursus" onkeyup="searchList()">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">Bidang</div>
							<select name="department" class="form-control" id="selectBox" onchange="searchList()">
								<option value=''>Semua Bidang</option>
								<?php
									//$course_result = mysql_query("SELECT * FROM `department` ORDER BY `depart_id`");
									//while($c=mysql_fetch_array($course_result)) {
									//		echo "<option value='".$c['name']."'>".ucwords(strtolower($c['name']))."</option>";
									//}
								?>
							</select>
						</div>
					</div>
					<a data-toggle="modal" href="#courseDetail" data-id="add" id="regCourse" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah</a>
					<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
				</form>-->
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-condensed small" id="displayresult">
						<thead>
							<tr class="bg-primary">
                                <th>Nama Pengguna</th>
                                <th>Nama Penuh</th>
                                <th>Pangkat</th>
								<th>Kata laluan</th>
                                <th>Log Terakhir</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr class="bg-primary">
                                <th>Nama Pengguna</th>
                                <th>Nama Penuh</th>
								<th>Pangkat</th>
								<th>Kata laluan</th>
                                <th>Log Terakhir</th>
                                <th>Action</th>
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
								<h3 class="modal-title text-center">Daftar Pengguna</h3>
							</div>
							<div class="modal-body">
								<div id="error"></div>
								<form action="" method="post" class="form-horizontal">
									<div class="form-group">
										<label for="username" class="col-sm-3 control-label">Nama Pengguna <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="username" placeholder="Nama Pengguna" name="username">
										</div>
									</div>
									<div class="form-group">
										<label for="fullname" class="col-sm-3 control-label">Nama Penuh <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="fullname" placeholder="Nama Penuh" name="fullname">
										</div>
									</div>
									<div class="form-group">
										<label for="telnum" class="col-sm-3 control-label">No. Telefon <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="telnum" placeholder="No. Telefon" name="telnum">
										</div>
									</div>
									<div class="form-group">
										<label for="email" class="col-sm-3 control-label">Alamat E-Mel <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="email" placeholder="Alamat E-Mel" name="email">
										</div>
									</div>
									<div class="form-group">
										<label for="level" class="col-sm-3 control-label">Kategori Pengguna <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<select class="form-control" id="level" name="level">
												<option value=''>Sila pilih Pangkat...</option>
												<option value='1'>Pentadbir Aplikasi</option>
												<option value='2'>Penyelaras Program</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="active" class="col-sm-3 control-label">Aktif</label>
										<div class="col-sm-9">
											<label>
												<input type="checkbox" id="active" name="active"> Pengguna aktif?
											</label>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer bg-primary">
								<button type="button" class="btn btn-success" id="saveUser"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan</button>
								<button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- Chang Password -->
				<div class="modal fade" tabindex="-1" role="dialog" id="changePassword">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h3 class="modal-title text-center">Tukar Kata Laluan</h3>
							</div>
							<div class="modal-body">
								<div id="errorPass"></div>
								<form action="" method="post" class="form-horizontal">
									<div class="form-group">
										<label for="old_pass" class="col-sm-4 control-label">Kata Laluan Semasa <span class="text-danger">*</span></label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="old_pass" placeholder="Kata Laluan Semasa" name="old_pass">
										</div>
									</div>
									<div class="form-group">
										<label for="new_pass" class="col-sm-4 control-label">Kata Laluan Baru <span class="text-danger">*</span></label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="new_pass" placeholder="Kata Laluan Baru" name="new_pass">
										</div>
									</div>
									<div class="form-group">
										<label for="repeat_pass" class="col-sm-4 control-label">Ulang Kata Laluan <span class="text-danger">*</span></label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="repeat_pass" placeholder="Ulang Kata Laluan" name="repeat_pass">
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer bg-primary">
								<button type="button" class="btn btn-success" id="savePass"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan</button>
								<button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<script language="javascript" type="text/javascript">loadAllUsers();</script>
			</div>
		</div>
		<hr class="half-rule">
	</div>
</div>
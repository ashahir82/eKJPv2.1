<?php
protect_page();
?>
<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Daftar Bahagian\Bengkel</h2>
			<hr class="half-rule">
		</div>
		<div id="result"></div>
		
		<div class="row">
			<div class="col-md-12">
				<a data-toggle="modal" href="#courseDetail" data-id="add" id="regDepart" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah</a>
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
                                <th>ID</th>
                                <th>Nama Bahagian\Bengkel</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr class="bg-primary">
                                <th>ID</th>
                                <th>Nama Bahagian\Bengkel</th>
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
								<h3 class="modal-title text-center">Daftar Bahagian\Bengkel</h3>
							</div>
							<div class="modal-body">
								<div id="error"></div>
								<form action="" method="post" class="form-horizontal">
									<div class="form-group">
										<label for="name" class="col-sm-3 control-label">Nama <span class="text-danger">*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="name" placeholder="Nama Bahagian\Bengkel" name="name">
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer bg-primary">
								<button type="button" class="btn btn-success" id="saveDepart"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan</button>
								<button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</button>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<script language="javascript" type="text/javascript">loadAllDepart();</script>
			</div>
		</div>
		<hr class="half-rule">
	</div>
</div>
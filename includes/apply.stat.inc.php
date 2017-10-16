<?php
protect_page();
?>
<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Senarai Permohonan Kursus</h2>
			<hr class="half-rule">
		</div>
		<div id="result"></div>
		
		<div class="row">
			<div class="col-md-12 filterForm">
				<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
				<!--<div class="col-sm-6 col-md-3">
					<div class="input-group">
						<div class="input-group-addon">Carian</div>
						<input name="search" type="text" class="form-control" id="searchBox" placeholder="Nama pemohon" onkeyup="searchApplyList()">
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="input-group">
						<div class="input-group-addon">Kursus</div>
						<select name="department" class="form-control" id="selectBox" onchange="searchApplyList()">
							<option value=''>Semua Kursus</option>
							<?php
								//$course_result = mysql_query("SELECT DISTINCT `course` FROM `course_apply` INNER JOIN `course` ON `course_apply`.`course` = `course`.`course_id` WHERE //`course_apply`.`active` = 1 AND `course`.`active` = 1 ORDER BY `course`");
								//while($c=mysql_fetch_array($course_result)) {
								//		echo "<option value='".course_code($c['course'])."'>".course_code($c['course'])." - ".ucwords(strtolower(course_name($c['course'])))."</option>";
								//}
							?>
						</select>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="input-group">
						<div class="input-group-addon">Status</div>
						<select name="status" class="form-control" id="selectStat" onchange="searchApplyList()">
							<option value=''>Semua Status</option>
							<?php
								//$status_result = mysql_query("SELECT * FROM `status` ORDER BY `status_id`");
								//while($s=mysql_fetch_array($status_result)) {
								//		echo "<option value='".$s['name']."'>".ucwords(strtolower($s['name']))."</option>";
								//}
							?>
						</select>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="input-group">
						<div class="input-group-addon">Latihan</div>
						<select name="time" class="form-control" id="selectTime" onchange="searchApplyList()">
							<option value=''>Semua Latihan</option>
							<option value='1'>Waktu Bekerja</option>
							<option value='2'>Hujung Minggu</option>
						</select>
					</div>
				</div>
				<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>-->
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-condensed small" id="displayresult" data-toggle="table">
						<thead>
							<tr class="bg-primary">
								<th>Kod Kursus</th>
								<th>Nama Kursus</th>
                                <th>Semakan</th>
                                <th>Pengesahan</th>
                                <th>Diterima</th>
                                <th>Ditolak</th>
                                <th>Selesai</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Kod Kursus</th>
								<th>Nama Kursus</th>
                                <th>Semakan</th>
                                <th>Pengesahan</th>
                                <th>Diterima</th>
                                <th>Ditolak</th>
                                <th>Selesai</th>
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
									<h3 class="modal-title text-center">Maklumat Permohonan</h3>
								</div>
								<div class="modal-body">
									<div id="dynamic-content"></div>
								</div>
								<div class="modal-footer bg-primary">
									<button type="button" class="btn btn-danger" id="delApplyDetail"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Padam</button>
									<button type="button" class="btn btn-success" id="saveApplyDetail"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan</button>
									<button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</button>
								</div>
							</form>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<script language="javascript" type="text/javascript">loadApplyStat();</script>
			</div>
		</div>
		<hr class="half-rule">
	</div>
</div>
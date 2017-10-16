<div class="section">
	<div class="container">
		<div class="row">
		<h2 class="text-center">Senarai Kursus Yang Ditawarkan</h2>
		<hr class="half-rule">
		</div>
		<div id="result"></div>
		
		<div class="row">
			<div class="col-md-12">
				<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
				<!--<form class="form-inline">
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
								<th>Kod Kursus</th>
								<th>Nama Kursus</th>
								<th>Bidang</th>
							</tr>
						</thead>
						<tfoot>
							<tr class="bg-primary">
								<th>Kod Kursus</th>
								<th>Nama Kursus</th>
								<th>Bidang</th>
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
									<h3 class="modal-title text-center">Permohonan Kursus</h3>
								</div>
								<div class="modal-body">
									<div id="dynamic-content"></div>
								</div>
								<div class="modal-footer bg-primary">
									<button type="submit" class="btn btn-success" id="checkKP" name="checkKP"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Semak</button>
									<button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</button>
								</div>
							</form>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<script language="javascript" type="text/javascript">loadApply();</script>
			</div>
		</div>
		<hr class="half-rule">
	</div>
</div>
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
							</tr>
						</thead>
						<tfoot>
							<tr class="bg-primary">
								<th>ID</th>
								<th>Nama Kursus</th>
                                <th>Tarikh Kursus</th>
							</tr>
						</tfoot>
						<tbody>
						</tbody>
					</table>
				</div>
				<script language="javascript" type="text/javascript">loadClassCert();</script>
			</div>
		</div>
		<hr class="half-rule">
	</div>
</div>
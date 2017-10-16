<?php
protect_page();
?>
<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Tindakan Pentadbir</h2>
			<hr class="half-rule">
		</div>
		<div id="error"></div>
		<div class="row">
			<div class="col-md-12" id="checkContent">
				<ul class="list-group">
					<li class="list-group-item">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 
						<div class="pull-right">
							<a data-toggle="modal" href="#courseDetail" data-id="add" id="allEmail" class="btn btn-success btn-xs" role="button"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Teruskan</a>
						</div>
						Senarai email semua pemohon di dalam aplikasi eKJP.
					</li>
					<li class="list-group-item">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 
						<div class="pull-right">
							<button type="button" class="btn btn-success btn-xs" id="applyYes"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Teruskan</button>
						</div>
						Terima permohonan kursus yang aktif.
					</li>
					<li class="list-group-item">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 
						<div class="pull-right">
							<button type="button" class="btn btn-danger btn-xs" id="applyNo"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Teruskan</button>
						</div>
						Tolak permohonan kursus yang tidak aktif.
					</li>
				</ul>
				<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
			</div>
			<div class="modal fade" tabindex="-1" role="dialog" id="courseDetail">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
								<div class="modal-header bg-primary">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h3 class="modal-title text-center">Email Pemohon</h3>
								</div>
								<div class="modal-body">
									<div id="error"></div>
									<ul class="nav nav-tabs" id="emailTab" role="tablist"></ul>

									<!-- Tab panes -->
									<div class="tab-content small" id="emailContent">
									
									</div>
								</div>
								<div class="modal-footer bg-primary">
									<button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</button>
								</div>
							</form>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
		</div>
		<hr class="half-rule">
	</div>
</div>
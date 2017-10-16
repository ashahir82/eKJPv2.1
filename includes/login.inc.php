<?php
logged_in_redirect();
?>
<div class="section">
	<div class="container">
		<div class="row">
			<h2 class="text-center">Log Masuk</h2>
			<hr class="half-rule">
		</div>
		<div id="error"></div>
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<div class="col-sm-2">
							<label for="username" class="control-label">Pengguna</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="username" placeholder="Nama pengguna" name="username">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2">
							<label for="password" class="control-label">Kata Laluan</label>
						</div>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="password" placeholder="Kata laluan" name="password">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-success" id="logMasuk" name="logMasuk"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Log masuk</button>
							<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<hr class="half-rule">
	</div>
</div>
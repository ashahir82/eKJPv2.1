<footer class="section" id="footer">
	<!-- copyright , scrollTo Top -->
	<div class="footer-bar">
		<div class="container">
			<span class="copyright">Hakcipta Terpelihara <?php echo date("Y"); ?> © <?php echo strtoupper($cfg_institute); ?>.</span>
		</div>
	</div>
	<!-- copyright , scrollTo Top -->
	
	<!-- footer content -->
	<div class="footer-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-left">
					<h4>Penafian</h4>
					<p class="text-justify">Jabatan Tenaga Manusia dan <?php echo ucwords(strtolower($cfg_institute)); ?>
					adalah tidak bertanggungjawab bagi apa-apa kehilangan atau kerugian yang
					disebabkan oleh penggunaan mana-mana maklumat yang diperolehi dari laman
					web ini serta tidak boleh ditafsirkan sebagai ejen kepada, ataupun syarikat
					yang disyorkan oleh <?php echo ucwords(strtolower($cfg_institute)); ?>.</p>
				</div>
				<div class="col-sm-6 col-right">
					<h4 class="text-right">Pertanyaan</h4>
					<p class="text-right"><?php echo ucwords(strtolower($cfg_division)); ?>
					<br><?php echo ucwords(strtolower($cfg_institute)); ?>,
					<br><?php echo ucwords(strtolower($cfg_address)); ?>
					<br>Tel : <?php echo $cfg_telno; ?> (samb : <?php echo $cfg_extention; ?>)
					<br>Fax : <?php echo $cfg_faxno; ?>
					<br>Email : <?php echo $cfg_email; ?></p>
				</div>
			</div>
		</div>
	</div>
	<!-- footer content -->
</footer>
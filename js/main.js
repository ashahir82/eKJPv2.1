// JavaScript Document
$(function(){
	var courseAction, url;
	
	//Log Masuk
	$(document).on("click","#logMasuk",function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var username = $("#username").val();//capture the content of the textbox.
		var pass = $("#password").val();//capture the content of the textbox.
		if (username == "" || pass == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		var urlcarian="ajax/doUsers.php?action=login&username=" + username + "&password=" + pass;
		if($.trim(username).length > 0 || $.trim(pass).length > 0) {
			//AJAX configuration
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				beforeSend: function(){ $("#logMasuk").val('Proces carian...'); },
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
						$("#logMasuk").val('Log Masuk');
					} else if (result.success) {//if the result success
						window.location.href = result.success; //redirect
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#logMasuk").val('Log Masuk');
					$("#infoSearch").html("Network error!!!").enhanceWithin();
				}//error
			});//ajax
		}
	});
	
	//Semak Kad Pengenalan
	$(document).on("click","#checkKP",function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var noic = $("#noic").val();//capture the content of the textbox.
		var course = $("#course").val();//capture the content of the textbox.
		if (noic == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Sila masukkan no kad pengenalan anda!</div>');//display error message
			return false; // stop the script
		}
		var urlcarian="ajax/doCheckApply.php?action=checkKP&noic=" + noic + "&course=" + course;
		if($.trim(noic).length > 0) {
			//AJAX configuration
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				beforeSend: function(){ $("#checkKP").val('Proces carian...'); },
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						window.location.href = result.success; //redirect
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#checkKP").val('Semak');
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
			});//ajax
		}
	});
	
	$(document).on('click', '#getCourse', function(e){
		e.preventDefault();
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doGetCourses.php?action=getCourse&id=" + uid;
		$('#dynamic-content').html(''); // leave this div blank
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"html",
			beforeSend: function(){ $("#dynamic-content").html('Proces carian...'); },
		})
		.done(function(data){
			$('#dynamic-content').html(''); // blank before load.
			$('#dynamic-content').html(data); // load here 
		})
		.fail(function(){
			$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
		});
    });
	
	$(document).on('click', '#getApplyDetails', function(e){
		e.preventDefault();
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doCheckApply.php?action=getApplyDetails&id=" + uid;
		$('#dynamic-content').html(''); // leave this div blank
		$('#delApplyDetail').prop('disabled', true); //Enable botton
		$('#saveApplyDetail').prop('disabled', true); //Enable botton
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"html",
			beforeSend: function(){ $("#dynamic-content").html('Proces carian...'); },
		})
		.done(function(data){
			$('#dynamic-content').html(''); // blank before load.
			$('#dynamic-content').html(data); // load here 
			$('#delApplyDetail').prop('disabled', false); //Enable botton
			$('#saveApplyDetail').prop('disabled', false); //Enable botton
		})
		.fail(function(){
			$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
		});
    });
	
	$(document).on("click","#saveApplyDetail",function(e){
		e.preventDefault();
		var stat = $("#status").val();//capture the content of the textbox.
		var course = $("#course").val();//capture the content of the textbox.
		if ($("#noclass").prop('checked') == false) {
			var noclass = 0;
		} else {
			var noclass = 1;
		}
		
		var urlcarian="ajax/doCheckApply.php?action=saveApplyDetails&course=" + course + "&status=" + stat + "&noclass=" + noclass;
		//AJAX configuration
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			beforeSend: function(){ $("#saveApplyDetail").val('Proces carian...'); },
			success:function(result){//if the connection success
				if (result.errors) {//if the result error
					var i, errText = '';
					for (i = 0; i < result.errors.length; i++) {
						errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
					}
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
				} else if (result.success) {//if the result success
					$("#result").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Permohonan berjaya disimpan.</div>');//display error message
					$('#courseDetail').modal('toggle')
					$('#displayresult tbody').html("");
					loadAllApply();
				}
			},//success
			error:function(result,error){//if the connection fail
				$("#saveApplyDetail").val('Simpan');
				$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
			}//error
		});//ajax
	});
	
	$(document).on("click","#delApplyDetail",function(e){
		e.preventDefault();
		var stat = $("#status").val();//capture the content of the textbox.
		var course = $("#course").val();//capture the content of the textbox.
		var urlcarian="ajax/doCheckApply.php?action=delApplyDetail&course=" + course + "&status=" + stat;
		if(confirm('Adakah anda ingin padam maklumat ini?')==true) {
			//AJAX configuration
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				beforeSend: function(){ $("#delApplyDetail").val('Proces carian...'); },
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$('#courseDetail').modal('hide');
						$('#displayresult tbody').html("");
						loadAllApply();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#delApplyDetail").val('Simpan');
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
			});//ajax
		}
	});
	
	$(document).on('click', '#getApply', function(e){
		e.preventDefault();
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doGetCourses.php?action=getApply&id=" + uid;
		$('#dynamic-content').html(''); // leave this div blank
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"html",
			beforeSend: function(){ $("#dynamic-content").html('Proces carian...'); },
		})
		.done(function(data){
			$('#dynamic-content').html(''); // blank before load.
			$('#dynamic-content').html(data); // load here 
		})
		.fail(function(){
			$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
		});
    });
	
	$(document).on('click', '#getEnroll', function(e){
		e.preventDefault();
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doCheckApply.php?action=getEnroll&id=" + uid;
		$('#dynamic-content').html(''); // leave this div blank
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"html",
			beforeSend: function(){ $("#dynamic-content").html('Proces carian...'); },
		})
		.done(function(data){
			$('#dynamic-content').html(''); // blank before load.
			$('#dynamic-content').html(data); // load here 
		})
		.fail(function(){
			$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
		});
    });

	$(document).on("click","#saveEnroll",function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var noic = $("#noic").val();//capture the content of the textbox.
		var classes = $("#class").val();//capture the content of the textbox.
		var capply = $("#capply").val();//capture the content of the textbox.
		var urlcarian="ajax/doCheckApply.php?action=saveEnroll&class=" + classes + "&capply=" + capply;
		//AJAX configuration
		if ($("#accept").prop('checked') == true) {
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				beforeSend: function(){ $("#saveApplyDetail").val('Proces carian...'); },
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#result").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Permohonan berjaya disimpan.</div>');//display error message
						$('#displayAccept').html(''); // blank before load.
						$('#displayAccept').html('<a href="widgets/conform.letter.php?cid=' + classes + '&noic=' + noic + '&caid=' + capply + '" target="_blank" class="btn btn-success btn-xs" role="button">Surat Permohonan</a>'); // blank before load.
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
			});//ajax
		}
	});
	
	$(document).on("click","#enrollSave",function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var classes = $("#class").val();//capture the content of the textbox.
		var wascheck = [];
        $(':checkbox:checked').each(function(i){
			wascheck[i] = $(this).val();
        });
		var notcheck = [];
        $(':checkbox:not(:checked)').each(function(i){
			notcheck[i] = $(this).val();
        });
		var urlcarian="ajax/doCheckApply.php?action=enrollSave&class=" + classes + "&capply=" + wascheck + "&cnot=" + notcheck;
		//AJAX configuration
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
				if (result.errors) {//if the result error
					var i, errText = '';
					for (i = 0; i < result.errors.length; i++) {
						errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
					}
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
				} else if (result.success) {//if the result success
					$("#error").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Permohonan berjaya disimpan.</div>');//display error message
				}
			},//success
			error:function(result,error){//if the connection fail
				$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
			}//error
		});//ajax
	});
	
	$(document).on("click","#cancelButton",function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		//$("#noic").val(""); //clear text box.
		$(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
		$(':checkbox, :radio').prop('checked', false);
		$("#preList div").remove();
	});
	
	//Semak Permohonan
	$(document).on("click","#checkApply",function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var noic = $("#noic").val();//capture the content of the textbox.
		if (noic == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Sila masukkan no kad pengenalan anda!</div>');//display error message
			return false; // stop the script
		}
		var urlcarian="ajax/doCheckApply.php?action=checkApply&noic=" + noic;
		if($.trim(noic).length > 0) {
			//AJAX configuration
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				beforeSend: function(){ $("#checkKP").val('Proces carian...'); },
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						var trHTML = '';
						trHTML += 'Terima kasih <strong>' + result.success.name + '</strong> atas permohonan anda. Tahniah kerana memilih Institut kami sebagai pusat kecemerlangan untuk peningkatan kemahiran dan pengetahuan anda.' + 
						'<hr>' + 
						'<div class="row">' + 
							'<div class="col-md-3"><strong>Nama Pemohon :</strong></div>' + 
							'<div class="col-md-9">' + result.success.name + '</div>' + 
						'</div>' + 
						'<div class="row">' + 
							'<div class="col-md-3"><strong>No Kad Pengenalan :</strong></div>' + 
							'<div class="col-md-9">' + result.success.noic + '</div>' + 
						'</div>' + 
						'<div class="row">' + 
							'<div class="col-md-3"><strong>No Tel :</strong></div>' + 
							'<div class="col-md-9">' + result.success.notel + '</div>' + 
						'</div>' + 
						'<div class="row">' + 
							'<div class="col-md-3"><strong>Alamat E-mel :</strong></div>' + 
							'<div class="col-md-9">' + result.success.email + '</div>' + 
						'</div>' + 
						'<hr>' + 
						'<h4 class="text-center text-primary">Senarai Kursus Yang Dipohon</h4>' + 
						'<div class="table-responsive">' + 
							'<table class="table table-bordered table-hover table-condensed small">' + 
								'<thead>' + 
									'<tr class="bg-primary">' + 
										'<th>Kursus Dipohon</th>' + 
										'<th>Tarikh Permohonan</th>' + 
										'<th>Status</th>' + 
										'<th>Tindakan</th>' + 
									'</tr>' + 
								'</thead>' + 
								'<tbody>';
						var i, courseText = '';
						if (result.success.course.length != 0) {
							for (i = 0; i < result.success.course.length; i++) {
								trHTML += '<tr><td>' + result.success.course[i].code + ' - ' + result.success.course[i].name + '</td><td>' + result.success.course[i].created + '</td><td>' + result.success.course[i].stat + '</td><td>';
								if (result.success.course[i].stat == "Permohonan Diterima") {
									trHTML += '<a data-toggle="modal" href="#courseDetail" data-id="' + result.success.course[i].caid + '" id="getEnroll" class="btn btn-warning btn-xs" role="button"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Surat Tawaran</a>';
								} else if (result.success.course[i].stat == "Proses Semakan" || result.success.course[i].stat == "Proses Pengesahan") {
									trHTML += '<a href="widgets/apply.letter.php?cid=' + result.success.course[i].cid + '&noic=' + result.success.noic + '&caid=' + result.success.course[i].caid + '" target="_blank" class="btn btn-warning btn-xs" role="button"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Surat Permohonan</a>';
								} else if (result.success.course[i].stat == "Permohonan Ditolak") {
									trHTML += 'Permohonan Ditolak';
								} else if (result.success.course[i].stat == "Selesai") {
									trHTML += 'Selesai';
								}
								trHTML += '</td></tr>';
							}
						} else {
							trHTML += '<tr><td colspan="4">Tiada permohonan kursus.</td></tr>';
						}
						trHTML += '</tbody>' + 
						'</table>' + 
						'</div>' + 
						'<a href="index.php?p=check" class="btn btn-success" role="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Semakan</a>' + 
						'<a href="index.php" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Laman Utama</a>' + 
						'<div class="modal fade" tabindex="-1" role="dialog" id="courseDetail">' + 
						'<div class="modal-dialog" role="document">' + 
						'<div class="modal-content">' + 
						'<div class="modal-header bg-primary">' + 
						'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + 
						'<h3 class="modal-title text-center">Pengesahan Kursus</h3>' + 
						'</div>' + 
						'<div class="modal-body">' + 
						'<div id="dynamic-content"></div>' + 
						'</div>' + 
						'<div class="modal-footer bg-primary">' + 
						'<button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</button>' + 
						'</div>' + 
						'</form>' + 
						'</div><!-- /.modal-content -->' + 
						'</div><!-- /.modal-dialog -->' + 
						'</div><!-- /.modal -->';
						$('#checkContent').html(trHTML); // load here 
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#checkKP").val('Semak');
					$("#infoSearch").html("Network error!!!").enhanceWithin();
				}//error
			});//ajax
		}
	});
	
	//Semak Permohonan
	$(document).on("click","#checkProfile",function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var noic = $("#noic").val();//capture the content of the textbox.
		if (noic == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Sila masukkan no kad pengenalan anda!</div>');//display error message
			return false; // stop the script
		}
		var urlcarian="ajax/doUsers.php?action=checkProfile&noic=" + noic;
		if($.trim(noic).length > 0) {
			//AJAX configuration
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				beforeSend: function(){ $("#checkProfile").val('Proces carian...'); },
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$(".profileForm").show();
						$(".profileCheck").remove();
						
						$("#name").val(result.success.name);
						$("#noic").val(result.success.noic);
						$("#nationality").val(result.success.nationality);
						$("#address").val(result.success.address);
						$("#postcode").val(result.success.postcode);
						$("#notel").val(result.success.notel);
						$("#email").val(result.success.email);						
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#checkProfile").val('Semak');
					$("#error").html("Network error!!!").enhanceWithin();
				}//error
			});//ajax
		}
	});

	$(document).on('click', '#saveProfile', function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var name = $("#name").val();//capture the content of the textbox.
		var noic = $("#noic").val();//capture the content of the textbox.
		var nationality = $("#nationality").val();//capture the content of the textbox.
		var address = $("#address").val();//capture the content of the textbox.
		var postcode = $("#postcode").val();//capture the content of the textbox.
		var notel = $("#notel").val();//capture the content of the textbox.
		var email = $("#email").val();//capture the content of the textbox.
		
		if (name == "" || noic == "" || nationality == "" || address == "" || postcode == "" || notel == "" || email == "" ) { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		
		var urlcarian="ajax/doUsers.php?action=saveProfile&name=" + name + "&noic=" + noic + "&nationality=" + nationality + "&address=" + encodeURIComponent(address) + "&postcode=" + postcode + "&notel=" + notel + "&email=" + email;
		
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#error").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Profile berjaya disimpan.</div>');//display error message
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on("click","#addPrerequisite",function(){
		var insertBox='<div class="col-sm-offset-3 col-sm-9"><div class="input-group"><input type="text" class="form-control" id="prerequisite" placeholder="Pra-Syarat Kursus" name="prerequisite"><span class="input-group-btn"><button class="btn btn-warning" type="button" id="delPrerequisite" onclick="deleteRow(this)">-</button></span></div><!-- /input-group --></div>';
		$("#preList").append(insertBox);
		return false;
	});
	
	$(document).on('click', '#regCourse', function(e){
		url = "ajax/doGetCourses.php?action=courseSave";
    });
	
	$(document).on('click', '#saveCourse', function(e){
		e.preventDefault();
		var prerequisite = new Array();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var code = $("#code").val();//capture the content of the textbox.
		var name = $("#name").val();//capture the content of the textbox.
		var category = $("#category").val();//capture the content of the textbox.
		var department = $("#department").val();//capture the content of the textbox.
		var content = $("#content").val();//capture the content of the textbox.
		$("input[name=prerequisite]").each(function() { prerequisite.push($(this).val()); });//capture the content of the textbox.
		var fee = $("#fee").val();//capture the content of the textbox.
		var duration = $("#duration").val();//capture the content of the textbox.
		var dur_term = $("#dur_term").val();//capture the content of the textbox.
		
		if (code == "" || name == "" || category == "" || department == "" || content == "" || fee == "" || duration == "" || dur_term == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		
		var urlcarian=url + "&code=" + code + "&name=" + name + "&category=" + category + "&department=" + department + "&content=" + encodeURIComponent(content) + "&prerequisite=" + prerequisite + "&fee=" + fee + "&duration=" + duration + "&dur_term=" + dur_term;

		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#error").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Kursus berjaya disimpan.</div>');//display error message
						$('#displayresult tbody').html("");
						loadAllCourses();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#saveApplyCourse', function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var id = $("#id").val();//capture the content of the textbox.
		var time = $("#time").val();//capture the content of the textbox.
		var name = $("#name").val();//capture the content of the textbox.
		var noic = $("#noic").val();//capture the content of the textbox.
		var nationality = $("#nationality").val();//capture the content of the textbox.
		var address = $("#address").val();//capture the content of the textbox.
		var postcode = $("#postcode").val();//capture the content of the textbox.
		var notel = $("#notel").val();//capture the content of the textbox.
		var email = $("#email").val();//capture the content of the textbox.
		var accept = $("#accept").val();//capture the content of the textbox.
		
		if (id == "" || time == "" || name == "" || noic == "" || nationality == "" || address == "" || postcode == "" || notel == "" || email == "" ) { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		if($("#prerequisite").length && $("#prerequisite").prop('checked') == false) {
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Sila bersetuju dengan pra-syarat yang dinyatakan di atas.</div>');//display error message
			return false; // stop the script
		}
		if ($("#accept").prop('checked') == false) {
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Sila bersetuju dengan syarat yang dinyatakan di bawah.</div>');//display error message
			return false; // stop the script
		}
		
		var urlcarian="ajax/doCheckApply.php?action=saveApply&id=" + id + "&time=" + time + "&name=" + name + "&noic=" + noic + "&nationality=" + nationality + "&address=" + encodeURIComponent(address) + "&postcode=" + postcode + "&notel=" + notel + "&email=" + email;
		
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						var trHTML = '';
						trHTML += '<div class="panel panel-primary" id="applyResult">' + 
						'<!-- Default panel contents -->' + 
						'<div class="panel-heading">Permohonan Berjaya</div>' + 
						'<div class="panel-body">' + 
						'<p>Terima kasih <strong>' + result.success.name + '</strong> atas permohonan anda. Kami akan memberi maklumbalas kepada anda dalam tempoh masa <strong>tujuh (7) hari bekerja</strong>. Anda boleh membuat semakan permohonan melalui aplikasi eKJP.</p>' + 
						'</div>' + 

						'<!-- Table -->' + 
						'<div class="table-responsive"><table class="table small table-panel">' + 
						'<tr>' + 
						'<th>Name</th><td>' + result.success.name + '</td><td rowspan="6" align="center"><img src="' + result.success.weblink + '/qr_img/php/qr_img.php?d=' + result.success.weblink + '/widgets%2Fapply.letter.php%3Fcid%3D' + result.success.id + '%26noic%3D' + result.success.noic + '%26caid%3D' + result.success.apply + '" alt="qr-code" align="center" width="132" height="132" ><p>Sila imbas kod QR untuk muat-turun<br>borang permohonan di peranti mudah alih.</p></td>' + 
						'</tr>' + 
						'<tr>' + 
						'<th>No. Kad Pengenalan</th><td>' + result.success.noic + '</td>' + 
						'</tr>' + 
						'<tr>' + 
						'<th>No. Tel.</th><td>' + result.success.notel + '</td>' + 
						'</tr>' + 
						'<tr>' + 
						'<th>Alamat E-mel</th><td>' + result.success.email + '</td>' + 
						'</tr>' + 
						'<tr>' + 
						'<th>Kursus Dipohon</th><td>' + result.success.code + ' - ' + result.success.course + '</td>' + 
						'</tr>' + 
						'<tr>' + 
						'<th>Tarikh Permohonan</th><td>' + result.success.created_on + '</td>' + 
						'</tr>' + 
						'<tr>' + 
						'<th>&nbsp</th><td colspan="2"><div class="btn-group" role="group" aria-label="...">' + 
						'<button type="submit" class="btn btn-success" onclick="window.open(\'widgets/apply.letter.php?cid=' + result.success.id + '&noic=' + result.success.noic + '&caid=' + result.success.apply + '\', \'_blank\')"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak Permohonan</button>' + 
						'<a href="index.php?p=apply" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batal</a>' + 
						'</div></td>' + 
						'</tr>' + 
						'</table></div>' + 
						'</div>';
						$("#error").html(trHTML);//display error message
						$(".applyForm").remove();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#editCourse', function(e){
		e.preventDefault(); //Disable botton
		$('#saveCourse').prop('disabled', true);
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doGetCourses.php?action=courseDetail&id=" + uid;
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#code").val(result.success.code);
						$("#name").val(result.success.name);
						$("#category").val(result.success.category);
						$("#department").val(result.success.department);
						$("#content").val(result.success.content);
						$("#content").html($("#content").val());
						$("#duration").val(result.success.duration);
						$("#dur_term").val(result.success.dur_term);
						$("#fee").val(result.success.fee);
						if($.trim(result.success.prerequisite).length > 0) {
							var arr = result.success.prerequisite.split(',');
							var i = '';
							for (i = 0; i < arr.length; i++) {
								var insertBox='<div class="col-sm-offset-3 col-sm-9"><div class="input-group"><input type="text" class="form-control" id="prerequisite" placeholder="Pra-Syarat Kursus" name="prerequisite" value="' + arr[i] + '"><span class="input-group-btn"><button class="btn btn-warning" type="button" id="delPrerequisite" onclick="deleteRow(this)">-</button></span></div><!-- /input-group --></div>';
								$("#preList").append(insertBox);
							}
						}
						url = "ajax/doGetCourses.php?action=courseEdit&id=" + uid;
						courseAction = "edit";
						$('#saveCourse').prop('disabled', false); //Enable botton
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#delCourse', function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doGetCourses.php?action=courseDelete&id=" + uid;
		if(confirm('Adakah anda ingin padam maklumat ini?')==true) {
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$('#displayresult tbody').html("");
						loadAllCourses();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
			});
		}
    });
	
	$(document).on('click', '#saveClass', function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.						
		var course = $("#course").val();//capture the content of the textbox.
		var start_day = $("#start_day").val();//capture the content of the textbox.
		var start_month = $("#start_month").val();//capture the content of the textbox.
		var start_year = $("#start_year").val();//capture the content of the textbox.
		var end_day = $("#end_day").val();//capture the content of the textbox.
		var end_month = $("#end_month").val();//capture the content of the textbox.
		var end_year = $("#end_year").val();//capture the content of the textbox.
		var start_time = $("#start_time").val();//capture the content of the textbox.
		var end_time = $("#end_time").val();//capture the content of the textbox.
		var classType = $("#classType").val();//capture the content of the textbox.
		if ($("#complete").prop('checked') == false) {
			var complete = 0;
		} else {
			var complete = 1;
		}
		
		if (course == "" || start_day == "" || start_month == "" || start_year == "" || end_day == "" || end_month == "" || end_year == "" || start_time == "" || end_time == "" || classType == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		
		var urlcarian=url + "&course=" + course + "&start_day=" + start_day + "&start_month=" + start_month + "&start_year=" + start_year + "&end_day=" + end_day + "&end_month=" + end_month + "&end_year=" + end_year + "&start_time=" + start_time + "&end_time=" + end_time + "&classType=" + classType + "&complete=" + complete;
		
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#error").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Kursus berjaya disimpan.</div>');//display error message
						$('#displayresult tbody').html("");
						loadAllClass();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#delClass', function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doGetClass.php?action=classDelete&id=" + uid;
		if(confirm('Adakah anda ingin padam maklumat ini?')==true) {
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$('#displayresult tbody').html("");
						loadAllClass();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
			});
		}
    });
	
	$(document).on('click', '#regClass', function(e){
		url = "ajax/doGetClass.php?action=classSave";
    });
	
	$(document).on('click', '#editClass', function(e){
		e.preventDefault(); //Disable botton
		$('#saveClass').prop('disabled', true);
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doGetClass.php?action=classDetail&id=" + uid;
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#course").val(result.success.id);
						$("#start_day").val(result.success.start_day);
						$("#start_month").val(result.success.start_month);
						$("#start_year").val(result.success.start_year);
						$("#end_day").val(result.success.end_day);
						$("#end_month").val(result.success.end_month);
						$("#end_year").val(result.success.end_year);
						$("#start_time").val(result.success.start_time);
						$("#end_time").val(result.success.end_time);
						$("#classType").val(result.success.classType);
						if (result.success.complete == 1) { $('#complete').prop('checked', true); }
						url = "ajax/doGetClass.php?action=classEdit&id=" + uid;
						courseAction = "edit";
						$('#saveClass').prop('disabled', false); //Enable botton
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#saveUser', function(e){
		e.preventDefault();
		var prerequisite = new Array();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var username = $("#username").val();//capture the content of the textbox.
		var fullname = $("#fullname").val();//capture the content of the textbox.
		var telnum = $("#telnum").val();//capture the content of the textbox.
		var email = $("#email").val();//capture the content of the textbox.
		var level = $("#level").val();//capture the content of the textbox.
		if ($("#active").prop('checked') == false) {
			var active = 0;
		} else {
			var active = 1;
		}
		
		if (username == "" || fullname == "" || telnum == "" || email == "" || level == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		
		var urlcarian=url + "&username=" + username + "&fullname=" + fullname + "&telnum=" + telnum + "&email=" + email + "&level=" + level + "&active=" + active;

		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#error").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Pengguna berjaya disimpan.</div>');//display error message
						$('#displayresult tbody').html("");
						loadAllUsers();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#savePass', function(e){
		e.preventDefault();
		var prerequisite = new Array();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var old_pass = $("#old_pass").val();//capture the content of the textbox.
		var new_pass = $("#new_pass").val();//capture the content of the textbox.
		var repeat_pass = $("#repeat_pass").val();//capture the content of the textbox.
		
		if (old_pass == "" || new_pass == "" || repeat_pass == "") { // if username variable is empty
			$("#errorPass").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		
		var urlcarian= url + "&old_pass=" + old_pass + "&new_pass=" + new_pass + "&repeat_pass=" + repeat_pass;

		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#errorPass").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#errorPass").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Kata laluan berjaya disimpan.</div>');//display error message
						$('#displayresult tbody').html("");
						loadAllUsers();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#errorPass").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#regUser', function(e){
		url = "ajax/doUsers.php?action=userSave";
    });
	
	$(document).on('click', '#editPass', function(e){
		e.preventDefault(); //Disable botton
		var uid = $(this).data('id'); // get id of clicked row
		url = "ajax/doUsers.php?action=passSave&id=" + uid;
    });
	
	$(document).on('click', '#editUser', function(e){
		e.preventDefault(); //Disable botton
		$('#saveUser').prop('disabled', true);
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doUsers.php?action=userDetail&id=" + uid;
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#username").val(result.success.username);
						$("#fullname").val(result.success.fullname);
						$("#telnum").val(result.success.telnum);
						$("#email").val(result.success.email);
						$("#level").val(result.success.level);
						if (result.success.active == 1) { $('#active').prop('checked', true); }
						url = "ajax/doUsers.php?action=userEdit&id=" + uid;
						courseAction = "edit";
						$('#saveUser').prop('disabled', false); //Enable botton
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#delUser', function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doUsers.php?action=userDelete&id=" + uid;
		if(confirm('Adakah anda ingin padam maklumat ini?')==true) {
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#result").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Pengguna berjaya dipadam.</div>');//display error message
						$('#displayresult tbody').html("");
						loadAllUsers();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
			});
		}
    });
	
	//department page
	$(document).on('click', '#saveDepart', function(e){
		e.preventDefault();
		var prerequisite = new Array();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var name = $("#name").val();//capture the content of the textbox.
		
		if (name == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		
		var urlcarian=url + "&name=" + name;

		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#error").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Bahagian/bangkel berjaya disimpan.</div>');//display error message
						$('#displayresult tbody').html("");
						loadAllDepart();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#regDepart', function(e){
		url = "ajax/doGetCourses.php?action=departSave";
    });
	
	$(document).on('click', '#editDepart', function(e){
		e.preventDefault(); //Disable botton
		$('#saveDepart').prop('disabled', true);
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doGetCourses.php?action=departDetail&id=" + uid;
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#name").val(result.success.name);
						url = "ajax/doGetCourses.php?action=departEdit&id=" + uid;
						courseAction = "edit";
						$('#saveDepart').prop('disabled', false); //Enable botton
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#delDepart', function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doGetCourses.php?action=departDelete&id=" + uid;
		if(confirm('Proses ini akan memberi kesan kepada senarai kursus dan permohonan kursus yang masih aktif. Adakah anda ingin padam maklumat ini?')==true) {
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#result").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Bahagian/bengkel berjaya dipadam.</div>');//display error message
						$('#displayresult tbody').html("");
						loadAllDepart();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
			});
		}
    });
	
	//category page
	$(document).on('click', '#saveCat', function(e){
		e.preventDefault();
		var prerequisite = new Array();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var name = $("#name").val();//capture the content of the textbox.
		
		if (name == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		
		var urlcarian=url + "&name=" + name;

		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#error").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Kategori berjaya disimpan.</div>');//display error message
						$('#displayresult tbody').html("");
						loadAllCat();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#regCat', function(e){
		url = "ajax/doGetCourses.php?action=catSave";
    });
	
	$(document).on('click', '#editCat', function(e){
		e.preventDefault(); //Disable botton
		$('#saveDepart').prop('disabled', true);
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doGetCourses.php?action=catDetail&id=" + uid;
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#name").val(result.success.name);
						url = "ajax/doGetCourses.php?action=catEdit&id=" + uid;
						courseAction = "edit";
						$('#saveDepart').prop('disabled', false); //Enable botton
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#delCat', function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var uid = $(this).data('id'); // get id of clicked row
		var urlcarian="ajax/doGetCourses.php?action=catDelete&id=" + uid;
		if(confirm('Adakah anda ingin padam maklumat ini?')==true) {
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						$("#result").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Kategori berjaya dipadam.</div>');//display error message
						$('#displayresult tbody').html("");
						loadAllCat();
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
			});
		}
    });
	
	$(document).on('click', '#saveSetting', function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var dbhost = $("#dbhost").val();//capture the content of the textbox.
		var dbuser = $("#dbuser").val();//capture the content of the textbox.
		var dbpass = $("#dbpass").val();//capture the content of the textbox.
		var dbname = $("#dbname").val();//capture the content of the textbox.
		var institute = $("#institute").val();//capture the content of the textbox.
		var inst_short = $("#inst_short").val();//capture the content of the textbox.
		var division = $("#division").val();//capture the content of the textbox.
		var address = $("#address").val();//capture the content of the textbox.
		var inst_notel = $("#inst_notel").val();//capture the content of the textbox.
		var inst_extention = $("#inst_extention").val();//capture the content of the textbox.
		var inst_nofax = $("#inst_nofax").val();//capture the content of the textbox.
		var inst_email = $("#inst_email").val();//capture the content of the textbox.
		var inst_website = $("#inst_website").val();//capture the content of the textbox.
		var slogan = $("#slogan").val();//capture the content of the textbox.
		var registration = $("#registration").val();//capture the content of the textbox.
		
		if (dbhost == "" || dbuser == "" || dbname == "" || institute == "" || inst_short == "" || division == "" || address == "" || inst_notel == "" || inst_extention == "" || inst_nofax == "" || inst_email == "" || inst_website == "" || slogan == "" || registration == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		
		var urlcarian="ajax/doUsers.php?action=saveSetting&dbhost=" + dbhost + "&dbuser=" + dbuser + "&dbname=" + dbname + "&dbpass=" + dbpass + "&institute=" + institute + "&inst_short=" + inst_short + "&division=" + division + "&address=" + address + "&inst_notel=" + inst_notel + "&inst_extention=" + inst_extention + "&inst_nofax=" + inst_nofax + "&inst_email=" + inst_email + "&inst_website=" + inst_website + "&slogan=" + slogan + "&registration=" + registration;
		
		if($.trim(dbhost).length > 0 || $.trim(dbuser).length > 0 || $.trim(dbname).length > 0 || $.trim(institute).length > 0 || $.trim(inst_short).length > 0 || $.trim(division).length > 0 || $.trim(division).length > 0 || $.trim(address).length > 0 || $.trim(inst_notel).length > 0 || $.trim(inst_extention).length > 0 || $.trim(inst_nofax).length > 0 || $.trim(inst_email).length > 0 || $.trim(inst_website).length > 0 || $.trim(slogan).length > 0 || $.trim(registration).length > 0) {
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						window.location.href = result.success; //redirect
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
			});
		}
    });
	
	$(document).on('click', '#allEmail', function(e){
		e.preventDefault(); //Disable botton
		var urlcarian="ajax/doUsers.php?action=allEmail";
		$.ajax({
			url:urlcarian,//the URL
			type:'get',//method used
			async:'true',
			dataType:"json",
			success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, j, errText, emailText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
					} else if (result.success) {//if the result success
						var i, j, errText = '';
						var values = [];
						for (i = 0; i < result.success.length; i++) {
							$('#emailTab').append('<li role="presentation"><a href="#list' + i + '" aria-controls="list' + i + '" role="tab" data-toggle="tab">List' + i + '</a></li>');
							
							errText += '<div role="tabpanel" class="tab-pane" id="list' + i + '">';
							$.each(result.success[i].list, function (key,value) {
								errText += value.email + '; ';
							})
							errText += '</div>';
						}
						$('#emailContent').append(errText);
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
				}//error
		});
    });
	
	$(document).on('click', '#applyNo', function(e){
		e.preventDefault(); //Disable botton
		var urlcarian="ajax/doCheckApply.php?action=applyNo";
		if(confirm('Adakah anda ingin kemaskini maklumat ini?')==true) {
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				success:function(result){//if the connection success
						if (result.errors) {//if the result error
							var i, j, errText, emailText = '';
							for (i = 0; i < result.errors.length; i++) {
								errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
							}
							$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
						} else if (result.success) {//if the result success
							$("#error").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Permohonan kursus berjaya dikemaskini.</div>');//display error message
						}
					},//success
					error:function(result,error){//if the connection fail
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
					}//error
			});
		}
    });
	
	$(document).on('click', '#applyYes', function(e){
		e.preventDefault(); //Disable botton
		var urlcarian="ajax/doCheckApply.php?action=applyYes";
		if(confirm('Adakah anda ingin kemaskini maklumat ini?')==true) {
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				success:function(result){//if the connection success
						if (result.errors) {//if the result error
							var i, j, errText, emailText = '';
							for (i = 0; i < result.errors.length; i++) {
								errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
							}
							$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
						} else if (result.success) {//if the result success
							$("#error").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Permohonan kursus berjaya dikemaskini.</div>');//display error message
						}
					},//success
					error:function(result,error){//if the connection fail
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
					}//error
			});
		}
    });
	
	$(document).on("click","#findStaff",function(){
		var searchStaff=$("#searchStaff").val();//capture the content of the textbox.
		if (searchStaff == "") { // if username variable is empty
			alert("Sila masukkan nama / bahagian / jawatan anda");//display error message
			return false; // stop the script
		}
		var urlcarian="ajax/doSearchStaff.php";
		if($.trim(searchStaff).length > 0) {
			//AJAX configuration
			$.ajax({
				url:urlcarian,//the URL
				type:'post',//method used
				async:'true',
				data:{searchStaff:searchStaff},//the data parameter to transfer
				beforeSend: function(){ $("#findStaff").val('Proces carian...'); },
				success:function(result){//if the connection success
					//display the record in div displayresult
					$("#findStaff").val('Carian');
					$("#displayresult").html(result).enhanceWithin();
				},//success
				error:function(request,error){//if the connection fail
					$("#findStaff").val('Carian');
					$("#infoSearch").html("Network error!!!").enhanceWithin();
				}//error
			});//ajax
		}
		return false;
	});
	
	$(document).on("click","#saveData",function(){
		var insUniform = new Array();
		var insAct = new Array();
		var insActLvl = new Array();
		
		var mode=$("#mode").val();//capture the content of the textbox.
		var staffID=$("#staffID").val();//capture the content of the textbox.
		var yearService=$("#yearService").val();//capture the content of the textbox.
		var yearILPKL=$("#yearILPKL").val();//capture the content of the textbox.
		var u21=$('input:radio[name=u21]:checked').val();//capture the content of the textbox.
		var u22=$('input:radio[name=u22]:checked').val();//capture the content of the textbox.
		var u23=$('input:radio[name=u23]:checked').val();//capture the content of the textbox.
		var u24=$('input:radio[name=u24]:checked').val();//capture the content of the textbox.
		var u25=$('input:radio[name=u25]:checked').val();//capture the content of the textbox.
		
		$("input[name=insUniform]").each(function() { insUniform.push($(this).val()); });//capture the content of the textbox.
		$("input[name=insAct]").each(function() { insAct.push($(this).val()); });//capture the content of the textbox.
		$("input[name=insActLvl]").each(function() { insActLvl.push($(this).val()); });//capture the content of the textbox.
		
		var UniformInsert = insUniform.toString();
		var ActInsert = insAct.toString();
		var ActLevelInsert = insActLvl.toString();
		
		if (yearService == "" || yearILPKL == "" || $("#u21:checked").length == 0 || $("#u22:checked").length == 0 || $("#u23:checked").length == 0 || $("#u24:checked").length == 0 || $("#u25:checked").length == 0) { // if username variable is empty
			alert("Sila lengkapkan semua maklumat.");//display error message
			return false; // stop the script
		}
		var urlcarian="core/ajax/doSaveSurvey.php";
		if($.trim(yearService).length > 0 && $.trim(yearILPKL).length > 0 && $.trim(u21).length > 0 && $.trim(u22).length > 0 && $.trim(u23).length > 0 && $.trim(u24).length > 0 && $.trim(u25).length > 0) {
			//AJAX configuration
			$.ajax({
				url:urlcarian,//the URL
				type:'post',//method used
				async:'true',
				data:{mode:mode, staffID:staffID, yearService:yearService, yearILPKL:yearILPKL, u21:u21, u22:u22, u23:u23, u24:u24, u25:u25, UniformInsert:UniformInsert, ActInsert:ActInsert, ActLevelInsert:ActLevelInsert},//the data parameter to transfer
				beforeSend: function(){ $("#saveData").val('Proces menyimpan maklumat...'); },
				success:function(result){//if the connection success
					if(result=="true"){
					//display the record in div displayresult
						$("#saveData").val('Simpan');
						alert("Maklumat anda berjaya disimpan.");//display error message
						window.location.href = "index.php?p=search";
					} else {
						$("#saveData").val('Simpan');
						alert(result);//display error message
					}
				},//success
				error:function(request,error){//if the connection fail
					$("#saveData").val('Simpan');
					$("#infoSearch").html("Network error!!!").enhanceWithin();
				}//error
			});//ajax
		}
		return false;
	});
	
	$(document).on("click","#addUniform",function(){
		var insertBox='<tr class="dataRow"><td><input type="text" name="insUniform" id="insUniform" class="insUniform ui-input ui-round-all ui-shadow ui-no-margin" placeholder="Badan beruniform" /></td><td><input type="button" class="ui-button ui-round-all ui-shadow ui-button-yellow ui-mini ui-no-margin" id="removrThis" class="ui-input" value="Buang" onclick="deleteRow(this)" /></td></tr>';
		$("#insertUniform").append(insertBox);
		return false;
	});
	
	$(document).on("click","#addActivities",function(){
		var insertBox='<tr class="dataRow"><td><input type="text" name="insAct" id="insAct" class="insAct ui-input ui-round-all ui-shadow ui-no-margin" placeholder="Jawatankuasa / Aktiviti / Tugas" /></td><td><input type="text" name="insActLvl" id="insActLvl" class="insActLvl ui-input ui-round-all ui-shadow ui-no-margin" placeholder="Peringkat (KSM / JTM / ILPKL)" /></td><td><input type="button" class="ui-button ui-round-all ui-shadow ui-button-yellow ui-mini ui-no-margin" id="removrThis" class="ui-input" value="Buang" onclick="deleteRow(this)" /></td></tr>';
		$("#insertActivities").append(insertBox);
		return false;
	});
	
	$(document).on("click","#staffView",function(){
		var viewStaff=$("#viewStaff").val();//capture the content of the textbox.
		if (viewStaff == "") { // if username variable is empty
			alert("Sila masukkan nama / bahagian / jawatan anda");//display error message
			return false; // stop the script
		}
		var urlcarian="core/ajax/doFindStaff.php";
		if($.trim(viewStaff).length > 0) {
			//AJAX configuration
			$.ajax({
				url:urlcarian,//the URL
				type:'post',//method used
				async:'true',
				data:{viewStaff:viewStaff},//the data parameter to transfer
				beforeSend: function(){ $("#staffView").val('Proces carian...'); },
				success:function(result){//if the connection success
					//display the record in div displayresult
					$("#staffView").val('Carian');
					$("#displayresult").html(result).enhanceWithin();
				},//success
				error:function(request,error){//if the connection fail
					$("#staffView").val('Carian');
					$("#infoSearch").html("Network error!!!").enhanceWithin();
				}//error
			});//ajax
		}
		return false;
	});
})

function deleteRow(btn) {
	if(confirm('Adakah anda ingin padam maklumat ini?')==true) {
		var row = btn.parentNode.parentNode.parentNode;
		row.parentNode.removeChild(row);
	}
}

function searchList() {
	var input, filter, table, tr, td, i;
	inputText = document.getElementById("searchBox");
	inputSelect = document.getElementById("selectBox");
	filterText = inputText.value.toUpperCase();
	filterSelect = inputSelect.value.toUpperCase();
	table = document.getElementById("displayresult");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[0];
		tdText = tr[i].getElementsByTagName("td")[1];
		tdSelect = tr[i].getElementsByTagName("td")[2];
		if (td) {
			if (tdText.innerHTML.toUpperCase().indexOf(filterText) > -1  && tdSelect.innerHTML.toUpperCase().indexOf(filterSelect) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}       
	}
}

function searchClassList() {
	var input, filter, table, tr, td, i;
	inputText = document.getElementById("searchBox");
	inputSelect = document.getElementById("selectBox");
	filterText = inputText.value.toUpperCase();
	filterSelect = inputSelect.value.toUpperCase();
	table = document.getElementById("displayresult");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[0];
		tdText = tr[i].getElementsByTagName("td")[0];
		tdSelect = tr[i].getElementsByTagName("td")[3];
		if (td) {
			if (tdText.innerHTML.toUpperCase().indexOf(filterText) > -1  && tdSelect.innerHTML.toUpperCase().indexOf(filterSelect) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}       
	}
}

function searchApplyList() {
	var input, filter, table, tr, td, i, tm;
	inputText = document.getElementById("searchBox");
	inputSelect = document.getElementById("selectBox");
	inputStat = document.getElementById("selectStat");
	inputTime = document.getElementById("selectTime");
	filterText = inputText.value.toUpperCase();
	filterSelect = inputSelect.value.toUpperCase();
	filterStat = inputStat.value.toUpperCase();
	filterTime = inputTime.value.toUpperCase();
	table = document.getElementById("displayresult");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		tm = tr[i].getAttribute("data-time")
		td = tr[i].getElementsByTagName("td")[0];
		tdText = tr[i].getElementsByTagName("td")[1];
		tdSelect = tr[i].getElementsByTagName("td")[0];
		tdStat = tr[i].getElementsByTagName("td")[3];
		if (td) {
			if (tdText.innerHTML.toUpperCase().indexOf(filterText) > -1 && tdSelect.innerHTML.toUpperCase().indexOf(filterSelect) > -1 && tdStat.innerHTML.toUpperCase().indexOf(filterStat) > -1 && tm.toUpperCase().indexOf(filterTime) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}       
	}
}

function loadCourses() {
	var urlcarian="ajax/doGetCourses.php?action=addList";
	//AJAX configuration
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"json",
		success:function(result){//if the connection success
			//display the record in div displayresult
			var trHTML, mdlHTML = '';
			$.each(result, function (key,value) { 
				trHTML += 
				'<tr><td><a data-toggle="modal" href="#courseDetail" data-id="' + value.id + '" id="getCourse">' + value.code + 
				'</a></td><td>' + value.name + 
				'</td><td>' + value.department + 
				'</td>' + 
				'</tr>';
			});
			//$('#displayresult tbody').append(trHTML);
			$('#displayresult tbody').html(trHTML);
			if ( ! $.fn.DataTable.isDataTable( '#displayresult' ) ) {
				$('#displayresult tbody').html(trHTML);
				InitOverviewDataTable();
			} else {
				$('#displayresult').DataTable().destroy();
				$('#displayresult tbody').html(trHTML);
				InitOverviewDataTable();
			}
		},//success
		error:function(request,error){//if the connection fail
			$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
		}//error
	});//ajax
}

function loadAllApply() {
	var urlcarian="ajax/doCheckApply.php?action=addAllApply";
	//AJAX configuration
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"json",
		success:function(result){//if the connection success
			//display the record in div displayresult
			var trHTML = '';
			$.each(result, function (key,value) {
				trHTML += '<tr data-year="' + value.created + '" data-time="' + value.time + '"><td>' + value.id + '</td><td>' + value.code + '<br>' + value.created + '</td><td>' + value.name + '<br>' + value.noic + '</td><td>' + value.notel + '<br>' + value.email + '</td><td><a data-toggle="modal" href="#courseDetail" data-id="' + value.id + '" id="getApplyDetails">' + value.stat + '</a></td></tr>';
			});
			//$('#displayresult tbody').append(trHTML);
			$('#displayresult tbody').html(trHTML);
			if ( ! $.fn.DataTable.isDataTable( '#displayresult' ) ) {
				InitOverviewDataTable();
			} else {
				$('#displayresult').DataTable().destroy();
				$('#displayresult tbody').html(trHTML);
				InitOverviewDataTable();
			}
		},//success
		error:function(request,error){//if the connection fail
			$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
		}//error
	});//ajax
}

function loadApplyStat() {
	var urlcarian="ajax/doCheckApply.php?action=addApply";
	//AJAX configuration
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"json",
		success:function(result){//if the connection success
			//display the record in div displayresult
			var trHTML = '';
			$.each(result, function (key,value) {
				trHTML += '<tr><td>' + value.code + '</td><td>' + value.name + '</td><td>' + value.semak + '</td><td>' + value.sah + '</td><td>' + value.terima + '</td><td>' + value.tolak + '</td><td>' + value.selesai + '</td></tr>';
			});
			//$('#displayresult tbody').append(trHTML);
			$('#displayresult tbody').html(trHTML);
			if ( ! $.fn.DataTable.isDataTable( '#displayresult' ) ) {
				InitOverviewDataTable();
			} else {
				$('#displayresult').DataTable().destroy();
				$('#displayresult tbody').html(trHTML);
				InitOverviewDataTable();
			}
		},//success
		error:function(request,error){//if the connection fail
			$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
		}//error
	});//ajax
}

function loadAllClass() {
	var urlcarian="ajax/doGetClass.php?action=addAllClass";
	//AJAX configuration
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"json",
		success:function(result){//if the connection success
			//display the record in div displayresult
			var trHTML = '';
			$.each(result, function (key,value) {
				trHTML += '<tr><td>' + value.id + '</td><td><a href="index.php?p=enroll&cid=' + value.id + '">' + value.code + '<br>' + value.name + '</a></td><td>' + value.date_start + '<br>' + value.date_end + '</td><td>' + value.time_start + '<br>' + value.time_end + '</td><td>' + value.complete + '</td><td><div class="btn-group-vertical"><a data-toggle="modal" href="#courseDetail" data-id="' + value.id + '" id="editClass" class="btn btn-warning btn-xs" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Sunting</a><button type="button" data-id="' + value.id + '" class="btn btn-danger btn-xs" id="delClass"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Padam</button></div></td></tr>';
			});
			//$('#displayresult tbody').append(trHTML);
			$('#displayresult tbody').html(trHTML);
			if ( ! $.fn.DataTable.isDataTable( '#displayresult' ) ) {
				InitOverviewDataTable();
			} else {
				$('#displayresult').DataTable().destroy();
				$('#displayresult tbody').html(trHTML);
				InitOverviewDataTable();
			}
		},//success
		error:function(request,error){//if the connection fail
			$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
		}//error
	});//ajax
}

function loadAllCourses() {
	var urlcarian="ajax/doGetCourses.php?action=addAllList";
	//AJAX configuration
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"json",
		success:function(result){//if the connection success
			//display the record in div displayresult
			var trHTML = '';
			var listrow = 1;
			$.each(result, function (key,value) {
				if (value.active != 1) {
					trHTML += '<tr class="bg-danger aktif">';
				} else {
					trHTML += '<tr class="tidak">';
				}
				trHTML += '<td>' + value.code + '<br />' + value.name + '</td><td>' + value.category + '<br />' + value.department + '</td><td>RM' + value.fee + '.00<br />' + value.duration + ' ' + value.dur_term + '</td><td><div class="btn-group-vertical"><a data-toggle="modal" href="#courseDetail" data-id="' + value.id + '" id="editCourse" class="btn btn-warning btn-xs" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Sunting</a><button type="button" data-id="' + value.id + '" class="btn btn-danger btn-xs" id="delCourse"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Padam</button></div></td></tr>';
				listrow++;
			});
			//$('#displayresult tbody').append(trHTML);
			$('#displayresult tbody').html(trHTML);
			if ( ! $.fn.DataTable.isDataTable( '#displayresult' ) ) {
				InitOverviewDataTable();
			} else {
				$('#displayresult').DataTable().destroy();
				$('#displayresult tbody').html(trHTML);
				InitOverviewDataTable();
			}
		},//success
		error:function(request,error){//if the connection fail
			$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
		}//error
	});//ajax
}

function loadApply() {
	var urlcarian="ajax/doGetCourses.php?action=addList";
	//AJAX configuration
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"json",
		success:function(result){//if the connection success
			//display the record in div displayresult
			var trHTML, mdlHTML = '';
			$.each(result, function (key,value) { 
				trHTML += 
				'<tr><td><a data-toggle="modal" href="#courseDetail" data-id="' + value.id + '" id="getApply">' + value.code + 
				'</a></td><td>' + value.name + 
				'</td><td>' + value.department + 
				'</td>' + 
				'</tr>';
			});
			//$('#displayresult tbody').append(trHTML);
			$('#displayresult tbody').html(trHTML);
			if ( ! $.fn.DataTable.isDataTable( '#displayresult' ) ) {
				InitOverviewDataTable();
			} else {
				$('#displayresult').DataTable().destroy();
				$('#displayresult tbody').html(trHTML);
				InitOverviewDataTable();
			}
		},//success
		error:function(request,error){//if the connection fail
			$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
		}//error
	});//ajax
}

function loadAllUsers() {
	var urlcarian="ajax/doUsers.php?action=addAllList";
	//AJAX configuration
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"json",
		success:function(result){//if the connection success
			//display the record in div displayresult
			var trHTML = '';
			var listrow = 1;
			$.each(result, function (key,value) {
				if (value.active != 1) {
					trHTML += '<tr class="bg-danger aktif">';
				} else {
					trHTML += '<tr class="tidak">';
				}
				trHTML += '<td>' + value.username + '</td><td>' + value.fullname + '</td><td>' + value.level + '</td><td><a data-toggle="modal" href="#changePassword" data-id="' + value.id + '" id="editPass">Tukar Kata Laluan</a></td><td>' + value.last_login + '"</td><td><div class="btn-group-vertical"><a data-toggle="modal" href="#courseDetail" data-id="' + value.id + '" id="editUser" class="btn btn-warning btn-xs" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Sunting</a><button type="button" data-id="' + value.id + '" class="btn btn-danger btn-xs" id="delUser"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Padam</button></div></td></tr>';
				listrow++;
			});
			//$('#displayresult tbody').append(trHTML);
			$('#displayresult tbody').html(trHTML);
			if ( ! $.fn.DataTable.isDataTable( '#displayresult' ) ) {
				InitOverviewDataTable();
			} else {
				$('#displayresult').DataTable().destroy();
				$('#displayresult tbody').html(trHTML);
				InitOverviewDataTable();
			}
		},//success
		error:function(request,error){//if the connection fail
			$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
		}//error
	});//ajax
}

function loadAllDepart() {
	var urlcarian="ajax/dogetCourses.php?action=addAllDepart";
	//AJAX configuration
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"json",
		success:function(result){//if the connection success
			//display the record in div displayresult
			var trHTML = '';
			var listrow = 1;
			$.each(result, function (key,value) {
				trHTML += '<tr><td>' + value.id + '</td><td>' + value.name + '</td><td><div class="btn-group-vertical"><a data-toggle="modal" href="#courseDetail" data-id="' + value.id + '" id="editDepart" class="btn btn-warning btn-xs" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Sunting</a><button type="button" data-id="' + value.id + '" class="btn btn-danger btn-xs" id="delDepart"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Padam</button></div></td></tr>';
				listrow++;
			});
			//$('#displayresult tbody').append(trHTML);
			$('#displayresult tbody').html(trHTML);
			if ( ! $.fn.DataTable.isDataTable( '#displayresult' ) ) {
				InitOverviewDataTable();
			} else {
				$('#displayresult').DataTable().destroy();
				$('#displayresult tbody').html(trHTML);
				InitOverviewDataTable();
			}
		},//success
		error:function(request,error){//if the connection fail
			$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
		}//error
	});//ajax
}

function loadAllCat() {
	var urlcarian="ajax/dogetCourses.php?action=addAllCat";
	//AJAX configuration
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"json",
		success:function(result){//if the connection success
			//display the record in div displayresult
			var trHTML = '';
			var listrow = 1;
			$.each(result, function (key,value) {
				trHTML += '<tr><td>' + value.id + '</td><td>' + value.name + '</td><td><div class="btn-group-vertical"><a data-toggle="modal" href="#courseDetail" data-id="' + value.id + '" id="editCat" class="btn btn-warning btn-xs" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Sunting</a><button type="button" data-id="' + value.id + '" class="btn btn-danger btn-xs" id="delCat"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Padam</button></div></td></tr>';
				listrow++;
			});
			//$('#displayresult tbody').append(trHTML);
			$('#displayresult tbody').html(trHTML);
			if ( ! $.fn.DataTable.isDataTable( '#displayresult' ) ) {
				InitOverviewDataTable();
			} else {
				$('#displayresult').DataTable().destroy();
				$('#displayresult tbody').html(trHTML);
				InitOverviewDataTable();
			}
		},//success
		error:function(request,error){//if the connection fail
			$("#result").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
		}//error
	});//ajax
}

function loadApplyCourse(cid, noic) {
	var urlcarian="ajax/doCheckApply.php?action=applyCourse&noic=" + noic + "&cid=" + cid;
	//AJAX configuration
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"json",
		success:function(result){//if the connection success
			if (result.errors) {//if the result error
				$('#saveCourse').prop('disabled', true);
				var i, errText = '';
				for (i = 0; i < result.errors.length; i++) {
					errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
				}
				$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
			} else if (result.success) {//if the result success
				$("#id").val(result.success.id);
				$("#course").html(result.success.code + " - " + result.success.course);
				$("#category").html(result.success.category);
				$("#department").html(result.success.department);
				$("#content").html(result.success.content);
				$("#name").val(result.success.name);
				$("#noic").val(result.success.noic);
				$("#nationality").val(result.success.nationality);
				$("#address").val(result.success.address);
				$("#postcode").val(result.success.postcode);
				$("#notel").val(result.success.notel);
				$("#email").val(result.success.email);
				if($.trim(result.success.prerequisite).length > 0) {
					var arr = result.success.prerequisite.split(',');
					var i = '';
					for (i = 0; i < arr.length; i++) {
						var insertBox='<li>' + arr[i] + '</li>';
						$("#preList").append(insertBox);
					}
				}
				$("#dynamic-content").html(result.success.content);
				
				var p = result.success.prerequisite;
				if($.trim(p).length == 0) {
					$(".praSyarat").remove();
				}
			}
		},//success
		error:function(request,error){//if the connection fail
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
		}//error
	});//ajax
}

function loadClass(cid) {
	var urlcarian="ajax/doGetClass.php?action=viewClass&id=" + cid;
	var allAgree = new Array();
	var allEmail = new Array();
	//AJAX configuration
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"json",
		success:function(result){//if the connection success
			if (result.errors) {//if the result error
				$('#saveCourse').prop('disabled', true);
				var i, errText = '';
				for (i = 0; i < result.errors.length; i++) {
					errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
				}
				$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
			} else if (result.success) {//if the result success
				$("#course").html(result.success.course);
				$("#date").html(result.success.date_start + " - " + result.success.date_end);
				$("#time").html(result.success.start_time + " - " + result.success.end_time);
				
				var trHTML = '';
				var i = 1;
				$.each(result.success.participant, function (key,value) {
					trHTML += '<tr><td>' + i + '</td><td>' + value.name + '<br>' + value.noic + ' (' + value.gender + ')</td><td>' + value.notel + '<br>' + value.email + '</td><td>';
					if (result.success.complete == 1) {
						trHTML += 'Setuju';
					} else {
						trHTML += '<div class="checkbox"><label><input type="checkbox" id="agree[]" name="agree[]" value="' + value.id + '"';
						if (result.success.id == value.clas) {
							trHTML += ' checked = "checked"';
						}
						trHTML += '> Setuju</label></div>';
					}
					trHTML += '</td></tr>';
					
					allEmail.push(value.email);
					i++;
				});
				//$('#displayresult tbody').append(trHTML);
				$('#displayresult tbody').html(trHTML);
				if ( ! $.fn.DataTable.isDataTable( '#displayresult' ) ) {
					InitOverviewDataTable();
				} else {
					$('#displayresult').DataTable().destroy();
					$('#displayresult tbody').html(trHTML);
					InitOverviewDataTable();
				}
				$("#displayemail").html('<p>' + allEmail.join('; ') + '</p>').enhanceWithin();
			}
		},//success
		error:function(request,error){//if the connection fail
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Masalah sambungan rangkaian ke pangkalan data!</div>');
		}//error
	});//ajax
}

function loadEvent(cid) {
	var urlcarian="ajax/doEvents.php";
	$('#carousel-example-generic').html(''); // leave this div blank
	$.ajax({
		url:urlcarian,//the URL
		type:'get',//method used
		async:'true',
		dataType:"html",
	})
	.done(function(data){
		$('#carousel-example-generic').html(''); // blank before load.
		$('#carousel-example-generic').html(data); // load here 
	});
}

function InitOverviewDataTable()
{
	$('#displayresult').DataTable({
		"language": {
			"sEmptyTable": "Tiada data",
			"sInfo": "Paparan dari _START_ hingga _END_ dari _TOTAL_ rekod",
			"sInfoEmpty": "Paparan 0 hingga 0 dari 0 rekod",
			"sInfoFiltered": "(Ditapis dari jumlah _MAX_ rekod)",
			"sInfoPostFix": "",
			"sInfoThousands": ",",
			"sLengthMenu": "Papar _MENU_ rekod",
			"sLoadingRecords": "Diproses...",
			"sProcessing": "Sedang diproses...",
			"sSearch": "Carian:",
			"sZeroRecords": "Tiada padanan rekod yang dijumpai.",
			"oPaginate": {
				"sFirst": "Pertama",
				"sPrevious": "Sebelum",
				"sNext": "Kemudian",
				"sLast": "Akhir"
			},
			"oAria": {
				"sSortAscending": ": diaktifkan kepada susunan lajur menaik",
				"sSortDescending": ": diaktifkan kepada susunan lajur menurun"
			}
		},
		"order": [[ 0, "desc" ]],
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
	});
}
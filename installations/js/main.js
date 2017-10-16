// JavaScript Document
$(function(){
	// Binding next button on first step
	$(".open1").click(function() {
		$(".frm").hide("fast");
		$("#sf2").show("slow");
	});

	// Binding next button on second step
	$(".open2").click(function() {
		var dbhost = $("#dbhost").val();//capture the content of the textbox.
		var dbuser = $("#dbuser").val();//capture the content of the textbox.
		var dbname = $("#dbname").val();//capture the content of the textbox.
		if (dbhost == "" || dbuser == "" || dbname == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		$(".frm").hide("fast");
		$("#sf3").show("slow");
		$("#error").html('');
	});
	
	// Binding next button on second step
	$(".open3").click(function() {
		var fullname = $("#fullname").val();//capture the content of the textbox.
		var notel = $("#notel").val();//capture the content of the textbox.
		var email = $("#email").val();//capture the content of the textbox.
		var username = $("#username").val();//capture the content of the textbox.
		var pass = $("#password").val();//capture the content of the textbox.
		if (fullname == "" || notel == "" || email == "" || username == "" || pass == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		$(".frm").hide("fast");
		$("#sf4").show("slow");
		$("#error").html('');
	});

	// Binding next button on second step
	$(".open4").click(function() {
		var institute = $("#institute").val();//capture the content of the textbox.
		var inst_short = $("#inst_short").val();//capture the content of the textbox.
		var division = $("#division").val();//capture the content of the textbox.
		var address = $("#address").val();//capture the content of the textbox.
		var inst_notel = $("#inst_notel").val();//capture the content of the textbox.
		var inst_extention = $("#inst_extention").val();//capture the content of the textbox.
		var inst_nofax = $("#inst_nofax").val();//capture the content of the textbox.
		var inst_email = $("#inst_email").val();//capture the content of the textbox.
		var inst_website = $("#inst_website").val();//capture the content of the textbox.
		
		if (institute == "" || inst_short == "" || division == "" || address == "" || inst_notel == "" || inst_extention == "" || inst_nofax == "" || inst_email == "" || inst_website == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		$(".frm").hide("fast");
		$("#sf5").show("slow");
		$("#error").html('');
	});
	
	// Binding back button on second step
	$(".back2").click(function() {
		$(".frm").hide("fast");
		$("#sf1").show("slow");
		$("#error").html('');
	});

	// Binding back button on third step
	$(".back3").click(function() {
		$(".frm").hide("fast");
		$("#sf2").show("slow");
		$("#error").html('');
	});
	
	// Binding back button on third step
	$(".back4").click(function() {
		$(".frm").hide("fast");
		$("#sf3").show("slow");
		$("#error").html('');
	});
	
	// Binding back button on third step
	$(".back5").click(function() {
		$(".frm").hide("fast");
		$("#sf4").show("slow");
		$("#error").html('');
	});
	
	$(document).on("click","#saveApply",function(e){
		e.preventDefault();
		$(".alert-dismissible").alert("close"); //close alert after modal close.
		var dbhost = $("#dbhost").val();//capture the content of the textbox.
		var dbuser = $("#dbuser").val();//capture the content of the textbox.
		var dbpass = $("#dbpass").val();//capture the content of the textbox.
		var dbname = $("#dbname").val();//capture the content of the textbox.
		var fullname = $("#fullname").val();//capture the content of the textbox.
		var notel = $("#notel").val();//capture the content of the textbox.
		var email = $("#email").val();//capture the content of the textbox.
		var username = $("#username").val();//capture the content of the textbox.
		var pass = $("#password").val();//capture the content of the textbox.
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
		
		if (dbhost == "" || dbuser == "" || dbname == "" || fullname == "" || notel == "" || email == "" || username == "" || pass == "" || institute == "" || inst_short == "" || division == "" || address == "" || inst_notel == "" || inst_extention == "" || inst_nofax == "" || inst_email == "" || inst_website == "" || slogan == "" || registration == "") { // if username variable is empty
			$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Ruang yang bertanda bintang (<span class="text-danger">*</span>) adalah wajib diisi.</div>');//display error message
			return false; // stop the script
		}
		
		var urlcarian="core/database/create.php?action=create&dbhost=" + dbhost + "&dbuser=" + dbuser + "&dbname=" + dbname + "&dbpass=" + dbpass + "&fullname=" + fullname + "&notel=" + notel + "&email=" + email + "&username=" + username + "&pass=" + pass + "&institute=" + institute + "&inst_short=" + inst_short + "&division=" + division + "&address=" + address + "&inst_notel=" + inst_notel + "&inst_extention=" + inst_extention + "&inst_nofax=" + inst_nofax + "&inst_email=" + inst_email + "&inst_website=" + inst_website + "&slogan=" + slogan + "&registration=" + registration;
		
		if($.trim(dbhost).length > 0 || $.trim(dbuser).length > 0 || $.trim(dbname).length > 0 || $.trim(fullname).length > 0 || $.trim(notel).length > 0 || $.trim(email).length > 0 || $.trim(username).length > 0 || $.trim(pass).length > 0 || $.trim(institute).length > 0 || $.trim(inst_short).length > 0 || $.trim(division).length > 0 || $.trim(division).length > 0 || $.trim(address).length > 0 || $.trim(inst_notel).length > 0 || $.trim(inst_extention).length > 0 || $.trim(inst_nofax).length > 0 || $.trim(inst_email).length > 0 || $.trim(inst_website).length > 0 || $.trim(slogan).length > 0 || $.trim(registration).length > 0) {
			//AJAX configuration
			$.ajax({
				url:urlcarian,//the URL
				type:'get',//method used
				async:'true',
				dataType:"json",
				beforeSend: function(){ $("#saveApply").val('Proces installasi...'); },
				success:function(result){//if the connection success
					if (result.errors) {//if the result error
						var i, errText = '';
						for (i = 0; i < result.errors.length; i++) {
							errText += '<strong>Amaran!</strong> ' + result.errors[i] + '<br>';
						}
						$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + errText + '</div>');//display error message
						$("#saveApply").val('Install');
					} else if (result.success) {//if the result success
						window.location.href = result.success; //redirect
					}
				},//success
				error:function(result,error){//if the connection fail
					$("#saveApply").val('Install');
					$("#error").html('');
					$("#error").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Amaran!</strong> Network error!!!</div>');//display error message
				}//error
			});//ajax
		}
	});
})
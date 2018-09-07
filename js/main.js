$(function(){
	//for user resistration
	$("#regsubmit").click(function(){
		var name 	 = $("#name").val();
		var username = $("#username").val();
		var userpass = $("#userpass").val();
		var email 	 = $("#email").val();
		var dataString = 'name='+name+'&username='+username+'&userpass='+userpass+'&email='+email;

		$.ajax({
			type: "POST",
			url: "getresister.php",
			data: dataString,
			success: function(data){
				$("#state").html(data);
			}
		});
		return false;
	});

	//for user login
	$("#submitlogin").click(function(){
		var email 	 = $("#email").val();
		var userpass = $("#userpass").val();
		var dataString = 'email='+email+'&userpass='+userpass;

		$.ajax({
			type: "POST",
			url: "getlogin.php",
			data: dataString,
			success: function(data){
				if($.trim(data) == "empty"){
					$(".empty").show();
					setTimeout(function(){
						$(".empty").fadeOut();
					},3000);
				}else if($.trim(data) == "disable"){
					$(".disable").show();
					setTimeout(function(){
						$(".disable").fadeOut();
					},3000);					
				}else if($.trim(data) == "error"){
					$(".error").show();
					setTimeout(function(){
						$(".error").fadeOut();
					},3000);
				}else{
					window.location = "exam.php";

				}
			}
		});
		return false;
	});
});
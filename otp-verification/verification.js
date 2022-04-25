function sendOTP() {
	$(".error").html("").hide();
	var number = $("#mobile").val();
	if (number.length == 10 && number != null) {
		var input = {
			"mobile_number" : number,
			"action" : "send_otp"
		};
		$.ajax({
			url : 'controller.php',
			type : 'POST',
			data : input,
			success : function(response) {
				$(".container").html(response);
			}
		});
	} else {
		$(".error").html('Please enter a valid number!')
		$(".error").show();
	}
}

function verifyOTP() {
	$(".error").html("").hide();
	$(".success").html("").hide();
	var otp = $("#mobileOtp").val();
	var number = $("#mobile").val();
	var input = {
		"otp" : otp,
		"mobile_number" : number,
		"action" : "verify_otp"
	};
	if (otp != null) {
		$.ajax({
			url : 'controller.php',
			type : 'POST',
			dataType : "json",
			data : input,
			success : function(response) {
				$("." + response.type).html(response.message)
				$("." + response.type).show();
			},
			error : function() {
				$(".error").html('You have entered wrong OTP.')
		        $(".error").show();
			}
		});
	} else {
		$(".error").html('You have entered wrong OTP.')
		$(".error").show();
	}
}
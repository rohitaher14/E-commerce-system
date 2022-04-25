<!DOCTYPE html>
<html>
<head>
<title>Mobile Verification in PHP with SMS Alert</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>

	<div class="container">
		<div class="error"></div>
		<form id="frm-mobile-verification">
			<div class="form-heading">Mobile Number Verification</div>

			<div class="form-row">
				<input type="number" id="mobile" class="form-input"
					placeholder="Enter the 10 digit mobile">
			</div>

			<input type="button" class="btnSubmit" value="Send OTP"
				onClick="sendOTP();">
		</form>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
	<script src="verification.js"></script>
</body>
</html>
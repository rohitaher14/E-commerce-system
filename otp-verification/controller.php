<?php
include("smsalert/vendor/autoload.php");
use SMSAlert\Lib\Smsalert\Smsalert;

class Controller
{
	private $apikey		='';
	private $senderid	='ESTORE';
	private $route		='';
	private $username 	='CHANGE_HERE';
	private $pass		='CHANGE_HERE';
	private $prefix		='91';
    function __construct() {
        $this->processMobileVerification();
    }
    function processMobileVerification()
    {
		$smsalert 	= (new Smsalert()) 		
	                ->authWithUserIdPwd($this->username,$this->pass)
	                ->setForcePrefix($this->prefix)
	                ->setSender($this->senderid);
					
        switch ($_POST["action"]) {
            case "send_otp":
                
                $mobile_number = $_POST['mobile_number'];
                $message = "Your verification code for https://www.smsalert.co.in/ is [otp]";
                try{
                    $result = $smsalert->generateOtp($mobile_number,$message);
					if ($result['status'] == "success") {
						require_once ("verification-form.php");
                        exit();
					}
					else{
						$err_mesg = is_array($result['description']) ? $result['description']['desc'] : $result['description'];
						 echo json_encode(array("type"=>"error", "message"=>$err_mesg));
					}
                }catch(Exception $e){
                    die('Error: '.$e->getMessage());
                }
                break;
                
            case "verify_otp":
                $otp = $_POST['otp'];
				$mobile_number = $_POST['mobile_number'];
                $result   = $smsalert->validateOtp($mobile_number,$otp);
				if ($result['status'] == "success") {
					if($result['description']['desc']=='Code Matched successfully.')
					{
						echo json_encode(array("type"=>"success", "message"=>"Your mobile number is verified!"));
					}
				} else {
					 echo json_encode(array("type"=>"error", "message"=>"Mobile number verification failed"));;
				}
                break;
        }
    }
}
$controller = new Controller();
?>
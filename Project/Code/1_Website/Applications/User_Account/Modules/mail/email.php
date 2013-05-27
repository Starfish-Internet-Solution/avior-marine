<?php
require_once 'Project/Code/System/Settings/settings.php';

class email
{	
//-------------------------------------------------------------------------------------------------	
	
	public static function send_email($to_email, $to_name, $from_email, $from_name, $subject, $body, $attachment_path = '', $attachment_name = '')
	{
		$settings	= new settings();
		$settings->select();
		
		ini_set('SMTP', $settings->getHost());
		
		$from = $from_email;//$from_email;
		$to_email = $settings->getToEmail();
		
		$headers = "MIME-Version: 1.0\r\nContent-type: text/html\r\nFrom: $from";

		$success = @mail($to_email, $subject, $body, $headers);
		return $success;
	}
}
?>

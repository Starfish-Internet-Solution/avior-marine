<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Authorization/authorization.php';

class userSession extends authorization
{
	public static function saveApplicantSession($array_of_applicant_details, $phase) 
	{
		Zend_Session::regenerateId();
		Zend_Session::rememberMe(172800);
		
		$user_session = new Zend_Session_Namespace($phase);
		
		foreach($array_of_applicant_details as $field_name => $value)
			$user_session->{$field_name} = $value;
	}
	
	//---------------------------------------------------------------------------------------------------------
	
	public static function saveResumeSession($session_id, $original_filename, $path, $ext)
	{
		Zend_Session::regenerateId();
		Zend_Session::rememberMe(172800);
		
		$user_session = new Zend_Session_Namespace('resume');
				
		$user_session->session_id		 = $session_id;
		$user_session->original_filename = $original_filename;
		$user_session->path 			 = $path;
		$user_session->ext 				 = $ext;
	}
	
	//---------------------------------------------------------------------------------------------------------
	
	public static function isPhaseSessionSet($phase)
	{	
		if(array_key_exists($phase, self::getAllSession()))
			return true;
		else
			return false;
	}
	
	//---------------------------------------------------------------------------------------------------------
	
	public static function editPhaseSession($array_of_applicant_details, $phase)
	{
		unset($_SESSION[$phase]);
		self::saveApplicantSession($array_of_applicant_details, $phase);
	}
	
	//---------------------------------------------------------------------------------------------------------

	public static function getOneSession($phase, $key)
	{
		if(isset($_SESSION))
			return $_SESSION[$phase][$key];
		else
		{
			Zend_Session::start();
			return $_SESSION[$phase][$key];
		}
	}
	
	//---------------------------------------------------------------------------------------------------------
	
	public static function getAllSession()
	{
		if(isset($_SESSION))
			return $_SESSION;
		else
		{
			Zend_Session::start();
			return $_SESSION;
		}
	}
	
	//---------------------------------------------------------------------------------------------------------
	
	public static function getPhaseSession($phase)
	{
		if(isset($_SESSION))
			return $_SESSION[$phase];
		else
		{
			Zend_Session::start();
			return $_SESSION[$phase];
		}
	}

	
}
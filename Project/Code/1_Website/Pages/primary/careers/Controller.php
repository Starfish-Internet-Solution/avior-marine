<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');
require_once 'Project/Code/1_Website/Applications/User_Account/Modules/userSession.php';
require_once 'Project/Code/1_Website/Applications/User_Account/Modules/fileUpload.php';
require_once 'Project/Code/System/Applicants/certificates/certificates.php';
require_once 'Project/Code/System/Applicants/skills/skills.php';
require_once 'Project/Code/System/Applicants/applicant.php';

class controller extends controllerSuperClass_Core 
{
	
	public function indexAction()
	{
		$model = new model();
		$view = new view();
		
		$XML = $model->loadDataSimpleXML('data');
		$view->_XMLObj = $XML;
		
		$view->_set('array_of_jobs', $model->getPositions());
		$view->_set('array_of_images', $model->getImages());
		
		$view->displayQuickApplyForm();
		$view->renderAll();
	}
	
	//---------------------------------------------------------------------------------------------------------------------------
	
	public function sendmailAction()
	{
		require_once 'Project/Code/1_Website/Applications/User_Account/Modules/mail/email.php';
		
		$subject 	= "New Inquiry";
		$from_email = $_GET['email'];
		$body 		= "
						Full Name {$_GET['full_name']} <br />
						Rank {$_GET['rank']} <br />
						Date of Birth {$_GET['date_of_birth']} <br />
						Phone {$_GET['phone']} <br />
						Email {$_GET['email']} <br />
						Vessel Type {$_GET['vessel_type']} 
						<br />
						<br />
						<br />
						
						Comment:<br />
						{$_GET['comment']}
		
					";
		
		email::send_email('', '', $from_email, '', $subject, $body);
		jQuery::getResponse();
	}
	
	//---------------------------------------------------------------------------------------------------------------------------
	
	public function testAction()
	{
		print "<pre>";
		var_dump(userSession::getAllSession());
	}
	
	public function applyAction()
	{
		$view = new view();

		$phase	  = $this->getValueOfURLParameterPair('phase');
		$job_id   = $this->getValueOfURLParameterPair('job-id');

		//if there is a job_id in url the side tab will appear
		if($job_id)
		{
			/**
			 * @todo validation if job id exist
			 */
			$view->displayJobDescription();
			$view->_set('has_job_id', TRUE);
		}
			
		
		//switch the phase to display the right template
		switch ($phase)
		{
			case 1 :
				{
					//pass the value of phase information to the view
					if(userSession::isPhaseSessionSet('first_phase'))
						$view->_set('first_phase_array', userSession::getPhaseSession('first_phase'));
					
					$view->displayFirstPhaseApplication();
				}	break;
				
			case 2:
				{
					//get all certficates that will be displayed as checkbox
					$certificates = new certificates();
					$certificates->select();
					$array_of_certificates = $certificates->getCertificates();
					
					//pass the value of phase information to the view
					if(userSession::isPhaseSessionSet('second_phase'))
						$view->_set('second_phase_array', userSession::getPhaseSession('second_phase'));
					
					$view->_set('array_of_certificates', $array_of_certificates);
					$view->displaySecondPhaseApplication();
				}   break;
				
			case 3: 
				{
					//get all skills info that will displayed as checkbox
					$skills = new skills();
					$skills->select();
					$array_of_skills = $skills->getSkills();
					
					//pass the value of phase information to the view
					if(userSession::isPhaseSessionSet('third_phase'))
						$view->_set('third_phase_array', userSession::getPhaseSession('third_phase'));

					$view->_set('array_of_skills', $array_of_skills);
					$view->displayThirdPhaseApplication();
				}	break;
				
			case 4:
				{
					if(userSession::isPhaseSessionSet('fourth_phase'))
						$view->_set('fourth_phase_array', userSession::getPhaseSession('fourth_phase'));
					
					if(userSession::isPhaseSessionSet('fourth_phase'))
						$view->_set('service_count', userSession::getOneSession('fourth_phase', 'service_count'));
					
					$view->displayPopup();
					$view->displayFourthPhaseApplication();
				}	break;
			
			default: echo "error";
		}
		
		$view->displayApplicationMainContent();
	}
	
	//---------------------------------------------------------------------------------------------------------------------------

	public function saveSessionAction()
	{
		$applicant_info 	= $_POST;
		$phase 				= $_POST['phase'];
		$current_phase  	= $_POST['current_phase'];
		$action 			= $_POST['action'];
		
		//save the phase session if its not set
		//edit the session if it is already set
		if(!userSession::isPhaseSessionSet($phase))
		{
			//do this for the phase 1 only.. it is because of the file uploading
			if($current_phase == 1)
			{
				$upload = $this->saveResume($_FILES);
				/*
				 * @todo error handler if resume is not uploaded
				*/
				if($upload)
					userSession::saveApplicantSession($applicant_info, $phase);
			}
			else
				userSession::saveApplicantSession($applicant_info, $phase);
		}
		else
			userSession::editPhaseSession($applicant_info, $phase); 
		
		if($action == 'next')
			header("Location: /careers/apply/phase/".($current_phase + 1)."");
		else
			header("Location: /careers/apply/phase/".($current_phase - 1)."");
	}
	
	//---------------------------------------------------------------------------------------------------------------------------
	
	private function saveResume()
	{
		$path 			= STAR_SITE_ROOT."/Data/Applicants/temp_resume";
		$accepted_types = array(					
					'application/pdf',
					'application/msword',
					'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
					);
			
		$filename  		= $_FILES['resume']['name']; 
		$exploded_ext 	= explode(".", $_FILES['resume']['name']);
		$ext 			= $exploded_ext[count($exploded_ext) - 1];
		$path_name		= time()."_".$_FILES['resume']['name'];
			
		$success = fileUpload::upload($_FILES, $path, $path_name, 'resume', $accepted_types);
		
		if($success === TRUE)
		{
			userSession::saveResumeSession(time(), $filename, $path_name, $ext);
			return TRUE;
		}
		else
			return FALSE;
	}
	
	//---------------------------------------------------------------------------------------------------------------------------
	
	//this function will be call in the fourth phase of the application form
	public function saveAjaxSessionAction()
	{
		
		$applicant_info 	= $_POST;
		$phase 				= $_POST['phase'];
		$current_phase  	= $_POST['current_phase'];
	
		//save the phase session if its not set
		//edit the session if it is already set
		if(!userSession::isPhaseSessionSet($phase))
			userSession::saveApplicantSession($applicant_info, $phase);
		else
			userSession::editPhaseSession($applicant_info, $phase);
	
		jQuery::getResponse();
	}
	
	//---------------------------------------------------------------------------------------------------------------------------
	
	//this is an ajax call
	public function insertApplicationAction()
	{
		$applicant = new applicant();
		$applicant->insert();
		$applicant_id =  $applicant->getApplicantId();
		
		$model = new model();
		$model->insertFirstPhase($applicant_id, userSession::getPhaseSession('first_phase'));
		
		jQuery::getResponse();
	}
	
	
	
}
?>
<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');
require_once('Project/Code/System/Routes/route.php');

class controller extends controllerSuperClass_Core 
{
	public function indexAction()
	{
		$dataHandler = new dataHandler();
		$view = new view();
		$view->_XMLObj = $dataHandler->loadDataSimpleXML('Data/1_Website/Content/Pages/primary/careers/data.xml');
		
		$url_parameters = routes::getInstance()->_pathInfoArray;
		
		if(count($url_parameters) == 1){
			$this->careersListing();
		}
		if (count($url_parameters) == 2) {
			if(route::ifPermalinkExists($url_parameters[1])) {
				$this->careersDetails($url_parameters[1]);
			} else {
				header('location: /careers');
			}
		}
		if (count($url_parameters) > 2) {
			header('location: /careers');
		}
	}
	public function careersListing() {
		require_once 'Project/Code/System/Job_Manager/jobs.php';
	
		$jobs = new jobs();
		$jobs->select();
		$array_of_jobs = $jobs->getArrayOfJobs();
		
		$view = new view();
		$view->_set('array_of_jobs', $array_of_jobs);
		$view->displayCareersListing();
	}	
	public function careersDetails($permalink = NULL) {
		require_once 'Project/Code/System/Job_Manager/job.php';
		
		$job = new job();
		$job->setPermalink($permalink);
		$job->select();
		
		$view = new view();
		$view->_set('jobs', $job);
		$view->displayAppForm();
	}	
	public function	submitApplicationAjaxAction() {
		$name = $_REQUEST['name'];
		$desiredPosition = $_REQUEST['desiredPosition'];
		$mobile = $_REQUEST['mobile'];
		$email = $_REQUEST['email'];
		$message = $_REQUEST['message'];
		
		$body = "
					Name: $name
					
					Desired Position: $desiredPosition
		
					Contact Number: $mobile
					
					Email Address: $email
					
					Message: $message
				";
		
		//mail('jephjeph02@gmail.com', 'New inquiry received', $body, 'New inquiry received');
		mail('joseph.reyes@starfi.sh', 'New inquiry received', $body, 'New inquiry received');
		jQuery::getResponse();		
	}
}
?>
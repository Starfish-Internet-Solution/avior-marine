<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'job_managerView.php';
require_once 'Project/Code/System/Job_Manager/jobs.php';
require_once 'Project/Code/System/Job_Manager/job.php';
require_once 'Project/Code/System/Routes/route.php';

class job_managerController extends applicationsSuperController
{
	public function indexAction()
	{
		$view = new job_managerView();
		
		//select all jobs
		$jobs = new jobs();
		$jobs->select();
		
		$view->_set('array_of_jobs', $jobs->getArrayOfJobs());
		$view->displayApplicationContent();
	}
	
//--------------------------------------------------------------------------------------------------------------

	public function addAction()
	{
		$route			= new route();
		//insert routing details
		if($route->ifPermalinkExists($this->replaceChars($_POST['title'])) == 1) {
			header('Location: /'.$this->currentPage);
		} else {
			$route->__set('permalink', $this->replaceChars($_POST['title']));
			$route->insert();
		}	
			
		$job = new job();
		$job->setTitle($_POST['title']);
		$job->setRouteId($route->__get('route_id'));
		$job->setDescription($_POST['description']);
		$job->setIsPublished(0);
		$job->setDatePublished("");		
	    $job->insert();
		
	    //get the last insert id to create job_control_number
		$last_insert_id = $job->getLastInsertID();
		
		//create the job control number
		$job_control_number = str_pad($last_insert_id, 3, '0', STR_PAD_LEFT);
		$job_control_number .= chr(97 + mt_rand(0, 25)) . chr(97 + mt_rand(0, 25)) . chr(97 + mt_rand(0, 25));
		
		//update the job control number
		$job->setJobID($last_insert_id);
		$job->updateOneColumn('job_control_number', $job_control_number);
		
		header("Location: /job-manager");
	}
	
//--------------------------------------------------------------------------------------------------------------

	public function editAction()
	{
		$job_id = $this->getValueOfURLParameterPair('job_id');
		
		$job = new job();
		$job->setJobID($job_id);
		$job->setTitle($_POST['title']);
		$job->setDescription($_POST['description']);
		$job->setDatePublished($_POST['date_published']);
		$job->update();
		
		header("Location: /job-manager");
		
	}
	
//--------------------------------------------------------------------------------------------------------------
	
	public function deleteAction()
	{
		$job_id = $this->getValueOfURLParameterPair('job_id');
		
		$job = new job();
		$route = new route();
		
		$job->setJobID($job_id);
		$job->select();
		
		$route->__set('route_id', $job->getRouteId());
		$route->delete();
		
		$job->delete();
		
		header("Location: /job-manager");
	}
	
	
//--------------------------------------------------------------------------------------------------------------
	
	public function filterAction()
	{
		$jobs = new jobs();
		$view = new job_managerView();
		
		if($_POST['title_filter'] != "" && $_POST['date_published_filter'] != "")
		{
			//select by title and date
			$jobs->selectByFilter(array('title', $_POST['title_filter']), $_POST['date_published_filter']);
				
			$view->_set('array_of_jobs', $jobs->getArrayOfJobs());
			$view->displayApplicationContent();
		
		}
		elseif($_POST['title_filter'] != "")
		{
			
			//use an array for the parameters of this function.. first index is the column second index is the value
			$jobs->selectByFilter(array('title', $_POST['title_filter']));
		
			$view->_set('array_of_jobs', $jobs->getArrayOfJobs());
			$view->displayApplicationContent();
			
		}
		elseif($_POST['date_published_filter'] != "")
		{
			
			//use an array for the parameters of this function.. first index is the column second index is the value
			$jobs->selectByFilter(null, $_POST['date_published_filter']);
			
			$view->_set('array_of_jobs', $jobs->getArrayOfJobs());
			$view->displayApplicationContent();
		}
	}

	private function replaceChars($permalink)
	{
		$characters = array(' ','_',',','\'','.',':',';','?','!');
	
		$string = strtolower(str_replace($characters, '-', $permalink));
	
		return trim($string, '-');
	}	
}



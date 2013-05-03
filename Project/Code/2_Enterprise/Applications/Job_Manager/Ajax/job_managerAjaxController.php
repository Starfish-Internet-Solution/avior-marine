<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'Project/Code/System/Job_Manager/job.php';

class job_managerAjaxController extends applicationsSuperController
{
	public function updatePublishedJobAction()
	{
		$is_published  = $_REQUEST['is_published'];
		$job_id = $_REQUEST['job_id'];
		
		$job = new job();
		$job->setJobID($job_id);
		
		
		if($is_published == 0)
		{
			$job->updateOneColumn('date_published', date('Y-m-d', time()));
			$status = 1;
		}	
		else
			$status = 0;
		
	
		$job->updateOneColumn('is_published', $status);
		jQuery::getResponse();
	}
}
<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');

class view extends viewSuperClass_Core 
{
	public function getAccessKeys()
	{
		return '%%ACCESSKEYS%%';
	}
	
	public function getAccessKeysPartTwo($accesskeys)
	{
		$content  = '';
		$content .='<ul class="mBl">';
		foreach ($accesskeys as $key=>$value)
		{
			$content.=	'<li><strong>'.$key.'</strong> - '.ucfirst($value['content']).'</li>';
		}
		$content .='</ul>';
		 
		response::getInstance()->addContentToTree(array('ACCESSKEYS'=>$content));
	}
}
?>
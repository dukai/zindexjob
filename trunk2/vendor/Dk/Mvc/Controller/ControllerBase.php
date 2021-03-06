<?php

/*
 * Controller Base
 */
 
namespace Dk\Mvc\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;

class ControllerBase extends AbstractActionController{
	
	protected $adapter;
	
	public function getConfig(){
		$event = $this->event;
		$app = $event->getApplication();
		
		return $app->getConfig();	
	}
	
	protected function getAdapter(){
		if(empty($this->adapter)){
			$this->adapter = $this->getServiceLocator()->get("Zend/Db/Adapter/Adapter"); 
		}
		return $this->adapter;
	}
	
	public function getService($name){
		if($this->getServiceLocator()->has($name)){
			return $this->getServiceLocator()->get($name);
		}else{
			return null;
		}
	}
	
	protected function pager($currpage, $perpage, $nums, $q, $currPageStyle='', $othersPageStyle='',$dp = 10){
		$nums = intval($nums);
		$maxPages = ceil($nums/$perpage);
		$pageStart=1;
		if ($maxPages==0) {
			$maxPages = 1;
		}
		if ($currpage>$maxPages) {
			$currpage=$maxPages;
		}
		$s = "<ul><li><a href=\"".str_replace('{page}', 1, $q)."\"><i class=\"icon-step-backward\"></i></a></li>";
		if ($currpage<=1) {
			$s .= "<li><span class=\"{$currPageStyle}\"><i class=\"icon-chevron-left\"></i></span></li>";
			$pageStart = 1;
			$currpage=1;
			$pageEnd=$dp;
		} else {
			$tmp = $currpage-1;
			$s .= "<li><a href=\"".str_replace('{page}', $tmp, $q)."\" class=\"{$othersPageStyle}\"><i class=\"icon-chevron-left\"></i></a></li>";
			/*** 下面开始计算 1--$dp 以后的 $pageStart ***/
			$rangeOrder = floor(($currpage-2)/($dp-2));
			$pageStart = $rangeOrder*($dp-2)+1;
			$pageEnd=$pageStart+$dp-1;
		}
	
		for ($i=$pageStart; $i<=$pageEnd; $i++) {
			if ($i>$maxPages) {
				break;
			}
			if ($i!=$currpage) {
				$s.= '<li><a href="'.str_replace('{page}', $i, $q).'" class="'.$othersPageStyle.'">'.$i.'</a></li>';
			}
			else {
				$s.= '<li><span class="'.$currPageStyle.'">'.$i.'</span></li>';
			}
		}
	
		if ($currpage>=$maxPages) {
			$s.= "<li><span class=\"{$currPageStyle}\"><i class=\"icon-chevron-right\"></i></span></li>";
		} else {
			$tmp = $currpage+1;
			$s.= "<li><a href=\"".str_replace('{page}', $tmp, $q)."\" class=\"{$othersPageStyle}\"><i class=\"icon-chevron-right\"></i></a></li>";
		}
		
		$s .= "<li><a href=\"".str_replace('{page}', $maxPages, $q)."\"><i class=\"icon-step-forward\"></i></a></li></ul>";
		return $s;
	}
	
}




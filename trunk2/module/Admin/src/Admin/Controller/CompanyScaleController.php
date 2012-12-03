<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Dk\Mvc\Controller\ControllerBase;

class CompanyScaleController extends ControllerBase{
	public function indexAction(){
		$page = intval($this->params('page', 1));
		$take = 30;
		$start = $take * ($page - 1);
		
		$companyScale = $this->getService('Job\Model\CompanyScale');
		$total = $companyScale->getCount();
		
		$companyScales = $companyScale->getCompanyScales($take, $start);
		$pager = $this->pager($page, $take, $total, '/admin/company-scale?page={page}');
		
		$view = new ViewModel(array(
			'scales' => $companyScales,
			'pager' => $pager,
		));
		return $view;
	}
	
	public function createAction(){
		$request = $this->getRequest();
		$companyScale = $this->getService('Job\Model\CompanyScale');
		if($request->isPost()){
			$companyScale->simpleInsert($request->getPost()->getArrayCopy());
			$this->flashMessenger()->addMessage('创建成功！');
			return $this->redirect()->toUrl('/admin/company-scale/create');
		}else{
			$returnArray = array(
			);
			if($this->flashMessenger()->hasMessages()){
				$returnArray['messages'] = $this->flashMessenger()->getMessages();
			}
			
			return new ViewModel($returnArray);
		}
	}
}
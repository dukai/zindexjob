<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Dk\Mvc\Controller\ControllerBase;

class CompanyIndustryController extends ControllerBase{
	
	public function indexAction(){
		$page = intval($this->params('page', 1));
		$take = 30;
		$start = $take * ($page - 1);
		
		$model = $this->getService('Job\Model\CompanyIndustry');
		$total = $model->getCount();
		
		$companyIndustrys = $model->getCompanyIndustry($take, $start);
		$pager = $this->pager($page, $take, $total, '/admin/company-industry?page={page}');
		
		$view = new ViewModel(array(
			'industrys' => $companyIndustrys,
			'pager' => $pager,
		));
		return $view;
	}
	
	public function createAction(){
		$request = $this->getRequest();
		$model = $this->getService('Job\Model\CompanyIndustry');
		if($request->isPost()){
			$model->simpleInsert($request->getPost()->getArrayCopy());
			$this->flashMessenger()->addMessage('创建成功！');
			return $this->redirect()->toUrl('/admin/company-industry/create');
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

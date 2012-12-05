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
		
		$companyIndustrys = $model->getCompanyIndustries($take, $start);
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
	
	public function editAction(){
		$id = intval($this->params()->fromQuery('id', 0));
		$request = $this->getRequest();
		
		$model = $this->getService('Job\Model\CompanyIndustry');
		if($request->isPost()){
			$model->simpleUpdate($request->getPost()->getArrayCopy(), array('id'=>$id));
			$this->flashMessenger()->addMessage('创建成功！');
			return $this->redirect()->toUrl('/admin/company-industry/edit?id=' . $id);
		}else{
			$industry = $model->getCompanyIndustry($id);
			$returnArray = array(
				'industry' => $industry,
			);
			if($this->flashMessenger()->hasMessages()){
				$returnArray['messages'] = $this->flashMessenger()->getMessages();
			}
			
			return new ViewModel($returnArray);
		}
	}
	
	public function deleteAction(){
		$id = intval($this->params()->fromQuery('id', 0));
		$model = $this->getService('Job\Model\CompanyIndustry');
		$model->simpleDelete(array('id' => $id));
		return $this->redirect()->toUrl('/admin/company-industry');
	}
}

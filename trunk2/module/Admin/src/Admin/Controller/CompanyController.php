<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Dk\Mvc\Controller\ControllerBase;
use Job\Model\Company;
use Zend\Db\Adapter\Adapter;

class CompanyController extends ControllerBase{
	
	
	public function indexAction(){
		$page = intval($this->params('page', 1));
		$take = 30;
		$start = $take * ($page - 1);
		
		$adapter = $this->getAdapter();
		$company = new Company($adapter);
		
		$total = $company->getCount();
		$result = $company->getCompanies($take, $start);
		$pager = $this->pager($page, $take, $total, '/admin/company?page={page}');
		
		$view = new ViewModel(array(
			'companies' => $result,
			'pager' => $pager,
		));
		return $view;
	}
	
	public function createAction(){
		$request = $this->getRequest();
		if($request->isPost()){
			
			$company = new Company($this->getAdapter());
			$company->simpleInsert($request->getPost()->getArrayCopy());
			$this->flashMessenger()->addMessage('创建成功！');
			return $this->redirect()->toUrl('/admin/company/create');
		}else{
			$csModel = $this->getService('Job\Model\CompanyScale');
			$scales = $csModel->getCompanyScales();
			$cNModel = $this->getService('Job\Model\CompanyNature');
			$natures = $cNModel->getCompanyNatures();
			$cIModel = $this->getService('Job\Model\CompanyIndustry');
			$industries = $cIModel->getCompanyIndustries();
			
			$returnArray = array(
				'natures' => $natures,
				'scales' => $scales,
				'industries' => $industries,
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
		$companyM = $this->getService('Job\Model\Company');
		if($request->isPost()){
			$companyM->simpleUpdate($request->getPost()->getArrayCopy(), array('company_id' => $id));
			$this->flashMessenger()->addMessage('编辑成功！');
			return $this->redirect()->toUrl('/admin/company/edit?id=' . $id);
		}else{
			$csModel = $this->getService('Job\Model\CompanyScale');
			$scales = $csModel->getCompanyScales();
			$cNModel = $this->getService('Job\Model\CompanyNature');
			$natures = $cNModel->getCompanyNatures();
			$cIModel = $this->getService('Job\Model\CompanyIndustry');
			$industries = $cIModel->getCompanyIndustries();
			$returnArray = array(
				'natures' => $natures,
				'scales' => $scales,
				'industries' => $industries,
				'company' => $companyM->getCompany($id),
			);
			if($this->flashMessenger()->hasMessages()){
				$returnArray['messages'] = $this->flashMessenger()->getMessages();
			}
			return  new ViewModel($returnArray);
		}
	}

	public function deleteAction(){
		$id = intval($this->params()->fromQuery('id', 0));
		
		$companyModel = $this->getService('Job\Model\Company');
		$companyModel->simpleDelete(array('company_id'=>$id));
		return $this->redirect()->toUrl('/admin/company');
		
		//TODO: 删除相关信息
	}
}

<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Dk\Mvc\Controller\ControllerBase;

class ContactUserController extends ControllerBase{
	
	public function createAction(){
		$request = $this->getRequest();
		$cuModel = $this->getService('Job\Model\ContactUser');
		if($request->isPost()){
			$data = $request->getPost()->getArrayCopy();
			$data['created_time'] = date("Y-m-d H:i:s");
			$result = $cuModel->simpleInsert($data);
			$cuid = $cuModel->getLastId();
			$companyId = intval($this->params()->fromPost('company_id', 0));
			$cuModel->addCompanyRel($companyId, $cuid);
			$this->flashMessenger()->addMessage('创建成功！');
			return $this->redirect()->toUrl('/admin/contact-user/create');
		}else{
			$companyModel = $this->getService('Job\Model\Company');
			$companies = $companyModel->getCompanies();
			$returnArray = array(
				'companies' => $companies,
			);
			if($this->flashMessenger()->hasMessages()){
				$returnArray['messages'] = $this->flashMessenger()->getMessages();
			}
			
			return new ViewModel($returnArray);
		}
	}
	
	public function indexAction(){
		
		$page = intval($this->params('page', 1));
		$take = 30;
		$start = $take * ($page - 1);
		
		$model = $this->getService('Job\Model\ContactUser');
		$total = $model->getCount();
		
		$users = $model->getUsers($take, $start);
		$pager = $this->pager($page, $take, $total, '/admin/contact-user?page={page}');
		
		$view = new ViewModel(array(
			'users' => $users,
			'pager' => $pager,
		));
		return $view;
	}
	
	public function editAction(){
		$id = intval($this->params()->fromQuery('id'));
		
		$request = $this->getRequest();
		$cuModel = $this->getService('Job\Model\ContactUser');
		if($request->isPost()){
			$result = $cuModel->simpleUpdate($request->getPost()->getArrayCopy(), array('uid' => $id));
			$cuid = $cuModel->getLastId();
			$companyId = intval($this->params()->fromPost('company_id', 0));
			$cuModel->addCompanyRel($companyId, $cuid);
			$this->flashMessenger()->addMessage('创建成功！');
			return $this->redirect()->toUrl('/admin/contact-user/edit?id=' . $id);
		}else{
			$companyModel = $this->getService('Job\Model\Company');
			$companies = $companyModel->getCompanies();
			$user = $cuModel->getContactUser($id);
			$returnArray = array(
				'companies' => $companies,
				'user' => $user,
			);
			if($this->flashMessenger()->hasMessages()){
				$returnArray['messages'] = $this->flashMessenger()->getMessages();
			}
			
			return new ViewModel($returnArray);
		}
	}
	
	public function deleteAction(){
		$id = intval($this->params()->fromQuery('id'));
		
		$cuModel = $this->getService('Job\Model\ContactUser');
		$cuModel->simpleDelete(array('uid' => $id));
		return $this->redirect()->toUrl('/admin/contact-user');
	}
}

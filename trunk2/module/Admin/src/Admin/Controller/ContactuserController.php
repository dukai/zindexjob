<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;
use Dk\Mvc\Controller\ControllerBase;

class ContactUserController extends ControllerBase{
	
	public function createAction(){
		
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
}

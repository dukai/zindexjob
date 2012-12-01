<?php

namespace Auth\Controller;

use Dk\Mvc\Controller\ControllerBase;
use Zend\View\Model\ViewModel;

class AuthController extends ControllerBase{
	public function loginAction(){
		$request = $this->getRequest();
		
		if($request->isPost()){
			
		}else{
			
		}
		
		return new ViewModel(array());
	}
	
	public function logoutAction(){
		
	}
}

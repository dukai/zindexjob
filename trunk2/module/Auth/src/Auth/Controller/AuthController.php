<?php

namespace Auth\Controller;

use Dk\Mvc\Controller\ControllerBase;
use Dk\RevCrypt;
use Zend\View\Model\ViewModel;

class AuthController extends ControllerBase{
	public function loginAction(){
		$request = $this->getRequest();
		if($request->isPost()){
			$username = $this->params()->fromPost('username', '');
			$password = $this->params()->fromPost('password', '');
			
			$memberModel = $this->getService('Auth/Model/Member');
			if(empty($username)){
				$this->flashMessenger()->addMessage('用户名为空！');
				return $this->redirect()->toUrl('/login');
			}
			
			if(empty($password)){
				$this->flashMessenger()->addMessage('密码为空！');
				return $this->redirect()->toUrl('/login');
			}
			if(!$memberModel->checkExistByUsername($username)){
				$this->flashMessenger()->addMessage('用户名密码错误1！');
				return $this->redirect()->toUrl('/login');
			}
			
			if(!$memberModel->checkPassword($password)){
				$this->flashMessenger()->addMessage('用户名密码错误2！');
				return $this->redirect()->toUrl('/login');
			}
			$member = $memberModel->getCurrentMember();
			$config = $this->getConfig();
			$secretKey = $config['secretkey'];
			$cookieDomain = $config['cookiedomain'];
			
			$cookieTimes = array('session'=>0,'week'=>3600*24*7,'month'=>3600*24*30);
			$cookieType = '';
			if(!array_key_exists($cookieType, $cookieTimes)){
				$cookieType = 'month';
			}
			$cookieTime = $cookieTimes[$cookieType];
			$cookieTime = $cookieTime == 0 ? 0 : (time() + intval($cookieTime));
			
			$userInfo = array('uid'=>$member->uid, 'password'=>$member->password);
			setCookie('auth', RevCrypt::encode(json_encode($userInfo), $secretKey), $cookieTime, '/', $cookieDomain);
			$this->getEvent()->getApplication()->getServiceManager()->setService('loginMember', $member);			$this->flashMessenger()->addMessage('登录成功！');
			return $this->redirect()->toUrl('/login');
			
		}else{
			$returnArray =  array();
			if($this->flashMessenger()->hasMessages()){
				$returnArray['messages'] = $this->flashMessenger()->getMessages();
			}
			
			$returnArray['member'] = $this->getService('loginMember');
			
			return $returnArray;
		}
		
		
	}
	
	public function logoutAction(){
		
	}
}

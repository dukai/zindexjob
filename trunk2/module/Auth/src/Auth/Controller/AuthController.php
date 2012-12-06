<?php

namespace Auth\Controller;

use Dk\Mvc\Controller\ControllerBase;
use Dk\RevCrypt;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Auth\Model\Member;

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
				$this->flashMessenger()->addMessage('用户名密码错误！');
				return $this->redirect()->toUrl('/login');
			}
			
			if(!$memberModel->checkPassword($password)){
				$this->flashMessenger()->addMessage('用户名密码错误！');
				return $this->redirect()->toUrl('/login');
			}
			$member = $memberModel->getCurrentMember();
			if(!$member->valid){
				$this->flashMessenger()->addMessage('用户已停用！');
				return $this->redirect()->toUrl('/login');
			}
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
			$session = new Container();
			$session->offsetSet(Member::AUTH_MEMBER_SESSION_NAME, $member);
			$this->getEvent()->getApplication()->getServiceManager()->setService('loginMember', $member);
			$this->flashMessenger()->addMessage('登录成功！');
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
		$config = $this->getConfig();
		$cookieDomain = $config['cookiedomain'];
		setCookie('auth', '', time()-1, '/', $cookieDomain);
		$session = new Container();
		
		$session->offsetUnset(Member::AUTH_MEMBER_SESSION_NAME);
		return $this->redirect()->toUrl('/job');
	}
	
	public function registAction(){
		$memberModel = $this->getService('Auth/Model/Member');
		
		$memberModel->save(array());
		$request = $this->getRequest();
		
		if($request->isPost()){
			$data = $request->getPost()->getArrayCopy();
			
			if(empty($data['email'])){
				$this->flashMessenger()->addMessage('电子邮箱不能为空');
				return $this->redirect()->toUrl('/regist');
			}
			
			if(empty($data['username'])){
				$this->flashMessenger()->addMessage('用户名不能为空');
				return $this->redirect()->toUrl('/regist');
			}
			
			if(empty($data['password'])){
				$this->flashMessenger()->addMessage('密码不能为空');
				return $this->redirect()->toUrl('/regist');
			}
			
			if(empty($data['repassword'])){
				$this->flashMessenger()->addMessage('重复密码不能为空');
				return $this->redirect()->toUrl('/regist');
			}
			
			if($data['password'] != $data['repassword']){
				$this->flashMessenger()->addMessage('密码不匹配');
				return $this->redirect()->toUrl('/regist');
			}
			
			
			$memberModel = $this->getService('Auth/Model/Member');
			$data['created_time'] = date("Y-m-d H:i:s");
			
			$memberModel->save($data);
			
			$this->flashMessenger()->addMessage('注册成功！');
			return $this->redirect()->toUrl('/login');
			
		}else{
			
		}
	}
}

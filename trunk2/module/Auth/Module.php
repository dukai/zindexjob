<?
namespace Auth;
use Zend\Mvc\MvcEvent;
use Dk\RevCrypt;
use Zend\Session\Container;
use Auth\Model\Member;
class Module {
	
	public function onBootstrap($e){
		$app = $e->getParam('application');
		$app->getEventManager()->attach('dispatch', array($this, 'preDispatch'), 100);
		$app->getEventManager()->attach('dispatch', array($this, 'setLayout'), -100);
		$app->getEventManager()->attach(MvcEvent::EVENT_RENDER, array($this, 'setUserToView'), 100);
	}
	
	public function preDispatch($e){
		$matches    = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
		$pieces = explode('\\', $controller);
		$moduel = $pieces[0];
		$action = $matches->getParam('action');
		
		$member = $this->getAuthMember($e);
		
		if($moduel == 'Admin' && empty($member)){
		 	$url = $e->getRouter()->assemble(array(), array('name' => 'auth_login'));
            $response = $e->getResponse();
            $response->getHeaders()->addHeaderLine('Location', $url);
            $response->setStatusCode(302);
            $response->sendHeaders();
            exit;
		}
		
	}


	private function getAuthMember($event){
		$session = new Container();
		$member = array();
		if($session->offsetExists(Member::AUTH_MEMBER_SESSION_NAME)){
			$member = $session->offsetGet(Member::AUTH_MEMBER_SESSION_NAME);
		}
		
		if(empty($member) && !empty($_COOKIE['auth'])){
			$app = $event->getApplication();
			$sm = $app->getServiceManager();
			$config = $app->getConfig();
			$secretKey = $config['secretkey'];
			
			$authStr = RevCrypt::decode($_COOKIE['auth'], $secretKey);
			$auths = json_decode($authStr,true);
			
			if(!empty($auths) && is_array($auths) && array_key_exists('uid',$auths) && array_key_exists('password',$auths)){
				$memberModel = $sm->get('Auth\Model\Member');
				if($memberModel->checkExistByUid($auths['uid']) && $memberModel->checkPassword($auths['password'], FALSE)){
					$member = $memberModel->getCurrentMember();
				}
			}
			
			$session->offsetSet(Member::AUTH_MEMBER_SESSION_NAME, $member);
		}
		
		return $member;
	}
	
	public function setLayout($e){
		$matches    = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
        if (0 !== strpos($controller, __NAMESPACE__, 0)) {
            // not a controller from this module
            return;
        }

        $viewModel = $e->getViewModel();
        $viewModel->setTemplate('layout/auth');
	}
	
	public function setUserToView($e){
		$member = $this->getAuthMember($e);
        $viewModel = $e->getViewModel();
        $viewModel->setVariables(array(
            'member' => $member,
        ));
	}
	
	public function getConfig() {
		return	include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php', 
			),
			 
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__, 
				), 
			), 
		);
	}
	
	public function getServiceConfig()
    {
        return array(
            'factories' => array(
				'Auth\Model\Member' => function($sm){
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					return new \Auth\Model\Member($dbAdapter);
				},
				
            ),
        );
	}
}

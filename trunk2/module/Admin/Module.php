<?
namespace Admin;

class Module {
	
	public function onBootstrap($e){
		$app = $e->getParam('application');
		$app->getEventManager()->attach('dispatch', array($this, 'setLayout'), -100);
	}
	
	public function setLayout($e){
		$matches    = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
        if (0 !== strpos($controller, __NAMESPACE__, 0)) {
            // not a controller from this module
            return;
        }

        $viewModel = $e->getViewModel();
        $viewModel->setTemplate('layout/admin');
	}
	
	public function getConfig() {
		return
		include __DIR__ . '/config/module.config.php';
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
				'Job\Model\JobCategory' => function($sm){
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					return new \Job\Model\JobCategory($dbAdapter);
				},
				'Job\Model\CompanyScale' => function($sm){
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					return new \Job\Model\CompanyScale($dbAdapter);
				},
				
				'Job\Model\CompanyNature' => function($sm){
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					return new \Job\Model\CompanyNature($dbAdapter);
				},
				
				'Job\Model\CompanyIndustry' => function($sm){
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					return new \Job\Model\CompanyIndustry($dbAdapter);
				},
				
				'Job\Model\ContactUser' => function($sm){
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					return new \Job\Model\ContactUser($dbAdapter);
					
				},
				'Job\Model\Company' => function($sm){
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					return new \Job\Model\Company($dbAdapter);
					
				},
				
            ),
        );
    }

}

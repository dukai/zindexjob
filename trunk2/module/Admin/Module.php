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

}

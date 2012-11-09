<?

namespace Admin\Controller;

use Dk\Mvc\Controller\ControllerBase;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;


class IndexController extends ControllerBase{
	public function indexAction(){
		$view = new ViewModel(array());
		return $view;
	}
}

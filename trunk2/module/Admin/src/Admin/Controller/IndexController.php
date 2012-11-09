<?

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
class IndexController extends AbstractActionController{
	public function indexAction(){
		$view = new ViewModel(array());
		return $view;
	}
}

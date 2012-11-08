<?

namespace Job\Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
class IndexController extends AbstractActionController{
	
	public function IndexAction(){
		exit("hello admin");
	}
}
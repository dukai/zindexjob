<?

namespace Admin\Controller;

use Dk\Mvc\Controller\ControllerBase;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use Job\Model\JobCategory;

class JobCategoryController extends ControllerBase{
	public function indexAction(){
		
		$page = intval($this->params('page', 1));
		$take = 30;
		$start = $take * ($page - 1);
		
		$adapter = $this->getAdapter();
		$jobCategory = new JobCategory($adapter);
		$total = $jobCategory->getCount();
		
		$jobCategories = $jobCategory->getJobCategories($take, $start);
		$pager = $this->pager($page, $take, $total, '/admin/job-category?page={page}');
		
		$view = new ViewModel(array(
			'companies' => $jobCategories,
			'pager' => $pager,
		));
		return $view;
	}
	
	public function createAction(){
		
		$request = $this->getRequest();
		$jobCategory = $this->getService('Job\Model\JobCategory');
		if($request->isPost()){
			$jobCategory->simpleInsert($request->getPost()->getArrayCopy());
			$this->flashMessenger()->addMessage('创建成功！');
			return $this->redirect()->toUrl('/admin/job-category/create');
		}else{
			$returnArray = array(
			);
			if($this->flashMessenger()->hasMessages()){
				$returnArray['messages'] = $this->flashMessenger()->getMessages();
			}
			
			return new ViewModel($returnArray);
		}
		
	}
	
	public function editAction(){
		
	}
	
	public function deleteAction(){
		
	}
}

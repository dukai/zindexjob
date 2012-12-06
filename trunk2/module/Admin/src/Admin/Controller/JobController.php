<?

namespace Admin\Controller;

use Dk\Mvc\Controller\ControllerBase;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use Job\Model\Company;
use Job\Model\JobCategory;
use Job\Model\Job;

class JobController extends ControllerBase{
	public function indexAction(){
		
		$page = intval($this->params('page', 1));
		$take = 30;
		$start = $take * ($page - 1);
		
		$adapter = $this->getAdapter();
		$job = new Job($adapter);
		
		$total = $job->getCount();
		$result = $job->getJobs($take, $start);
		$pager = $this->pager($page, $take, $total, '/admin/job?page={page}');
		
		$view = new ViewModel(array(
			'companies' => $result,
			'pager' => $pager,
		));
		return $view;
	}
	
	public function createAction(){
		
		$request = $this->getRequest();
		if($request->isPost()){
			
			$job = new Job($this->getAdapter());
			$data = $request->getPost()->getArrayCopy();
			$data['created_time'] = date("Y-m-d H:i:s");
			$job->simpleInsert($data);
			$this->flashMessenger()->addMessage('创建成功！');
			return $this->redirect()->toUrl('/admin/job/create');
		}else{
			$company = new Company($this->getAdapter());
			$jobcategory = new JobCategory($this->getAdapter());
			$companies = $company->getCompanies();
			$jobCategories = $jobcategory->getJobCategories();
			
			$returnArray = array(
				'companies' => $companies,
				'jobCategories' => $jobCategories,
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

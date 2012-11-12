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
		$total = $adapter->query("select count(*) from jobs", Adapter::QUERY_MODE_EXECUTE)->count();
		$result = $adapter->query("select j.*, c.name as company_name, jc.name as jc_name from jobs as j left join companies as c on j.company_id=c.company_id left join job_categories as jc on jc.jc_id=j.jc_id limit {$start},{$take}", Adapter::QUERY_MODE_EXECUTE);
		$pager = $this->pager($page, $take, $total, 'job-manage.php?page={page}');
		
		$view = new ViewModel(array(
			'companies' => $result->toArray(),
			'pager' => $pager,
		));
		return $view;
	}
	
	public function createAction(){
		
		$request = $this->getRequest();
		if($request->isPost()){
			
			$job = new Job($this->getAdapter());
			$job->simpleInsert($request->getPost()->getArrayCopy());
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

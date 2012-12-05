<?

namespace Job\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
class IndexController extends AbstractActionController{
	public function indexAction(){
		$sm = $this->getServiceLocator();
		$adapter = $sm->get("Zend\Db\Adapter\Adapter");
		$result = $adapter->query("select * from companies", Adapter::QUERY_MODE_EXECUTE);
		//print_r($result->current());
		$companies = array();
		
		while($c = $result->current()){
			$companies[] = $c;
		}
		$companyIds = array();
		foreach ($companies as $key => $value) {
			$companyIds[] = $value['company_id'];
		}
		
		$idstring = implode("','", $companyIds);
		$idstring = "'" . $idstring . "'";
		$result = $adapter->query("select * from jobs where company_id in ({$idstring})", Adapter::QUERY_MODE_EXECUTE);
		$contactUsers = $adapter->query("select c.*, r.company_id as company_id from contact_users as c left join company_contactuser_rel as r on c.uid=r.uid where r.company_id in ({$idstring})", Adapter::QUERY_MODE_EXECUTE)->toArray();
		//$jobs = $result->toArray();
		$jobs = array();
		while($c = $result->current()){
			$jobs[] = $c;
		}
		
		
		$tjobs = array();
		foreach($jobs as $key => $value){
			if(!isset($tjobs[$value['company_id']])){
				$tjobs[$value['company_id']] = array();
			}
			$tjobs[$value['company_id']][] = $value;
		}
		
		$tusers = array();
		
		foreach($contactUsers as $key=>$value){
			if(!isset($tusers[$value['company_id']])){
				$tusers[$value['company_id']] = array();
			}
			$tusers[$value['company_id']][] = $value;
		}
		return new ViewModel(array(
			'companies' => $companies,
			'tjobs' => $tjobs,
			'tusers' => $tusers,
		));
	}
}

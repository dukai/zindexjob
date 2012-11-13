<?

namespace Job\Model;

use Dk\Mvc\Model\ModelBase;
class Job extends ModelBase{
	
	const TABLE_NAME = 'jobs';
	
	public function __construct($adapter){
		parent::__construct($adapter, self::TABLE_NAME);
	}
	
	
	public function getJobs($take = -1, $start = 0){
		$limit = "";
		
		if($take > 0){
			$limit = " limit {$start}, {$take}";
		}
		
		$sql = "select j.*, c.name as company_name, jc.name as jc_name from jobs as j left join companies as c on j.company_id=c.company_id left join job_categories as jc on jc.jc_id=j.jc_id" . $limit;
		
		return $this->simpleFetch($sql);
	}
}

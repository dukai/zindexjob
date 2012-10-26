<?

namespace Application\Model;

use Lib\ModelBase;

class Job extends ModelBase{
	
	public function __construct($adapter){
		parent::__construct('jobs', 'job_id', $adapter);
	}
}

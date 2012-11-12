<?

namespace Job\Model;

use Dk\Mvc\Model\ModelBase;
class Job extends ModelBase{
	
	const TABLE_NAME = 'jobs';
	
	public function __construct($adapter){
		parent::__construct($adapter, self::TABLE_NAME);
	}
	
}

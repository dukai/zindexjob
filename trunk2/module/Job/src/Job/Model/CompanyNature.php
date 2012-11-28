<?php
namespace Job\Model;

use Dk\Mvc\Model\ModelBase;

class CompanyNature extends ModelBase{
	
	const TABLE_NAME = 'company_natures';
	
	public function __construct($adapter){
		parent::__construct($adapter, self::TABLE_NAME);
	}
	
	public function getCompanyNatures($take = -1, $start = 0){
		$limit = "";
		
		if($take > 0){
			$limit = " limit {$start}, {$take}";
		}
		return $this->simpleFetch("select * from " . self::TABLE_NAME . $limit);
	}
}

<?php
namespace Job\Model;

use Dk\Mvc\Model\ModelBase;

class CompanyIndustry extends ModelBase{
	
	const TABLE_NAME = 'company_industries';
	
	public function __construct($adapter){
		parent::__construct($adapter, self::TABLE_NAME);
	}
	
	public function getCompanyIndustries($take = -1, $start = 0){
		$limit = "";
		
		if($take > 0){
			$limit = " limit {$start}, {$take}";
		}
		return $this->simpleFetch("select * from " . self::TABLE_NAME . $limit);
	}
	
	public function getCompanyIndustry($id){
		return $this->query("select * from " . self::TABLE_NAME . " where id={$id}")->current();
	}
}

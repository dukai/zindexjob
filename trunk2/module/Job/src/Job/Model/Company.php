<?php
namespace Job\Model;

use Dk\Mvc\Model\ModelBase;

class Company extends ModelBase{
	
	const TABLE_NAME = 'companies';
	
	public function __construct($adapter){
		parent::__construct($adapter, self::TABLE_NAME);
	}
	
	public function getCompanies($take = -1, $start = 0){
		$limit = "";
		
		if($take > 0){
			$limit = " limit {$start}, {$take}";
		}
		return $this->simpleFetch("select * from companies" . $limit);
	}
}

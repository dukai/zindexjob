<?php

namespace Job\Model;

use Dk\Mvc\Model\ModelBase;

class JobCategory extends ModelBase{
	
	const TABLE_NAME = "job_categories";
	
	public function __construct($adapter){
		parent::__construct($adapter, self::TABLE_NAME);
	}
	
	public function getJobCategories($take = -1, $start = 0){
		$limit = "";
		
		if($take > 0){
			$limit = " limit {$start}, {$take}";
		}
		return $this->simpleFetch("select * from " . self::TABLE_NAME . $limit);
	}
	
	public function getJobCategory($id){
		return $this->query("select * from " . self::TABLE_NAME . " where jc_id={$id}")->current();
	}
}

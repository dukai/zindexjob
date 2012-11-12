<?php

namespace Job\Model;

use Dk\Mvc\Model\ModelBase;

class JobCategory extends ModelBase{
	
	const TABLE_NAME = "job_categories";
	
	public function __construct($adapter){
		parent::__construct($adapter, self::TABLE_NAME);
	}
	
	public function getJobCategories(){
		return $this->simpleFetch("select * from " . self::TABLE_NAME)->toArray();
	}
}

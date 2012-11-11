<?php
namespace Job\Model;

use Dk\Mvc\Model\ModelBase;

class Company extends ModelBase{
	
	public function __construct($adapter){
		parent::__construct($adapter);
	}
	
	public function getCompanies(){
		return $this->simpleFetch("select * from companies")->toArray();
	}
}

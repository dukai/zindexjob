<?php
namespace Job\Model;

use Dk\Mvc\Model\ModelBase;

class Company extends ModelBase{
	
	const TABLE_NAME = 'companies';
	
	public function __construct($adapter){
		parent::__construct($adapter, self::TABLE_NAME);
	}
	
	public function getCompanies(){
		return $this->simpleFetch("select * from companies");
	}
}

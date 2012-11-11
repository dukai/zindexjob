<?php

namespace Dk\Mvc\Model;

use Zend\Db\Adapter\Adapter;

class ModelBase{
	
	protected $adapter;
	
	public function __construct($adapter){
		$this->adapter = $adapter;
	}
	
	public function simpleFetch($cmd){
		return $this->adapter->query($cmd, Adapter::QUERY_MODE_EXECUTE);
	}
}

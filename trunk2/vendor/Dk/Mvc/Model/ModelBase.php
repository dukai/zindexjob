<?php

namespace Dk\Mvc\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Insert;
use Zend\Db\Metadata\Metadata;

class ModelBase{
	
	protected $adapter;
	protected $tableName;
	protected $columns;
	
	public function __construct($adapter, $tableName){
		$this->adapter = $adapter;
		$this->tableName = $tableName;
		$metadata = new Metadata($adapter);
		$this->columns = $metadata->getColumnNames($tableName);
	}
	
	public function query($cmd){
		return $this->adapter->query($cmd, Adapter::QUERY_MODE_EXECUTE);
	}
	
	public function simpleFetch($cmd){
		return $this->adapter->query($cmd, Adapter::QUERY_MODE_EXECUTE);
	}
	
	public function simpleInsert(array $data){
		$sql = new Sql($this->adapter);
		
		
		$insert = $sql->insert($this->tableName);
		
		$columns = array();
		$valuse = array();
		foreach ($data as $key => $value) {
			if(in_array($key, $this->columns)){
				$columns[] = $key;
				$valuse[$key] = $value;
			}
			
		}
		$insert->columns($columns);
		$insert->values($valuse);
		
		return $this->query($insert->getSqlString());
	}
}

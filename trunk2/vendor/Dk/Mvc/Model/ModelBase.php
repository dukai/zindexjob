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
	/* 
	 * @param $cmd
	 * @return Array
	 */
	public function simpleFetch($cmd){
		return $this->adapter->query($cmd, Adapter::QUERY_MODE_EXECUTE)->toArray();
	}
	
	public function fetchRow($cmd){
		return $this->adapter->query($cmd, Adapter::QUERY_MODE_EXECUTE)->current();
	}
	
	public function getCount(){
		$count = $this->query("select count(*) as count from " . $this->tableName)->current();
		return intval($count['count']);
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
		return $this->query($insert->getSqlString($this->adapter->getPlatform()));
	}
	
	public function simpleUpdate(array $data, $where){
		$sql = new Sql($this->adapter);
		$update = $sql->update($this->tableName);
		$columns = array();
		$valuse = array();
		foreach ($data as $key => $value) {
			if(in_array($key, $this->columns)){
				$columns[] = $key;
				$valuse[$key] = $value;
			}
			
		}
		
		$update->set($valuse)->where($where);
		return $this->query($update->getSqlString($this->adapter->getPlatform()));
	}
	
	public function getLastId(){
		return $this->adapter->getDriver()->getLastGeneratedValue();
	}
}

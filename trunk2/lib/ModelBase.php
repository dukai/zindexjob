<?

namespace Lib;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\RowGateway\RowGateway;

class ModelBase{
	protected $tableName;
	protected $paramyKey;
	protected $columns;
	protected $row;
	protected $adapter;
	
	public function __construct($tableName, $paramyKey, $adapter){
		$this->adapter = $adapter;
		$this->tableName = $tableName;
		$this->paramyKey = $paramyKey;
		$tableGateway = new TableGateway($tableName, $adapter);
		$this->columns = $tableGateway->getColumns();
		$this->initRow();
	}
	
	public function getTableName(){
		return $this->tableName;
	}
	
	public function getColumnsName(){
		return $this->columns;
	}
	
	private function initRow(){
		$this->row = new RowGateway($this->paramyKey, $this->tableName, $this->adapter);
	}
	
	public function __get($name){
		if(in_array($name,$this->columns)){
			return $this->row->{$name};
		}
	}
}

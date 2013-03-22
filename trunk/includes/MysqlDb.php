<?php

class MysqlDb{
	private $con;
	private $db;
	
	public function __construct($host, $db, $username, $password){
		$this->db = $db;
		$this->con = mysql_connect($host,$username,$password, 1);
		mysql_select_db($db, $this->con);
		mysql_query("set names utf8", $this->con);
	}
	
	public function fetchRow($cmd){
		$result = $this->query($cmd);
		$row = mysql_fetch_array($result);
		return $row;
	}
	
	public function fetchAll($cmd){
		$arr = array();
		$result = $this->query($cmd);
		while($row = mysql_fetch_array($result)){
			$arr[] = $row;
		}
		return $arr;
	}
	
	public function query($cmd){
		return mysql_query($cmd, $this->con);
	}
	
	public function fetchOne($cmd){
		$row = $this->fetchRow($cmd);
		
		return $row[0];
	}
	
	public function lastId(){
		return mysql_insert_id($this->con);
	}
}

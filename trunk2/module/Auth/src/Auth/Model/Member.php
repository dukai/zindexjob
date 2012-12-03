<?php

namespace Auth\Model;

use Dk\Mvc\Model\ModelBase;

class Member extends ModelBase{
	const TABLE_NAME = "members";
	
	private $member;
	
	public function __construct($adapter){
		parent::__construct($adapter, self::TABLE_NAME);
	}
	
	
	public function checkExistByUsername($username){
		$this->member = $this->fetchRow("select * from " . self::TABLE_NAME . " where username='{$username}'");
		return !empty($this->member);
	}
	
	public function checkExistByUid($uid){
		$this->member = $this->fetchRow("select * from " . self::TABLE_NAME . " where uid='{$uid}'");
		return !empty($this->member);
	}
	
	public function checkPassword($password, $orig = true){
		if(empty($this->member)){
			return false;
		}
		
		if($orig){
			if($this->member['password'] ==md5(md5($password) . $this->member->salt)){
				return true;
			}else{
				return false;
			}
		}else{
			if($this->member['password'] == $password){
				return true;
			}else{
				return false;
			}
		}
		
	}
	
	public function getCurrentMember(){
		return $this->member;
	}
	
	public function save($data){
		
		if(empty($data['salt'])){
			$salt = md5(date("y-m-d-H-i-s") . rand(0, 10000));
			$salt = substr($salt, 4, 6);
			$data['salt'] = $salt;
		}else{
			$salt = $data['salt'];
		}
		if(empty($data['password'])){
			return false;
		}
		$password = md5($data['password']);
		$password = md5($password . $salt);
		$data['password'] =  $password;
		if(empty($data['created_date'])){
			$data['created_date'] = date("Y-m-d H:i:s");
		}
		return $this->simpleInsert($data);
	}
}

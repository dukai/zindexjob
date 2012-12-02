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
			if($this->member['password'] == md5($password)){
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
}

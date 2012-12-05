<?php
namespace Job\Model;

use Dk\Mvc\Model\ModelBase;

class ContactUser extends ModelBase{
	
	const TABLE_NAME = 'contact_users';
	
	public function __construct($adapter){
		parent::__construct($adapter, self::TABLE_NAME);
	}
	
	public function getUsers($take = -1, $start = 0){
		$limit = "";
		
		if($take > 0){
			$limit = " limit {$start}, {$take}";
		}
		return $this->simpleFetch("select cu.*, c.name as company_name from contact_users as cu left join company_contactuser_rel as r on cu.uid=r.uid left join companies as c on r.company_id=c.company_id" . $limit);
	}
	
	public function addCompanyRel($companyId, $uid){
		return $this->query("insert into company_contactuser_rel (company_id, uid) values ('$companyId', '$uid')");
	}
	
	public function getContactUser($id){
		return $this->query("select cu.*, c.name as company_name, c.company_id as company_id from " . self::TABLE_NAME . " as cu left join company_contactuser_rel as r on cu.uid=r.uid left join companies as c on r.company_id=c.company_id where cu.uid={$id}")->current();
	}
}

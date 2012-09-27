<?
require_once "MysqlDb.php";
class Helper{
	public static function companySelector($selected = 0, $name = 'company_id'){
		$db = getDb();
		$companies = $db->fetchAll("select * from companies");
		$html = "<select id=\"{$name}\" name=\"{$name}\">";
		foreach($companies as $key=>$value){
			if($selected == $value['company_id']){
				$str = " selected=\"selected\"";
			}else{
				$str = "";
			}
			$html .= "<option{$str} value=\"{$value['company_id']}\">{$value['name']}</option>";
		}
		$html .= "</select>";
		
		return $html;
	}
	
	public static function jobCategorySelector($selected = 0, $name = 'jc_id'){
		$db = getDb();
		$cates = $db->fetchAll("select * from job_categories");
		$html = "<select id=\"{$name}\" name=\"{$name}\">";
		foreach($cates as $key=>$value){
			if($selected == $value['jc_id']){
				$str = " selected=\"selected\"";
			}else{
				$str = "";
			}
			$html .= "<option{$str} value=\"{$value['jc_id']}\">{$value['name']}</option>";
		}
		$html .= "</select>";
		
		return $html;
	}
}

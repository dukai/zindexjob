<?php

namespace Admin\Helper;

use Zend\View\Helper\AbstractHelper;

class CompanySelector extends AbstractHelper{
	public function __invoke($companies, $selected = 0, $name = 'company_id'){
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
}

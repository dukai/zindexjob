<?php

namespace Admin\Helper;

use Zend\View\Helper\AbstractHelper;

class CompanyIndustrySelector extends AbstractHelper{
	public function __invoke($values, $selected = 0, $name = 'industry'){
		$html = "<select id=\"{$name}\" name=\"{$name}\">";
		foreach($values as $key=>$value){
			if($selected == $value['id']){
				$str = " selected=\"selected\"";
			}else{
				$str = "";
			}
			$html .= "<option{$str} value=\"{$value['id']}\">{$value['name']}</option>";
		}
		$html .= "</select>";
		
		return $html;
	}
}

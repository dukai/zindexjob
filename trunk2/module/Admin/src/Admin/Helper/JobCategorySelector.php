<?php

namespace Admin\Helper;

use Zend\View\Helper\AbstractHelper;

class JobCategorySelector extends AbstractHelper{
	public function __invoke($cates, $selected = 0, $name = 'jc_id'){
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

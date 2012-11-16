<?php

namespace Admin\Helper;

use Zend\View\Helper\AbstractHelper;

class Messager extends AbstractHelper{
	public function __invoke($messages){
		$html = '';
		if(!empty($messages)){
			$html .= '<div class="alert alert-success">';
			$html .= '<button type="button" class="close" data-dismiss="alert">×</button>';
			$html .= $messages[0];
			$html .= '</div>';
		}
		
		return $html;
	}
}

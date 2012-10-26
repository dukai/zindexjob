<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Lib;
use Application\Model\Job;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	
		//$m = new Lib\ModelBase('jobs');
		//exit($m->getTableName());
		$sm = $this->getServiceLocator();
		$job = new Job($sm->get("Zend\Db\Adapter\Adapter"));
		
		print_r($job->getColumnsName());
		
        return new ViewModel();
    }
	
	public function testAction(){
		return new ViewModel();
	}
}

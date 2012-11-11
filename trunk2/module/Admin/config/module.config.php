<?php

return array(
	'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Job' => 'Admin\Controller\JobController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'adminhome' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin/',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
			'admin' => array(
				'type' => 'Literal',
				'options' => array(
					'route' => '/admin',
					'defaults' => array(
						'__NAMESPACE__' => 'Admin\Controller',
						'controller' => 'Index',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '/[:controller[/:action]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							),
							'defaults' => array(),
						),
					),
				),
			
			),
			
        ),
    ),
	
    'view_manager' => array(
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'layout/admin'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
        
    ),
    
	'view_helpers' => array(
      'invokables' => array(
         'company_selector' => 'Admin\Helper\CompanySelector',
      ),
   ),
);

<?php

return array(
	'controllers' => array(
        'invokables' => array(
            'Job\Controller\Index' => 'Job\Controller\IndexController',
            'Job\Admin\Controller\Index' => 'Job\Admin\Controller\IndexController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'jobhome' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/job/',
                    'defaults' => array(
                        'controller' => 'Job\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
			'job' => array(
				'type' => 'Literal',
				'options' => array(
					'route' => '/job',
					'defaults' => array(
						'__NAMESPACE__' => 'Job\Controller',
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
			
			'jobadmin' => array(
				'type' => 'Literal',
				'options' => array(
					'route' => '/job/admin',
					'defaults' => array(
						'__NAMESPACE__' => 'Job\Admin\Controller',
						'controller' => 'Index',
						'action' => 'index',
					),
				),
			),
        ),
    ),
	
    'view_manager' => array(
        'template_path_stack' => array(
            'job' => __DIR__ . '/../view',
        ),
    ),
);

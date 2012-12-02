<?php

return array(
	'controllers' => array(
        'invokables' => array(
            'Auth\Controller\Auth' => 'Auth\Controller\AuthController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'auth_login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\Auth',
                        'action'     => 'login',
                    ),
                ),
            ),
            
			'auth_logout' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        'controller' => 'Auth\Controller\Auth',
                        'action'     => 'logout',
                    ),
                ),
            ),
        ),
    ),
	
    'view_manager' => array(
        'template_path_stack' => array(
            'authview' => __DIR__ . '/../view',
        ),
        
		'template_map' => array(
            'layout/auth'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
    ),
    
	'view_helpers' => array(
      'invokables' => array(
         'messager' => '\Admin\Helper\Messager',
      ),
   ),
);

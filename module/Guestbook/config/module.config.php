<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Guestbook\Controller\Guestbook' => 'Guestbook\Controller\GuestbookController',
        ),
    ),
// The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'guestbook' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/guestbook[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Guestbook\Controller\GuestBookMessage',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'guestbook' => __DIR__ . '/../view',
        ),
    ),
);
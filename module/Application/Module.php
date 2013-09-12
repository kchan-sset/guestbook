<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Model\GuestbookMessage;
use Application\Model\GuestbookMessageTable;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

// Add this method:
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Application\Model\GuestBookMessageTable' =>  function($sm) {
                    $tableGateway = $sm->get('GuestBookMessageTableGateway');
                    $table = new GuestbookMessageTable($tableGateway);
                    return $table;
                },
                'GuestBookMessageTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new GuestbookMessage());
                    return new TableGateway('guestbookMessage', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}

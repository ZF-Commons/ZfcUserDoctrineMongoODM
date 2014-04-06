<?php

namespace ZfcUserDoctrineMongoODM;

use ZfcUserDoctrineMongoODM\Event\ResolveTargetEntityListener;
use ZfcUser\Module as ZfcUser;
use Doctrine\ODM\MongoDB\Events;
use Zend\EventManager\StaticEventManager;
use Zend\ModuleManager\ModuleManager;

class Module
{
    public function init(ModuleManager $moduleManager)
    {
        // @TODO: Fix this for the ODM
        //$events = StaticEventManager::getInstance();
        //$events->attach('bootstrap', 'bootstrap', array($this, 'attachDoctrineEvents'), 100);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return include __DIR__ . '/config/module.service.php';
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function attachDoctrineEvents($e)
    {
        $app = $e->getParam('application');
        $locator = $app->getLocator();
        $em = $locator->get('zfcuser_mongo_dm');
        $evm = $em->getEventManager();
        $listener = new ResolveTargetEntityListener;
        $listener->addResolveTargetEntity(
            'ZfcUser\Model\UserInterface',
            ZfcUser::getOption('user_model_class'),
            array()
        );
        $evm->addEventListener(Events::loadClassMetadata, $listener);
    }
}

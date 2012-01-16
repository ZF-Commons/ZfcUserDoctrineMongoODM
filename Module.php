<?php

namespace ZfcUserDoctrineMongoODM;

use Zend\Module\Manager,
    Zend\Module\Consumer\AutoloaderProvider,
    ZfcUserDoctrineMongoODM\Event\ResolveTargetEntityListener,
    ZfcUser\Module as ZfcUser,
    Doctrine\ODM\MongoDB\Events,
    Zend\EventManager\StaticEventManager;

class Module implements AutoloaderProvider
{
    public function init(Manager $moduleManager)
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
            'ZfcUser\Model\User',
            ZfcUser::getOption('user_model_class'),
            array()
        );
        $evm->addEventListener(Events::loadClassMetadata, $listener);
    }
}

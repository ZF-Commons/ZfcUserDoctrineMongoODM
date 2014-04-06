<?php
return array(
    'aliases' => array(
        'zfcuser_mongo_dm' => 'Doctrine\ODM\ObjectManager',
    ),
    'factories' => array(
        'zfcuser_user_mapper' => function ($sm) {
                $mapper = new \ZfcUserDoctrineMongoODM\Mapper\UserMongoDB;
                $mapper->setOptions($sm->get('zfcuser_module_options'));
                $mapper->setDocumentManager($sm->get('Doctrine\ODM\Mongo\DocumentManager'));
                return $mapper;
            },
        'zfcuser_module_options' => function ($sm) {
                $config = $sm->get('Configuration');
                return new \ZfcUserDoctrineMongoODM\Options\ModuleOptions(isset($config['zfcuser']) ? $config['zfcuser'] : array());
            },
    ),
);

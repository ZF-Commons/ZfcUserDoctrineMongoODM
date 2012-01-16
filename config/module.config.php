<?php
return array(
    'zfcuser' => array(
        'user_model_class'     => 'ZfcUserDoctrineMongoODM\Document\User',
        'usermeta_model_class' => 'ZfcUserDoctrineMongoODM\Document\UserMeta',
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'zfcuser_mongo_dm'        => 'mongo_dm', 
                'zfcuser_user_mapper'     => 'ZfcUserDoctrineMongoODM\Mapper\UserMongoDB',
                'zfcuser_usermeta_mapper' => 'ZfcUserDoctrineMongoODM\Mapper\UserMetaMongoDB',
            ),
            'mongo_driver_chain' => array(
                'parameters' => array(
                    'drivers' => array(
                        'zfcuser_xml_driver' => array(
                            'class'          => 'Doctrine\ODM\MongoDB\Mapping\Driver\XmlDriver',
                            'namespace'      => 'ZfcUserDoctrineMongoODM\Document',
                            'paths'          => array(__DIR__ . '/xml'),
                            'file_extension' => '.mongodb.xml',
                        ),
                    )
                )
            ),
            'ZfcUserDoctrineMongoODM\Mapper\UserMongoDB' => array(
                'parameters' => array(
                    'dm' => 'zfcuser_mongo_dm',
                ),
            ),
            'ZfcUserDoctrineMongoODM\Mapper\UserMetaMongoDB' => array(
                'parameters' => array(
                    'dm' => 'zfcuser_mongo_dm',
                ),
            ),
        ),
    ),
);

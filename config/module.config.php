<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'zfcuser_document' => array(
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/xml/zfcuserdoctrinemongoodm'
            ),

            'odm_default' => array(
                'drivers' => array(
                    'ZfcUserDoctrineMongoODM\Document'  => 'zfcuser_document'
                )
            )
        )
    ),
);

//<?php
//return array(
//    'zfcuser' => array(
//        'user_entity_class'     => 'ZfcUserDoctrineMongoODM\Document\User'
//    ),
//    'di' => array(
//        'instance' => array(
//            'alias' => array(
//                'zfcuser_mongo_dm'        => 'mongo_dm', 
//                'zfcuser_user_mapper'     => 'ZfcUserDoctrineMongoODM\Mapper\User'
//            ),
//            'mongo_driver_chain' => array(
//                'parameters' => array(
//                    'drivers' => array(
//                        'zfcuser_xml_driver' => array(
//                            'class'          => 'Doctrine\ODM\MongoDB\Mapping\Driver\XmlDriver',
//                            'namespace'      => 'ZfcUserDoctrineMongoODM\Document',
//                            'paths'          => array(__DIR__ . '/xml'),
//                            'file_extension' => '.mongodb.xml',
//                        ),
//                    )
//                )
//            ),
//            'ZfcUserDoctrineMongoODM\Mapper\UserMongoDB' => array(
//                'parameters' => array(
//                    'dm' => 'zfcuser_mongo_dm',
//                ),
//            ),
//            'ZfcUserDoctrineMongoODM\Mapper\UserMetaMongoDB' => array(
//                'parameters' => array(
//                    'dm' => 'zfcuser_mongo_dm',
//                ),
//            ),
//        ),
//    ),
//);

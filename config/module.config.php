<?php
return array(
    'zfcuser' => array(
        'user_model_class'     => 'ZfcUserDoctrineMongoODM\Document\User',
        'usermeta_model_class' => 'ZfcUserDoctrineMongoODM\Document\UserMeta',
    ),
    'doctrine' => array(
        'driver' => array(
            'zfcuser_xml_driver' => array(
                'class'          => 'Doctrine\ODM\MongoDB\Mapping\Driver\XmlDriver',
                'paths'          => array(__DIR__ . '/xml'),
            ),
        ),
        'configuration' => array(
            'odm_default' => array(
                'driver' => 'zfcuser_xml_driver'
            ),
        ),
    ),
);

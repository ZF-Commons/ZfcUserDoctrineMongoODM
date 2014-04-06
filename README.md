ZfcUserDoctrineMongoODM
=======================

Introduction
------------
ZfcUserDoctrineMongoODM is a MongoDb storage adapter for [ZfcUser](https://github.com/ZF-Commons/ZfcUser). This module makes use of the Doctrine2 MongoDB ODM.

Installation
------------

### Composer

1. Install module   
Go to the [release tab](https://github.com/ZF-Commons/ZfcUserDoctrineMongoODM/releases) and make a note of the most recent version.
Run the following command from your application directory:
```php composer.phar require zf-commons/zfc-user-doctrine-mongo-odm```
When asked for er version constraint, put in the version noted from the release tab.

2. Add ```DoctrineModule```, ```DoctrineMongoODMModule``` and ```ZfcUserDoctrineMongoODM``` to ```config/application.config.php```

Options
------------

The following options are available:

- **enable_default_entities** - Boolean value, determines if the default User entity should be enabled. Set it to false in order to extend ZfcUser\Entity\User with your own entity. Default is true.


Dependencies
------------

- [ZfcUser](https://github.com/ZF-Commons/ZfcUser)
- [DoctrineModule](https://github.com/doctrine/DoctrineModule)
- [DoctrineMongoODMModule](https://github.com/doctrine/DoctrineMongoODMModule)

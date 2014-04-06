<?php

namespace ZfcUserDoctrineMongoODM\Mapper;

use Doctrine\ODM\MongoDB\DocumentManager,
    ZfcUser\Module as ZfcUser,
    ZfcUser\Entity\UserInterface,
    ZfcUser\Mapper\UserInterface as UserMapperInterface,
    ZfcBase\EventManager\EventProvider;

class UserMongoDB extends EventProvider implements UserMapperInterface
{
    protected $dm;
    protected $options;

    public function insert($user)
    {
        $dm = $this->getDocumentManager();
        $this->persist($user);
        return $user;
    }

    public function update($user)
    {
        $dm = $this->getDocumentManager();
        $this->persist($user);
        return $user;
    }

    public function persist(UserInterface $user)
    {
        $dm = $this->getDocumentManager();
        $dm->persist($user);
        $dm->flush();
    }

    public function findByEmail($email)
    {
        $dm = $this->getDocumentManager();
        $user = $this->getUserRepository()->findOneBy(array('email' => $email));
        return $user;
    }

    public function findByUsername($username)
    {
        $dm = $this->getDocumentManager();
        $user = $this->getUserRepository()->findOneBy(array('username' => $username));
        return $user;
    }
    
    public function findById($id)
    {
        $dm = $this->getDocumentManager();
        $user = $this->getUserRepository()->find($id);
        return $user;
    }

    public function getDocumentManager()
    {
        return $this->dm;
    }

    public function setDocumentManager(DocumentManager $dm)
    {
        $this->dm = $dm;
        return $this;
    }

    public function getUserRepository()
    {
    	$class = $this->getOptions()->getUserEntityClass();
        return $this->getDocumentManager()->getRepository($class);
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

}

<?php

namespace ZfcUserDoctrineMongoODM\Mapper;

use Doctrine\ODM\MongoDB\DocumentManager,
    ZfcUser\Module as ZfcUser,
    ZfcUser\Model\UserMeta as UserMetaModel,
    ZfcUser\Model\Mapper\UserMeta as UserMetaMapper,
    ZfcBase\EventManager\EventProvider;

class UserMetaMongoDB extends EventProvider implements UserMetaMapper
{

    public function add(UserMetaModel $userMeta)
    {
        return $this->persist($userMeta);
    }

    public function update(UserMetaModel $userMeta)
    {
        return $this->persist($userMeta);
    }

    public function get($userId, $metaKey)
    {
        $dm = $this->getDocumentManager();
        $userMeta = $this->getUserMetaRepository()->findOneBy(array('user' => $userId, 'metaKey' => $metaKey));
        $this->events()->trigger(__FUNCTION__, $this, array('userMeta' => $userMeta, 'em' => $dm));
        return $userMeta;
    }

    public function persist(UserMetaModelInterface $userMeta)
    {
        $dm = $this->getDocumentManager();
        $this->events()->trigger(__FUNCTION__ . '.pre', $this, array('userMeta' => $userMeta, 'em' => $dm));
        $userMeta->setUser($dm->merge($userMeta->getUser()));
        $dm->persist($userMeta);
        $this->events()->trigger(__FUNCTION__ . '.post', $this, array('userMeta' => $userMeta, 'em' => $dm));
        $dm->flush();
    }

    public function getDocumentManager()
    {
        return $this->em;
    }

    public function setDocumentManager(DocumentManager $dm)
    {
        $this->em = $dm;
        return $this;
    }

    public function getUserMetaRepository()
    {
    	$class = ZfcUser::getOption('usermeta_model_class');
        return $this->getDocumentManager()->getRepository($class);
    }

}

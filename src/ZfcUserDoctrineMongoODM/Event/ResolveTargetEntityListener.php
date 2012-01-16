<?php
namespace ZfcUserDoctrineMongoODM\Event;

use Doctrine\ODM\MongoDB\Event\LoadClassMetadataEventArgs;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

/**
 * @TODO: Fix this for ODM...
 * This is a port of the ORM version. The ODM event has no associationMappings 
 * property, so this strategy might not work here. I'm not even sure if this 
 * type of a thing makes sense at all in the ODM, but I'd like to have a 
 * consistent featureset. -Evan
 *
 * ResolveTargetEntityListener
 *
 * Mechanism to overwrite interfaces or classes specified as association
 * targets.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 * @since 2.2
 */
class ResolveTargetEntityListener
{
    /**
     * @var array
     */
    private $resolveTargetEntities = array();

    /**
     * Add a target-entity class name to resolve to a new class name.
     *
     * @param string $originalEntity
     * @param string $newEntity
     * @param array $mapping
     * @return void
     */
    public function addResolveTargetEntity($originalEntity, $newEntity, array $mapping)
    {
        $mapping['targetEntity'] = ltrim($newEntity, "\\");
        $this->resolveTargetEntities[ltrim($originalEntity, "\\")] = $mapping;
    }

    /**
     * Process event and resolve new target entity names.
     *
     * @param LoadClassMetadataEventArgs $args
     * @return void
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        $cm = $args->getClassMetadata();
        foreach ($cm->associationMappings as $assocName => $mapping) {
            if (isset($this->resolveTargetEntities[$mapping['targetEntity']])) {
                $this->remapAssociation($cm, $mapping);
            }
        }
    }

    private function remapAssociation($classMetadata, $mapping)
    {
        $newMapping = $this->resolveTargetEntities[$mapping['targetEntity']];
        $newMapping = array_replace_recursive($mapping, $newMapping);
        $newMapping['fieldName'] = $mapping['fieldName'];
        unset($classMetadata->associationMappings[$mapping['fieldName']]);

        switch ($mapping['type']) {
            case ClassMetadata::MANY_TO_MANY:
                $classMetadata->mapManyToMany($newMapping);
                break;
            case ClassMetadata::MANY_TO_ONE:
                $classMetadata->mapManyToOne($newMapping);
                break;
            case ClassMetadata::ONE_TO_MANY:
                $classMetadata->mapOneToMany($newMapping);
                break;
            case ClassMetadata::ONE_TO_ONE:
                $classMetadata->mapOneToOne($newMapping);
                break;
        }
    }
}

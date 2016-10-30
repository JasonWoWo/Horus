<?php

/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/7/25
 * Time: 下午7:52
 */

namespace Horus\Comprehend\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Horus\Models\Entity\RepositoryInterface;

abstract class DoctrineRepository extends EntityRepository implements RepositoryInterface
{
    public function __construct(EntityManager $em)
    {
        $metadata = new ClassMetadata($this->entity());
        parent::__construct($em, $metadata);
    }
    
    abstract public function entity();
    
    public function createFreshEntity()
    {
        $entityName = $this->getClassName();
        return new $entityName();
    }

    public function saveEntity($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function removeEntity($entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

}
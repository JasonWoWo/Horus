<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/7/28
 * Time: 下午5:24
 */

namespace Horus\Models\Entity;


use Doctrine\Common\Persistence\ObjectRepository;

interface RepositoryInterface extends ObjectRepository
{
    /**
     * obtain the entity name
     * @return string
     */
    public function entity();

    /**
     * create new entity for demand
     * @return object
     */
    public function createFreshEntity();

    /**
     * update , insert param for entity, and the last for save the entity
     * @param $entity
     * @return void
     */
    public function saveEntity($entity);

    /**
     * remove the entity and flush the operate
     * @param $entity
     * @return void
     */
    public function removeEntity($entity);
}
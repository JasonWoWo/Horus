<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/7/25
 * Time: 下午8:20
 */

namespace Horus\Comprehend\Repository\Account;

use Horus\Models\Entity\Admin\ManagerRepositoryInterface;
use Horus\Comprehend\Repository\DoctrineRepository as BaseMappingRepository;
use Horus\Models\Entity\Admin\Manager;

class ManagerRepository extends BaseMappingRepository implements ManagerRepositoryInterface
{
    public function entity()
    {
        // TODO: Implement entity() method.
        return Manager::class;
    }
    
    public function getQueryUserForPhoneWithPassword($phone, $password)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('manager')->from($this->entity(), 'manager')->where("manager.phone = :phone")
            ->andWhere("manager.password = :password");
        $queryBuilder->setParameter('phone', $phone);
        $queryBuilder->setParameter('password', $password);
        $manager = $queryBuilder->getQuery()->getSingleResult();
        
        // 第二种构造查询的方法
//        $queryBuilder = $this->createQueryBuilder('manager');
//        $queryBuilder->where("manager.phone = :phone")->andWhere("manager.password = :password");
//        $queryBuilder->setParameter('phone', $phone);
//        $queryBuilder->setParameter('password', $password);
//        $manager = $queryBuilder->getQuery()->getSingleResult();
        return $manager;
    }
}
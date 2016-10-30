<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/7/29
 * Time: 下午9:23
 */

namespace Horus\Application\Service;


abstract class ApplicationService
{
    /**
     * @param $serviceProvider
     * @return \Horus\Application\Service\ApplicationService
     */
    protected function getService($serviceProvider)
    {
        return \app($serviceProvider);
    }

    /**
     * @return \EntityManager
     */
    protected function getEntityManager()
    {
        return \app('em');
    }

    /**
     * @param $repositoryInterface
     * @return \Horus\Models\Entity\RepositoryInterface
     */
    protected function getRepository($repositoryInterface)
    {
        return \app($repositoryInterface);
    }
}
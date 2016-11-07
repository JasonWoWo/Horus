<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/5
 * Time: 下午1:57
 */

namespace Horus\Comprehend\Repository\Client;

use Horus\Comprehend\Repository\DoctrineRepository as BaseMappingRepository;
use Horus\Models\Entity\User\Client;
use Horus\Models\Entity\User\ClientRepositoryInterface;

class ClientRepository extends BaseMappingRepository implements ClientRepositoryInterface
{
    public function entity()
    {
        return Client::class;
    }

    public function getClientByPhone($phone)
    {
        // TODO: Implement getClientByPhone() method.
    }


}
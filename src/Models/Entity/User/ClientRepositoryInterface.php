<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/5
 * Time: 下午1:51
 */

namespace Horus\Models\Entity\User;

use Horus\Models\Entity\RepositoryInterface as BaseServiceRepositoryInterface;


interface ClientRepositoryInterface extends BaseServiceRepositoryInterface
{
    public function getClientByPhone($phone);
}
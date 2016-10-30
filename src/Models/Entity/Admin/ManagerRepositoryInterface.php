<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/7/28
 * Time: 下午5:25
 */

namespace Horus\Models\Entity\Admin;

use Horus\Models\Entity\RepositoryInterface as BaseServiceRepositoryInterface;

interface ManagerRepositoryInterface extends BaseServiceRepositoryInterface
{
    public function getQueryUserForPhoneWithPassword($phone, $password);
}
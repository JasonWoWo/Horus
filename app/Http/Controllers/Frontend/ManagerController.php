<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/9/10
 * Time: 下午4:22
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\ApiController;
use Horus\Application\Components\HSPropertyComponent\HsBuilder as HsCrud;
use Horus\Models\Entity\Admin\Manager;
use Horus\Models\Entity\Admin\ManagerRepositoryInterface;

class ManagerController extends ApiController
{

    function buildPropertyCollection()
    {
        // TODO: Implement buildPropertyCollection() method.
        $formProperty = new HsCrud();
        $this->formatService->setHsBuilder($formProperty);
        $formProperty->setProperty('id', 'ID', HsCrud::MASK_NOT_CREATE|HsCrud::MASK_NOT_EDIT);
        $formProperty->setProperty('username', '用户名', HsCrud::MASK_DISABLE_EDIT);
        $formProperty->setProperty('phone', '电话');
        $formProperty->setProperty('email', '邮箱');
        $formProperty->setProperty('createOn', '创建时间');
        $formProperty->setProperty('gender', '性别', 0);
        $this->formatService->setFormatEntity(ManagerRepositoryInterface::class);
        $this->formatService->getPropertyEntity('gender')->setRadioExtraParams(Manager::$genderMapping);
    }
}
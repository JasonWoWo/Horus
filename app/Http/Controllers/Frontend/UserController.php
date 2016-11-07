<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/5
 * Time: 下午1:34
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\ApiController;
use Horus\Application\Components\PropertyComponent\FormPropertyBuilder as CrudProperty;
use Horus\Models\Entity\User\ClientRepositoryInterface;

class UserController extends ApiController
{
    
    public function buildPropertyCollection()
    {
        // TODO: Implement buildPropertyCollection() method.
        $formProperty = new CrudProperty();
        $formProperty->setTextProperty('id', 'ID', CrudProperty::MASK_NOT_CREATE|CrudProperty::MASK_NOT_EDIT);
        $formProperty->setTextProperty('name', '客户姓名');
        $formProperty->setTextProperty('phone', '客户手机号码');
        $formProperty->setTextProperty('standbyPhone', '客户备用手机号码');
        $formProperty->setTextProperty('telephone', '客户店铺座机');
        $formProperty->setTextProperty('address', '客户商铺地址');
        $this->formatService->setFormatEntity(ClientRepositoryInterface::class);
        $this->formatService->setPropertyCollection($formProperty);

    }

}
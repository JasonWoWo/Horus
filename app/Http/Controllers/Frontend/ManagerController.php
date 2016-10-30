<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/9/10
 * Time: 下午4:22
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\ApiController;
use App\Http\Requests\Request;
use Horus\Application\Components\PropertyComponent\FormPropertyBuilder AS CrudProperty;
use Horus\Models\Entity\Admin\Manager;
use Horus\Models\Entity\Admin\ManagerRepositoryInterface;

class ManagerController extends ApiController
{

    public function homeView()
    {
        return view('manager');
    }

    function buildPropertyCollection()
    {
        // TODO: Implement buildPropertyCollection() method.
        $formProperty = new CrudProperty();
        $formProperty->setTextProperty('id', 'ID', CrudProperty::MASK_NOT_CREATE|CrudProperty::MASK_NOT_EDIT);
        $formProperty->setTextProperty('username', '用户名', CrudProperty::MASK_DISABLE_EDIT);
        $formProperty->setTextProperty('phone', '电话');
        $formProperty->setTextProperty('email', '邮箱');
//        $formProperty->setTextProperty('createOn', '创建时间');
        $formProperty->setMultiProperty('gender', '性别', 0, CrudProperty::RADIO_BUILDER, Manager::$genderMapping);
        $this->formatService->setFormatEntity(ManagerRepositoryInterface::class);
        $this->formatService->setPropertyCollection($formProperty);
    }
}
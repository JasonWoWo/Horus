<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/5
 * Time: 下午5:47
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\ApiController;
use Horus\Application\Components\PropertyComponent\FormPropertyBuilder as CrudProperty;
use Horus\Models\Entity\Brand\BrandRepositoryInterface;

class BrandController extends ApiController
{
    function buildPropertyCollection()
    {
        // TODO: Implement buildPropertyCollection() method.
        $formProperty = new CrudProperty();
        $formProperty->setTextProperty('id', 'ID', CrudProperty::MASK_NOT_CREATE|CrudProperty::MASK_NOT_EDIT);
        $formProperty->setTextProperty('name', '品牌名称');
        $formProperty->setTextProperty('description', '品牌描述');
        $formProperty->setTextProperty('logo', '品牌logo');
        $formProperty->setTextProperty('officer', 'officer');
        $formProperty->setTextProperty('createOn', '品牌创建时间', CrudProperty::MASK_NOT_EDIT|CrudProperty::MASK_NOT_CREATE);
        $this->formatService->setFormatEntity(BrandRepositoryInterface::class);
        $this->formatService->setPropertyCollection($formProperty);

    }

}
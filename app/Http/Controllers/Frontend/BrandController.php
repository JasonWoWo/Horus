<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/5
 * Time: 下午5:47
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\ApiController;
use Horus\Application\Components\HSPropertyComponent\HsBuilder as HsCrud;
use Horus\Models\Entity\Brand\BrandRepositoryInterface;

class BrandController extends ApiController
{
    function buildPropertyCollection()
    {
        // TODO: Implement buildPropertyCollection() method.
        $formProperty = new HsCrud();
        $formProperty->setProperty('id', 'ID', HsCrud::MASK_NOT_CREATE|HsCrud::MASK_NOT_EDIT);
        $formProperty->setProperty('name', '品牌名称');
        $formProperty->setProperty('description', '品牌描述');
        $formProperty->setProperty('logo', '品牌logo');
        $formProperty->setProperty('officer', 'officer');
        $formProperty->setProperty('createOn', '品牌创建时间', HsCrud::MASK_NOT_EDIT|HsCrud::MASK_NOT_CREATE);
        $this->formatService->setFormatEntity(BrandRepositoryInterface::class);
        $this->formatService->setHsBuilder($formProperty);

    }

}
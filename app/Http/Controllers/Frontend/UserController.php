<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/5
 * Time: 下午1:34
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\ApiController;
use Horus\Application\Components\HSPropertyComponent\HsBuilder as HsCrud;
use Horus\Models\Entity\User\ClientRepositoryInterface;

class UserController extends ApiController
{
    
    public function buildPropertyCollection()
    {
        // TODO: Implement buildPropertyCollection() method.
        $formProperty = new HsCrud();
        $formProperty->setProperty('id', 'ID', HsCrud::MASK_NOT_CREATE|HsCrud::MASK_NOT_EDIT);
        $formProperty->setProperty('name', '客户姓名');
        $formProperty->setProperty('phone', '客户手机号码');
        $formProperty->setProperty('standbyPhone', '客户备用手机号码');
        $formProperty->setProperty('telephone', '客户店铺座机');
        $formProperty->setProperty('address', '客户商铺地址');
        $this->formatService->setFormatEntity(ClientRepositoryInterface::class);
        $this->formatService->setHsBuilder($formProperty);

    }

}
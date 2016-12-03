<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/7
 * Time: 下午10:18
 */

namespace Horus\Models\Entity\Product;

use Horus\Models\Entity\RepositoryInterface as BaseServiceRepositoryInterface;

interface ProductRepositoryInterface extends BaseServiceRepositoryInterface
{
    public function getProductById($id);
}
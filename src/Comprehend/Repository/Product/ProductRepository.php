<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/8
 * Time: 下午10:12
 */

namespace Horus\Comprehend\Repository\Product;


use Horus\Comprehend\Repository\DoctrineRepository as BaseMappingRepository;
use Horus\Models\Entity\Product\Product;
use Horus\Models\Entity\Product\ProductRepositoryInterface;

class ProductRepository extends BaseMappingRepository implements ProductRepositoryInterface
{
    public function entity()
    {
        return Product::class;
    }

    public function getProductById($id)
    {

    }
}
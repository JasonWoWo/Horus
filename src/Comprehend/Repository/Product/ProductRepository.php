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

    /**
     * 根据商品ID获取商品的详细信息
     * @param $id
     * @return Product|false
     */
    public function getProductById($id)
    {
        /** @var Product $product */
        $product = $this->getEntityManager()->getRepository($this->entity())->find($id);
        if (!$product) {
            return false;
        }
        return $product;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/17
 * Time: 下午2:32
 */

namespace Horus\Comprehend\Repository\Product;

use Horus\Comprehend\Repository\DoctrineRepository as BaseMappingRepository;
use Horus\Models\Entity\Product\ProductVariant;
use Horus\Models\Entity\Product\ProductVariantRepositoryInterface;

class ProductVariantRepository extends BaseMappingRepository implements ProductVariantRepositoryInterface
{
    public function entity()
    {
        return ProductVariant::class;
    }

}
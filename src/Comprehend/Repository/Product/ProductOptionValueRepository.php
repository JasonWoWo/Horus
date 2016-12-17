<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/17
 * Time: 下午1:30
 */

namespace Horus\Comprehend\Repository\Product;

use Horus\Comprehend\Repository\DoctrineRepository as BaseMappingRepository;
use Horus\Models\Entity\Product\ProductOptionValue;
use Horus\Models\Entity\Product\ProductOptionValueRepositoryInterface;

class ProductOptionValueRepository extends BaseMappingRepository implements ProductOptionValueRepositoryInterface
{
    public function entity()
    {
        return ProductOptionValue::class;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/10
 * Time: 下午3:53
 */

namespace Horus\Comprehend\Repository\Product;

use Horus\Comprehend\Repository\DoctrineRepository as BaseMappingRepository;
use Horus\Models\Entity\Product\Product;
use Horus\Models\Entity\Product\ProductOption;
use Horus\Models\Entity\Product\ProductOptionRepositoryInterface;
use Horus\Models\Model\Variation\OptionInterface;

class ProductOptionRepository extends BaseMappingRepository implements  ProductOptionRepositoryInterface
{
    public function entity()
    {
        return ProductOption::class;
    }

    /**
     * @param Product $product
     * @return bool|OptionInterface[]
     */
    public function getProductOptions(Product $product)
    {
        /** @var OptionInterface[] $options */
        $options = $this->findBy(['product' => $product->getId()]);
//        $options = $this->getEntityManager()->getRepository($this->entity())->findBy(['product' => $product->getId()]);
        if (!$options) {
            return false;
        }
        return $options;
    }


}
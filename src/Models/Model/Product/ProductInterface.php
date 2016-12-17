<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/10
 * Time: 下午8:46
 */

namespace Horus\Models\Model\Product;


use Horus\Models\Entity\Product\ProductVariantInterface;

interface ProductInterface
{
    /**
     * @param ProductVariantInterface $variant
     * @return ProductInterface
     */
    public function setVariants(ProductVariantInterface $variant);

    /**
     * @return ProductVariantInterface[]
     */
    public function getVariants();
}
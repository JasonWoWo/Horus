<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/10
 * Time: 下午3:46
 */

namespace Horus\Models\Entity\Product;

use Horus\Models\Entity\RepositoryInterface as BaseServiceRepositoryInterface;
use Horus\Models\Model\Variation\OptionInterface;

interface ProductOptionRepositoryInterface extends BaseServiceRepositoryInterface
{
    /**
     * @param Product $product
     * @return OptionInterface[]|bool
     */
    public function getProductOptions(Product $product);
}
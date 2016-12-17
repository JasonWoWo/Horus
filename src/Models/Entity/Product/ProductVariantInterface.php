<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/3
 * Time: 下午8:15
 */

namespace Horus\Models\Entity\Product;

use Horus\Models\Model\Product\VariantInterface AS BaseVariantInterface;
interface ProductVariantInterface extends BaseVariantInterface
{
    public function setImage($image);

    /**
     * Get ProductVariant's Image
     * @return string
     */
    public function getImage();

    /**
     * Set ProductVariant's Sold
     * @param $sold
     */
    public function setSold($sold);

    /**
     * Get ProductVariant's Sold
     * @return int
     */
    public function getSold();

    /**
     * Obtain ProductVariant's Sku
     * @return string
     */
    public function getSku();

    /**
     * Set ProductVariant's Sku
     * @param $sku
     */
    public function setSku($sku);
}
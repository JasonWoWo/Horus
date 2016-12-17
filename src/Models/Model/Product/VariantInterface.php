<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/3
 * Time: 下午8:12
 */

namespace Horus\Models\Model\Product;

use Horus\Models\Model\Variation\VariantInterface AS RootVariantInterface;
interface VariantInterface extends RootVariantInterface
{
    /**
     * Obtain Variant's Price
     * @return mixed
     */
    public function getPrice();

    /**
     * Set Variant's Price
     * @param $price
     * @return mixed
     */
    public function setPrice($price);

    /**
     * Get Variant's OriPrice Value
     * @return float
     */
    public function getOriPrice();

    /**
     * Set Variant's OriPrice Value
     * @param $oriPrice
     */
    public function setOriPrice($oriPrice);

    /**
     * Obtain the stock
     * @return int
     */
    public function getOnHand();

    /**
     * @param $stock
     */
    public function setOnHand($stock);
}
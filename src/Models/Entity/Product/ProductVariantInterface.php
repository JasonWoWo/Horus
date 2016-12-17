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
    
    public function getImage();
    
    public function setSold($sold);
    
    public function getSold();

    /**
     * @return string
     */
    public function getSku();

    /**
     * @param $sku
     * @return ProductVariantInterface
     */
    public function setSku($sku);
}
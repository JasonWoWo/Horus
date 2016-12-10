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
    public function getPrice();
    
    public function setPrice($price);
    
    public function getOriPrice();
    
    public function setOriPrice($oriPrice);
}
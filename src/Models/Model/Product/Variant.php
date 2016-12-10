<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/3
 * Time: 下午7:55
 */

namespace Horus\Models\Model\Product;

use Horus\Models\Model\Variation\Variant AS RootVariant;
class Variant extends RootVariant implements VariantInterface
{
    /**
     * Product SKU Price
     * 
     * @var int
     */
    protected $price = 0;

    /**
     * Product SKU OriPrice
     * 
     * @var int
     */
    protected $oriPrice = 0;

    
    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        
        return $this;
    }

    public function getOriPrice()
    {
        return $this->oriPrice;
    }

    public function setOriPrice($oriPrice)
    {
        $this->oriPrice = $oriPrice;
        
        return $this;
    }

}
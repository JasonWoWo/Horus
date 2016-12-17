<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/3
 * Time: 下午7:31
 */

namespace Horus\Models\Entity\Product;

use Horus\Models\Model\Product\Variant AS BaseVariant;
use Horus\Models\Model\Variation\OptionValue;

class ProductVariant extends BaseVariant implements ProductVariantInterface
{
    /**
     * Variant SKU
     * 
     * @var string
     */
    protected $sku = null;

    /**
     * SKU Image
     * 
     * @var string
     */
    protected $image = '';

    /**
     * SKU Sold Amount
     * 
     * @var int
     */
    protected $sold;
    
    public function __construct()
    {
        parent::__construct();
    }

    public function setImage($image)
    {
        $this->image = $image;
        
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setSold($sold)
    {
        $this->sold = $sold;
        
        return $this;
    }

    public function getSold()
    {
        return $this->sold;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @param OptionValue[] $optionValueItems
     * @return string
     */
    public static function buildSku($optionValueItems)
    {
        $values = array();
        foreach ($optionValueItems as $optionValue) {
            $values[$optionValue->getOption()->getId()] = $optionValue->getOption()->getId() . ":" . $optionValue->getId();
        }
        ksort($values);
        
        return implode(';', array_values($values));
    }
}
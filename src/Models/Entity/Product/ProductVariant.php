<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/3
 * Time: 下午7:31
 */

namespace Horus\Models\Entity\Product;

use Horus\Models\Model\Product\Variant AS BaseVariant;
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
}
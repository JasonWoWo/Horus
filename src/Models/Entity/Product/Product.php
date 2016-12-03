<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/7
 * Time: 下午10:17
 */

namespace Horus\Models\Entity\Product;

use Horus\Models\Entity\Brand\Brand;
use Horus\Models\Model\Product\Product as BaseProduct;

class Product extends BaseProduct
{
    /**
     * @var int
     */
    protected $officer = 0;
    
    /**
     * @var string
     */
    protected $remark = '';

    /**
     * @var bool
     */
    protected $enable = true;

    /**
     * @var string
     */
    protected $photo = '';

    /**
     * @var Brand
     */
    protected $brand;
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getOfficer()
    {
        return $this->officer;
    }

    /**
     * @param int $officer
     */
    public function setOfficer($officer)
    {
        $this->officer = $officer;
    }

    /**
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @param string $remark
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    }

    /**
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * @param boolean $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }
    
}
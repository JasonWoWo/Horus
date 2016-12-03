<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/5
 * Time: 下午5:10
 */

namespace Horus\Models\Entity\Brand;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Horus\Models\Model\Brand\Brand as BaseBrand;

class Brand extends BaseBrand
{
    /**
     * 品牌的负责人
     * @var int
     */
    protected $officer = 0;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $remark = '';

    /**
     * @var Collection
     */
    protected $products;

    public function __construct()
    {
        parent::__construct();
        
        $this->products = new ArrayCollection();
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Collection $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }
    


}
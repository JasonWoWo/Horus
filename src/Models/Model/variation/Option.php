<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/3
 * Time: 下午7:47
 */

namespace Horus\Models\Model\Variation;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Horus\Models\Model\Product\Product;

class Option implements OptionInterface
{
    /**
     * 属性类的Id
     * @var int
     */
    protected $id;

    /**
     * 属性类的描述信息
     * @var string
     */
    protected $name;

    /**
     * 属性类的展示信息
     * @var string
     */
    protected $presentation;

    /**
     * 属性类的创建时间
     * @var \DateTime
     */
    protected $createAt;

    /**
     * 属性类的更新时间
     * @var \DateTime
     */
    protected $updateAt;
    
    /**
     * 属性类的删除时间
     * @var \DateTime
     */
    protected $deleteAt;

    /**
     * 属性类的权重
     * @var int
     */
    protected $priority;

    /**
     * 属性类关联的属性值
     * @var OptionValue
     */
    protected $optionValues;

    /**
     * 属性类关联的商品信息
     * @var Product
     */
    protected $product;
    
    public function __construct()
    {
        $this->createAt = new \DateTime();
        $this->updateAt = new \DateTime();
        $this->deleteAt = NULL;
        $this->optionValues = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;
        
        return $this;
    }

    public function getPresentation()
    {
        $this->presentation;
    }

    public function setOptionValues(Collection $optionValues)
    {
        $this->optionValues = $optionValues;

        return $this;
    }

    /**
     * @return ArrayCollection|OptionValue[]
     */
    public function getOptionValues()
    {
        return $this->optionValues;
    }

    /**
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @param \DateTime $createAt
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * @param \DateTime $updateAt
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;
    }

    /**
     * @return \DateTime
     */
    public function getDeleteAt()
    {
        return $this->deleteAt;
    }

    /**
     * @param \DateTime $deleteAt
     */
    public function setDeleteAt($deleteAt)
    {
        $this->deleteAt = $deleteAt;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
        return $this;
    }

}
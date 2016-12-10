<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/3
 * Time: 下午7:52
 */

namespace Horus\Models\Model\Variation;


class Variant implements VariantInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var VariantInterface
     */
    protected $object;

    /**
     * @var \DateTime
     */
    protected $updateAt;

    /**
     * @var \DateTime
     */
    protected $deleteAt;

    /**
     * @var OptionValueInterface
     */
    protected $options;
    
    public function __construct()
    {
        $this->updateAt = new \DateTime();
        $this->deleteAt = NULL;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }

    /**
     * @param OptionValueInterface $optionValue
     * @return $this
     */
    public function setObject(OptionValueInterface $optionValue)
    {
        $this->object = $optionValue;
        
        return $this;
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
     * @return $this
     */
    public function setUpdateAt(\DateTime $updateAt)
    {
        $this->updateAt = $updateAt;
        
        return $this;
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
    public function setDeleteAt(\DateTime $deleteAt)
    {
        $this->deleteAt = $deleteAt;
    }

    public function setOptions(OptionValueInterface $option)
    {
        $this->options = $option;
        
        return $this;
    }

    public function getOptions()
    {
        $this->options;
    }
}
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

class Option implements OptionInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $presentation;

    /**
     * @var \DateTime
     */
    protected $createAt;

    /**
     * @var \DateTime
     */
    protected $updateAt;
    
    /**
     * @var \DateTime
     */
    protected $deleteAt;

    /**
     * @var int
     */
    protected $priority;

    /**
     * @var OptionValue
     */
    protected $optionValues;
    
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

}
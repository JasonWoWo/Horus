<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/7
 * Time: 下午10:20
 */

namespace Horus\Models\Model\Product;


class Product
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
    protected $description;

    /**
     * @var \DateTime
     */
    protected $createOn;

    /**
     * @var \DateTime
     */
    protected $updateOn;

    /**
     * @var \DateTime
     */
    protected $availableOn;

    /**
     * @var \DateTime
     */
    protected $deleteAt;

    /**
     * @var string
     */
    protected $label = '';
    
    public function __construct()
    {
        $this->createOn = new \DateTime();
        $this->updateOn = new \DateTime();
        $this->availableOn = new \DateTime();
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
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return \DateTime
     */
    public function getCreateOn()
    {
        return $this->createOn;
    }

    /**
     * @param \DateTime $createOn
     */
    public function setCreateOn($createOn)
    {
        $this->createOn = $createOn;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateOn()
    {
        return $this->updateOn;
    }

    /**
     * @param \DateTime $updateOn
     */
    public function setUpdateOn($updateOn)
    {
        $this->updateOn = $updateOn;
    }

    /**
     * @return \DateTime
     */
    public function getAvailableOn()
    {
        return $this->availableOn;
    }

    /**
     * @param \DateTime $availableOn
     */
    public function setAvailableOn($availableOn)
    {
        $this->availableOn = $availableOn;
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
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
    
}
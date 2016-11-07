<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/5
 * Time: 下午5:13
 */

namespace Horus\Models\Model\Brand;


class Brand
{
    /**
     * @var int
     */
    protected $id;

    /**
     * 品牌的名称
     * @var string
     */
    protected $name = '';
    
    /**
     * 品牌的logo信息
     * @var string
     */
    protected $logo = '';

    /**
     * 品牌的创建时间
     * @var \DateTime
     */
    protected $createOn;

    /**
     * 品牌的更新时间
     * @var \DateTime
     */
    protected $updateOn;
    
    public function __construct()
    {
        $this->createOn = new \DateTime();
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
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
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
}
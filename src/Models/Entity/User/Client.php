<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/5
 * Time: 上午11:24
 */

namespace Horus\Models\Entity\User;


class Client
{
    public $id;

    /**
     * 客户的名字
     * @var string
     */
    public $name;

    /**
     * 客户的手机号码
     * @var string
     */
    public $phone;

    /**
     * 客户的备用电话号码
     * @var string
     */
    public $standbyPhone;

    /**
     * 客户的座机
     * @var string
     */
    public $telephone;

    /**
     * 客户的地址信息
     * @var string
     */
    public $address;

    /**
     * 客户创建时间
     * @var \DateTime
     */
    public $createOn;
    
    public function __construct()
    {
        $this->createOn = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getStandbyPhone()
    {
        return $this->standbyPhone;
    }

    /**
     * @param string $standbyPhone
     */
    public function setStandbyPhone($standbyPhone)
    {
        $this->standbyPhone = $standbyPhone;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
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
}
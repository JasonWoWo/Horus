<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/7/24
 * Time: 上午10:21
 */

namespace Horus\Models\Entity\Admin;

use Horus\Models\Entity\EntityInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Manager implements Authenticatable, JWTSubject, EntityInterface
{
    public static $genderMapping = array(
        0 => 'female',
        1 => 'male',
        2 => 'Unknown',
    );

    /**
     * @var int
     */
    public $id;

    /**
     * @var \DateTime
     */
    protected $createOn;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $avatar;

    /**
     * @var \DateTime
     */
    protected $visitOn;

    /**
     * @var int
     */
    protected $gender;

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

    public function getAuthIdentifier()
    {
        return $this->id;
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
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getAuthIdentifierName()
    {
        return 'id';
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getRememberToken()
    {
        return $this->getToken();
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function setRememberToken($value)
    {
        $this->token = $value;
    }

    public function getRememberTokenName()
    {
        return 'token';
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getAuthPassword()
    {
        return $this->getPassword();
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return \DateTime
     */
    public function getVisitOn()
    {
        return $this->visitOn;
    }

    /**
     * @param \DateTime $visitOn
     */
    public function setVisitOn($visitOn)
    {
        $this->visitOn = $visitOn;
    }

    /**
     * @return int
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param int $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getId();
    }

    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }


}
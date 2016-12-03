<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/13
 * Time: 下午1:56
 */

namespace Horus\Application\Components\HSPropertyComponent;


use Illuminate\Support\Collection;

class HsBuilder
{
    /* 编辑模式下不显示 */
    const MASK_NOT_EDIT = 0x0001;
    /* 创建模式下不显示 */
    const MASK_NOT_CREATE = 0x0002;
    /* 列表模式下不显示 */
    const MASK_NOT_LIST = 0x0004;

    /* 创建 编辑 列表模式下显示为图片 */
    const MASK_IS_IMAGE = 0x0008;
    
    const MAST_IS_SWITCH = 0x0010;

    const MASK_DISABLE_EDIT = 0x0020;
    /** @var  Collection */
    public $propertyCollection;

    public function __construct()
    {
        $this->propertyCollection = new Collection();
    }

    public function setProperty($name, $label, $mask = 0)
    {
        $property = new HsPropertyEntity();
        $property->setName($name);
        $property->setLabel($label);
        $property->setMask($mask);
        $this->propertyCollection->put($name, $property);
        return $this;
    }

    /**
     * @param $name
     * @return HsPropertyEntity
     */
    public function getProperty($name)
    {
        return $this->propertyCollection->get($name);
    }

    public function getPropertyCollection()
    {
        return $this->propertyCollection;
    }
}
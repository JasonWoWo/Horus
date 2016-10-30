<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/9/25
 * Time: 上午11:25
 */

namespace Horus\Application\Components\PropertyComponent;


use Illuminate\Support\Collection;

class FormPropertyBuilder 
{
    const RADIO_BUILDER = 'radio';
    const CHECKBOX_BUILDER = 'checkbox';
    
    /* 编辑模式下不显示 */
    const MASK_NOT_EDIT = 0x0001;
    /* 创建模式下不显示 */
    const MASK_NOT_CREATE = 0x0002;
    /* 列表模式下不显示 */
    const MASK_NOT_LIST = 0x0004;

    /* 创建 编辑 列表模式下显示为图片 */
    const MASK_IS_IMAGE = 0x0008;
    
    const MASK_DISABLE_EDIT = 0x0020;
    
    const MASK_LIST_IS_FAKE = 0x0010;
    
    /** @var  Collection $propertyCollection */
    public $propertyCollection;
    
    public function __construct()
    {
        $this->propertyCollection = new Collection();
    }

    public function setTextProperty($name, $label, $mask = 0)
    {
        $property = new TextProperty();
        $property->buildPropertyEntity($name, $label, $mask);
        $this->propertyCollection->put($name, $property);
    }
    
    public function setMultiProperty($name, $label, $mask, $type, $extraParams = array())
    {
        $property = new MultiProperty();
        $property->buildPropertyEntity($name, $label, $mask, $type, $extraParams);
        $this->propertyCollection->put($name, $property);
    }
    
    public function getPropertyCollection()
    {
        return $this->propertyCollection;
    }
    
}
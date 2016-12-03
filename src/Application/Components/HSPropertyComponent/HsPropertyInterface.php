<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/13
 * Time: 下午1:29
 */

namespace Horus\Application\Components\HSPropertyComponent;


interface HsPropertyInterface
{
    public function getName();
    
    public function setName($name);
    
    public function getLabel();
    
    public function setLabel($label);
    
    public function getPropertyValue();
    
    public function setPropertyValue($value);
    
    public function getMask();
    
    public function setMask($mask);
}
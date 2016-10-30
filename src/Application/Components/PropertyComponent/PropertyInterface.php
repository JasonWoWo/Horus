<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/9/25
 * Time: 上午11:07
 */

namespace Horus\Application\Components\PropertyComponent;


interface PropertyInterface
{
    public function getName();

    public function setValue($value);
    
    public function setType($type);
    
    public function getValue();

    public function getLabel();

    public function getType();
    
    public function getMask();
    
    public function buildPropertyEntity($name, $label, $mask, $type, $extraParams = array());
    
}
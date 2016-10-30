<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/9/25
 * Time: 上午11:09
 */

namespace Horus\Application\Components\PropertyComponent;


abstract class Property implements PropertyInterface
{
    protected $name;

    protected $label;

    protected $value = '';

    protected $type;
    
    protected $mask;
    
}
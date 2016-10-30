<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/9/25
 * Time: 上午11:12
 */

namespace Horus\Application\Components\PropertyComponent;


class TextProperty extends Property
{
    public $subType = '';
    
    public function setName($name = '')
    {
        $this->name = $name;
    }
    
    public function setLabel($label = '')
    {
        $this->label = $label;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
        if ($this->subType == 'datetime' || $this->subType == 'date') {
            $this->value = new \DateTime($value);
        }
    }
    
    public function setType($type = 'text')
    {
        $this->type = $type;
    }
    
    public function buildPropertyEntity($name, $label, $mask, $type = 'text', $extra = array())
    {
        $this->setLabel($label);
        $this->setName($name);
        $this->setMask($mask);
        $this->setType($type);
        return $this;
    }


    public function getName()
    {
        // TODO: Implement getName() method.
        return $this->name;
    }

    public function getValue()
    {
        if ($this->value instanceof \DateTime) {
            $this->value = $this->value->format('Y-m-d');
        }
        return $this->value;
    }

    public function getLabel()
    {
        // TODO: Implement getLabel() method.
        return $this->label;
    }

    public function getType()
    {
        // TODO: Implement getType() method.
        $this->type = 'text';
        return $this->type;
    }

    public function getMask()
    {
        // TODO: Implement getMask() method.
        return $this->mask;
    }

    /**
     * @return string
     */
    public function getSubType()
    {
        return $this->subType;
    }

    /**
     * @param string $subType
     */
    public function setSubType($subType = 'int')
    {
        $this->subType = $subType;
    }

    /**
     * @param mixed $mask
     */
    public function setMask($mask)
    {
        $this->mask = $mask;
    }
    
    

}
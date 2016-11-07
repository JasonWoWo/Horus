<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/9/25
 * Time: 上午11:42
 */

namespace Horus\Application\Components\PropertyComponent;


class MultiProperty extends Property
{
    public $extraParams = array();
    
    public $extraMapParams = array();

    public function getName()
    {
        // TODO: Implement getName() method.
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



    public function getValue($format = false)
    {
        // TODO: Implement getValue() method.
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }


    public function getLabel()
    {
        // TODO: Implement getLabel() method.
        return $this->label;
    }

    public function getType()
    {
        // TODO: Implement getType() method.
        return $this->type;
    }

    public function getMask()
    {
        // TODO: Implement getMask() method.
    }

    /**
     * @param mixed $mask
     */
    public function setMask($mask)
    {
        $this->mask = $mask;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getExtraParams()
    {
        return $this->extraParams;
    }

    /**
     * @param array $extraParams
     */
    public function setExtraParams($extraParams = array())
    {
        $this->extraMapParams = $extraParams;
        foreach ($extraParams as $value => $text) {
            $this->extraParams[] = array(
                'text' => $text,
                'value' => $value
            );
        }
    }
    
    public function getExtraMapParams()
    {
        return $this->extraMapParams;
    }
    
    public function buildPropertyEntity($name, $label, $mask, $type = 'radio', $extra = array())
    {
        $this->setName($name);
        $this->setLabel($label);
        $this->setMask($mask);
        $this->setType($type);
        $this->setExtraParams($extra);
    }


}
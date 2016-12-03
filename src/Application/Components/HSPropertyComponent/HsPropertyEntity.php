<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/13
 * Time: 下午1:26
 */

namespace Horus\Application\Components\HSPropertyComponent;


use Doctrine\DBAL\Types\Type;

class HsPropertyEntity implements HsPropertyInterface
{
    protected $name;
    
    protected $label;
    
    protected $mask;
    
    protected $hsPropertyValue;

    protected $attribute = '';
    
    protected $extraParams = array();
    
    protected $primevalExtraParams = array();
    
    const PROPERTY_TYPE_TEXT = 'text';
    const PROPERTY_TYPE_SWITCH = 'switch';
    const PROPERTY_TYPE_DATE = 'date';
    const PROPERTY_TYPE_SELECT = 'select';
    const PROPERTY_TYPE_CHECKBOX = 'checkbox';
    const PROPERTY_TYPE_RADIO = 'radio';
    
    const DOCTRINE_TYPE_MAPPING = array(
        Type::INTEGER => self::PROPERTY_TYPE_TEXT,
        Type::FLOAT => self::PROPERTY_TYPE_TEXT,
        Type::STRING => self::PROPERTY_TYPE_TEXT,
        Type::DATETIME => self::PROPERTY_TYPE_DATE,
        Type::DATE => self::PROPERTY_TYPE_DATE,
        Type::BOOLEAN => self::PROPERTY_TYPE_SWITCH,
    );

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getPropertyValue()
    {
        return $this->hsPropertyValue;
    }

    public function setPropertyValue($value)
    {
        $this->hsPropertyValue = $value;
    }

    public function getMask()
    {
        return $this->mask;
    }

    public function setMask($mask)
    {
        $this->mask = $mask;
    }
    
    public function hasMask($mask)
    {
        $isMask = false;
        if ($mask & $this->mask) {
            $isMask = true;
        }
        return $isMask;
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
    public function setRadioExtraParams($extraParams)
    {
        $this->attribute = 'radio';
        $this->extraParams = $this->buildExtraParams($extraParams);
    }
    
    public function setSelectExtraParam($extraParams)
    {
        $this->attribute = 'select';
        $this->extraParams = $this->buildExtraParams($extraParams);
    }

    public function setMultiExtraParams($extraParams)
    {
        $this->attribute = 'checkbox';
        $this->extraParams = $this->buildExtraParams($extraParams);
    }
    
    private function buildExtraParams($extraParams) 
    {
        $buildItems = array();
        $this->primevalExtraParams = $extraParams;
        foreach ($extraParams as $value => $text) {
            $buildItems[] = array(
                'text' => $text,
                'value' => $value
            );
        }
        return $buildItems;
    }

    public function buildAtomShowData($fieldType = '', $value)
    {
        if ($fieldType == Type::DATETIME || $fieldType == Type::DATE) {
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }
        } elseif ($fieldType == Type::SIMPLE_ARRAY) {
            $value = implode(',', $value);
        } elseif ($fieldType == Type::JSON_ARRAY) {
            $value = json_encode($value);
        } elseif (is_array($value)) {
            $value = implode(';', $value);
        } elseif ($fieldType == Type::BOOLEAN) {
            $value = empty($value) ? '关闭' : '开启';
        }
        if (in_array($this->attribute, [self::PROPERTY_TYPE_RADIO])) {
            $value = $this->primevalExtraParams[$value];
        }
        $this->setPropertyValue($value);
    }

    public function buildAtomFormData()
    {
        $params = array();
        $value = $this->getPropertyValue();
        if ($value instanceof \DateTime) {
            $value = $value->format('Y-m-d H:i:s');
        }
        $params['value'] = $value;
        if ($this->hasMask(HsBuilder::MAST_IS_SWITCH)) {
            $params['class'] = array('switch');
        }
        $params['label'] = $this->getLabel();
        $params['property_name'] = $this->getName();
        $params['disable'] = 0;
        $params['show'] = 1;
        if (!empty($this->extraParams)) {
            $params['options'] = $this->getExtraParams();
        }
        return $params;
    }

    /**
     * @return array
     */
    public function getPrimevalExtraParams()
    {
        return $this->primevalExtraParams;
    }

    /**
     * @return string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param string $fieldType
     */
    public function setAttribute($fieldType = '')
    {
        $tmpPropertyType = self::PROPERTY_TYPE_TEXT;
        if ($fieldType) {
            $tmpPropertyType = self::DOCTRINE_TYPE_MAPPING[$fieldType];
        }
        if (!$this->attribute) {
            $this->attribute = $tmpPropertyType;
        } 
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/9/25
 * Time: 下午7:54
 */

namespace Horus\Application\Service;


use Horus\Application\Components\PropertyComponent\FormPropertyBuilder;
use Horus\Application\Components\PropertyComponent\MultiProperty;
use Horus\Application\Components\PropertyComponent\Property;
use Horus\Application\Components\PropertyComponent\TextProperty;
use Horus\Models\Entity\EntityInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class FormatComponentService extends ApplicationService
{
    public static $formatEntity = '';

    /** @var FormPropertyBuilder  $propertyCollection */
    public static $propertyCollection;

    public static $exhibitDataItems = array(
        'token' => '',
        'field' => [],
        'items' => [],
    );

    public function setFormatEntity($entity = '')
    {
        self::$formatEntity = $entity;
    }

    public function setPropertyCollection(FormPropertyBuilder $formPropertyBuilder)
    {
        self::$propertyCollection = $formPropertyBuilder;
    }

    public function entityRepository()
    {
        return $this->getRepository(self::$formatEntity);
    }

    /**
     * 组装Exhibit展示数据
     * @return array
     */
    public function assembleExhibitData()
    {
        $entities = $this->entityRepository()->findAll();
        if (empty($entities)) {
            return self::$exhibitDataItems;
        }
        $collection = self::$propertyCollection->getPropertyCollection();
        $formatField = array();
        $collection->each(function (Property $property) use (&$formatField) {
            if (!($property->getMask() & FormPropertyBuilder::MASK_NOT_LIST)) {
                $formatField[] = $property->getLabel();
            }
        });
        self::$exhibitDataItems['token'] = $this->getCsrfToken();
        self::$exhibitDataItems['field'] = $formatField;
        self::$exhibitDataItems['items'] = $this->getPropertyExhibitItems($entities);
        return self::$exhibitDataItems;
    }

    /**
     * 组装Modify数据
     * @param $id
     * @return array
     */
    public function assembleEditDetail($id)
    {
        $entities[] = $this->entityRepository()->find($id);
        $contents = $this->getPropertyEditItem($entities);
        self::$exhibitDataItems['token'] = $this->getCsrfToken();
        self::$exhibitDataItems['items'] = $contents;
        return self::$exhibitDataItems;
    }
    
    public function assembleCreateDetail()
    {
        $contents = $this->getPropertyCreateItem();
        self::$exhibitDataItems['token'] = $this->getCsrfToken();
        self::$exhibitDataItems['items'] = $contents;
        return self::$exhibitDataItems;
        
    }

    /**
     * 组装Commit数据
     * @param $id
     * @return boolean
     */
    public function assembleCommitDetail($id = null)
    {
        if (is_null($id)) {
            $entityString = $this->entityRepository()->entity();
            $entity = new $entityString;
        } else {
            $entity = $this->entityRepository()->find($id);
        }
        $entities[] = $entity;
        return $this->getPropertyCommitItem($entities);
    }
    
    public function getPropertyExhibitItems($entities)
    {
        $formatItems = array();
        $collection = self::$propertyCollection->getPropertyCollection();
        /** @var  EntityInterface $entity */
        foreach ($entities as $entity) {
            $collection->each(function (Property $property, $name) use ($entity, &$formatItems) {
                $mappingValue = $this->_getMethod($entity, $name);
                $property->setValue($mappingValue);
            });
            $formatItems[] = $this->getFormatExhibitItems($collection);
        }
        return $formatItems;
    }

    // 数据组装
    public function getFormatExhibitItems(Collection $collection)
    {
        $propertyItems = $collection->all();
        $list = array();
        /** @var Property $property */
        foreach ($propertyItems as $property) {
            if ($property->getMask() & FormPropertyBuilder::MASK_NOT_LIST) {
                continue;
            }
            $value = $property->getValue();
            if ($property instanceof MultiProperty) {
                $value = $property->getExtraMapParams()[$property->getValue()];
            }
            $list[$property->getName()] = $value;
        }
        return $list;
    }

    public function getPropertyEditItem($entities)
    {
        $items = array();
        $collection = self::$propertyCollection->getPropertyCollection();
        foreach ($entities as $entity) {
            $collection->each(function (Property $property, $name) use (&$items, $entity) {
                $propertyType = $property->getType();
                if (empty($items[$propertyType])) {
                    $items[$propertyType] = array();
                }
                $mappingValue = $this->_getMethod($entity, $name);
                $property->setValue($mappingValue);
                $items[$propertyType][] = $this->assembleEditAtomicData($property);
            });
        }
        return $items;
    }
    
    public function getPropertyCreateItem()
    {
        $collection = self::$propertyCollection->getPropertyCollection();
        $items = array();
        $collection->each(function (Property $property) use (&$items) {
            $propertyType = $property->getType();
            if (empty($items[$propertyType])) {
                $items[$propertyType] = array();
            }
            if (!($property->getMask() & FormPropertyBuilder::MASK_NOT_CREATE)) {
                $items[$propertyType][] = $this->assembleEditAtomicData($property);
            }
        });
        return $items;
    }

    public function assembleEditAtomicData(Property $property)
    {
        $params = array(
            'value' => $property->getValue(),
            'label' => $property->getLabel(),
            'property_name' => $property->getName(),
            'disable' => 0,
            'show' => 1,
        );
        if ($property->getMask() & FormPropertyBuilder::MASK_DISABLE_EDIT) {
            $params['disable'] = 1;
        }
        if ($property->getMask() & FormPropertyBuilder::MASK_NOT_EDIT) {
            $params['show'] = 0;
        }
        if ($property instanceof MultiProperty) {
            $params['options'] = $property->getExtraParams();
        }
        return $params;
    }

    public function setPropertyForRequestItem(Request $request)
    {
        $collection = self::$propertyCollection->getPropertyCollection();
        $collection->each(function (Property $property, $name) use ($request) {
            $classMeta = $this->_getMethodProperty();
            $subType = $classMeta->getTypeOfField($name);
            if ($property instanceof TextProperty) {
                $property->setSubType($subType);
            }
            $value = $request->get($name);
            $property->setValue($value);
        });
    }
    
    public function getPropertyCommitItem($entities)
    {
        $collection = self::$propertyCollection->getPropertyCollection();
        foreach ($entities as $entity) {
            $collection->each(function (Property $property, $name) use ($entity) {
                $value = $property->getValue();
                $this->_setMethod($entity, $name, $value);
            });
            $this->getEntityManager()->persist($entity);
        }
        try {
            $this->getEntityManager()->flush();
            return true;
        } catch (\Exception $e) {
            return false;
        }
        
    }

    // 获取属性的对应的方法
    public function _getMethod($processEntity, $name)
    {
        $name = 'get' . ucfirst($name);
        if (!method_exists($processEntity, $name)) {

        }
        return $processEntity->$name();
    }

    public function _setMethod($processEntity, $name, $value)
    {
        $name = 'set' . ucfirst($name);
        if (!method_exists($processEntity, $name)) {

        }
        $processEntity->$name($value);
    }

    // 获取实体属性的类型
    public function _getMethodProperty()
    {
        return $this->getEntityManager()->getClassMetadata($this->entityRepository()->entity());
    }
    
    private function getCsrfToken()
    {
        return csrf_token();
    }
}
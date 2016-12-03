<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/10
 * Time: 下午10:28
 */

namespace Horus\Application\Service;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\ClassMetadata;
use Horus\Application\Components\HSPropertyComponent\HsBuilder;
use Horus\Application\Components\HSPropertyComponent\HsPropertyEntity;
use Symfony\Component\HttpFoundation\Request;

class FormatService extends ApplicationService
{
    const STATUS_CREATE_METHOD = 1;
    const STATUS_EDIT_METHOD = 2;
    const STATUS_DELETE_METHOD = 3;
    const STATUS_RETRIEVE_METHOD = 4;

    public static $formatEntity = '';

    /** @var  HsBuilder */
    public static $hsBuilder;

    public static $statusMethod = 0;

    /**
     * 参数过滤条件
     * @var array
     */
    public $filtration = array();

    public static $exhibitDataItems = array(
        'token' => '',
        'field' => [],
        'items' => [],
    );

    public function setFormatEntity($entity = '')
    {
        self::$formatEntity = $entity;
    }

    public function entityRepository()
    {
        return $this->getRepository(self::$formatEntity);
    }
    
    public function setHsBuilder(HsBuilder $builder)
    {
        self::$hsBuilder = $builder;
    }

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

    public function getPropertyMetaData($entity = null)
    {
        if (is_null($entity)) {
            $entity = $this->entityRepository()->entity();
        }
        return $this->getEntityManager()->getClassMetadata($entity);
    }

    public function initialize(Request $request)
    {
        $queryParams = $request->query->all();
        foreach ($queryParams as $key => $filterValue) {
            $propertyName = str_replace('_', '.', $key);
            $this->filtration[$propertyName] = $filterValue;
        }
    }

    /**
     * exhibition the Items
     * @return array
     */
    public function exhibitionEntities()
    {
        $entities = $this->entityRepository()->findAll();
        if (empty($entities)) {
            return self::$exhibitDataItems;
        }
        $field = array();
        $classMeta = $this->getPropertyMetaData();
        foreach ($entities as $entity) {
            $entityItems = array();
            self::$hsBuilder->getPropertyCollection()->each(
                function (HsPropertyEntity $property, $name) use (&$field, &$entityItems, $entity, $classMeta) {
                    if ($property->hasMask(HsBuilder::MASK_NOT_LIST)) {
                        return false;
                    }
                    $label = $property->getLabel();
                    if (!in_array($label, $field)) {
                        $field[] = $property->getLabel();
                    }
                    if (strpos($name, '.') === false) {
                        $mappingValue = $this->_getMethod($entity, $name);
                        $type = $classMeta->getTypeOfField($name);
                    } else {
                        list($assEntityName, $assPropertyName) = explode('.', $name);
                        $assEntityObject = $this->_getMethod($entity, $assEntityName);
                        $targetClassMeta = $this->getPropertyMetaData($classMeta->getAssociationTargetClass($assEntityName));
                        $type = $targetClassMeta->getTypeOfField($assPropertyName);
                        $mappingValue = $this->_getMethod($assEntityObject, $assPropertyName);
                    }
                    $property->buildAtomShowData($type, $mappingValue);
                    $mappingValue = $property->getPropertyValue();
                    $entityItems[$property->getName()] = $mappingValue;
                }
            );
            self::$exhibitDataItems['items'][] = $entityItems;
        }
        self::$exhibitDataItems['token'] = $this->getCsrfToken();
        self::$exhibitDataItems['field'] = $field;
        return self::$exhibitDataItems;
    }

    public function getDisplayContentForProperty(HsPropertyEntity $property, $value, $fieldType)
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
        } elseif ($property->hasMask(HsBuilder::MAST_IS_SWITCH)) {
            $value = empty($value) ? '关闭' : '开启';
        }
        return $value;
    }

    public function setPropertyForRequestItem(Request $request)
    {
        $collection = self::$hsBuilder->getPropertyCollection();
        $collection->each(function (HsPropertyEntity $property, $name) use ($request) {
            $value = $request->get($name);
            $property->setPropertyValue($value);
        });
    }
    

    public function storeEntity($id = null)
    {
        $entityObject = null;
        if (!is_null($id)) {
            $entityObject = $this->entityRepository()->find($id);
        }
        $isUpdate = $entityObject != null;
        $entityName = $this->entityRepository()->entity();
        if (!$isUpdate) {
            $entityObject = new $entityName;
        }
        self::$hsBuilder->getPropertyCollection()->each(
            function (HsPropertyEntity $property, $name) use (&$entityObject) {
                $submitValue = $property->getPropertyValue();
                $submitRet = $this->setUpPropertySubmitValue($entityObject, $name, $submitValue);
                if ($submitRet !== true) {
                    
                }
            }
        );
        try {
            $this->getEntityManager()->persist($entityObject);
            $this->getEntityManager()->flush($entityObject);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
    
    public function setUpPropertySubmitValue(&$entityObject = null, $propertyName = '', $submitValue)
    {
        $classMeta = $this->getPropertyMetaData();
        if (strpos($propertyName, '.') === false) {
            $type = $classMeta->getTypeOfField($propertyName);
            $submitValue = $this->getRealFieldValue($submitValue, $type);
            if ($submitValue !== false) {
                $this->_setMethod($entityObject, $propertyName, $submitValue);
            }
        } else {
            list($assEntityName, $assPropertyName) = explode('.', $propertyName);
            $targetClass = $classMeta->getAssociationTargetClass($assEntityName);
            $targetClassMeta = $this->getPropertyMetaData($targetClass);
            $map = $classMeta->getAssociationMapping($assEntityName);
            $isManyToOne = $map['type'] & ClassMetadata::MANY_TO_ONE;
            $isOneToOne = $map['type'] & ClassMetadata::ONE_TO_ONE;
            if ($isManyToOne) {
                $assEntity = $this->_getMethod($entityObject, $assEntityName);
                if ($assEntity == null || $assEntity->getId() != $submitValue) {
                    $assEntity = $this->getEntityManager()->getRepository($targetClass)
                        ->findOneBy(array($targetClassMeta->getSingleIdentifierFieldName() => $submitValue));
                }
                $this->_setMethod($entityObject, $assEntityName, $assEntity);
            } elseif ($isOneToOne) {

            }
        }
        return true;
    }

    public function getRealFieldValue($value, $fieldType)
    {
        if ($fieldType == Type::DATETIME || $fieldType == Type::DATE) {
            if (is_null($value) || $value == '') {
                
            }
            $value = new \DateTime($value);
        } elseif ($fieldType == Type::BOOLEAN) {
            $value = empty($value) ? 0 : 1;
        } elseif (in_array($fieldType, array(Type::INTEGER, Type::SMALLINT, Type::BIGINT, Type::DECIMAL))) {
            if($value === null){
                return false;
            }
            if ($value === '' OR $value === false) {
                //为了解决提交某个字段为空的情况./coupon/mgr/edit/900?tab__=0 中scopeGoodsId
                return 0;
            }
        } elseif ($fieldType == Type::STRING || $fieldType == Type::TEXT) {
            if ($value === null OR $value === false) {
                $value = '';
            }
        } elseif ($fieldType == Type::JSON_ARRAY) {
            $value = json_decode($value);
        } elseif ($fieldType == Type::SIMPLE_ARRAY) {
            if (!$value) {
                $value = array();
            }
        }
        return $value;
    }

    /**
     * 获取编辑列表详情
     * Get Form Items Detail
     * @param null $id
     * @return array
     */
    public function formEntrance($id = null)
    {
        if (is_null($id)) {
            $entity = null;
        } else {
            $entity = $this->entityRepository()->find($id);
        }
        self::$exhibitDataItems['token'] = $this->getCsrfToken();
        self::$exhibitDataItems['items'] = $this->rubikCub($entity);
        return self::$exhibitDataItems;
    }
    
    // Create Or Edit Form
    public function rubikCub($entityObject = null)
    {
        $isUpdate = $entityObject != null;
        $items = array();
        $collection = self::$hsBuilder->getPropertyCollection();
        $classMeta = $this->getPropertyMetaData();
        $collection->each(function (HsPropertyEntity $property, $name) use ($isUpdate, $entityObject, &$items, $classMeta) {
            $entityName = $this->entityRepository()->entity();
            if ($name == $classMeta->getSingleIdentifierFieldName()) {
                return 0;
            }
            if (empty($isUpdate)) {
                $defaultEntityObject = new $entityName;
            }
            if (strpos($name, '.') === false) {
                $mappingValue = $isUpdate ? $this->_getMethod($entityObject, $name) : $this->_getMethod($defaultEntityObject, $name);
                $type = $classMeta->getTypeOfField($name);
                $property->setAttribute($type);
            } else {
                list($assEntityName, $assProperty) = explode('.', $name);
                $map = $classMeta->getAssociationMapping($assEntityName);
                $assEntityObject = $this->_getMethod($entityObject, $assEntityName);
                $targetClassMeta = $this->getPropertyMetaData($map['targetEntity']);
                $type = $targetClassMeta->getTypeOfField($assProperty);
                $property->setAttribute($type);
                $mappingValue = $this->_getMethod($assEntityObject, $targetClassMeta->getSingleIdentifierFieldName());
                $isManyToOne = $map['type'] & ClassMetadata::MANY_TO_ONE;
                $isManyToMany = $map['type'] & ClassMetadata::MANY_TO_MANY;
                $isOneToMany = $map['type'] & ClassMetadata::ONE_TO_MANY;
                $isOneToOne = $map['type'] & ClassMetadata::ONE_TO_ONE;
                if (isset($this->filtration[$name])) {
                    $mappingValue = $this->filtration[$name];
                }
                if ($isManyToOne) {
                    $choseSource = $this->getSelectItemOnAssociateProperty($assEntityName, $assProperty);
                    $property->setSelectExtraParam($choseSource);
                } elseif ($isManyToOne) {

                } elseif ($isManyToMany) {

                } elseif ($isOneToOne) {

                } elseif ($isOneToMany) {

                } else {

                }
            }
            $propertyType = $property->getAttribute();
            if (empty($items[$propertyType])) {
                $items[$propertyType] = array();
            }
            $property->setPropertyValue($mappingValue);
            $items[$propertyType][] = $property->buildAtomFormData();
        });
        return $items;
    }
    
    public function getSelectItemOnAssociateProperty($assEntity, $assProperty)
    {
        $classMeta = $this->getPropertyMetaData();
        $targetEntity = $classMeta->getAssociationTargetClass($assEntity);
        $alias = substr($assEntity, 1, 4);
        $targetEntityClassMeta = $this->getPropertyMetaData($targetEntity);
        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select(
            array(
                $alias. ".". $targetEntityClassMeta->getSingleIdentifierFieldName(),
                $alias. ".". $assProperty,
            ))->from($targetEntity, $alias);
        $choseSource = array();
        $result = $query->getQuery()->getArrayResult();
        foreach ($result as $item) {
            $value = $item[$targetEntityClassMeta->getSingleIdentifierFieldName()];
            $choseSource[$value] = $item[$assProperty];
        }
        return $choseSource;
    }

    /**
     * @param string $key
     * @return HsPropertyEntity
     */
    public function getPropertyEntity($key = '')
    {
        return self::$hsBuilder->getPropertyCollection()->get($key);
    }

    private function getCsrfToken()
    {
        return csrf_token();
    }
}
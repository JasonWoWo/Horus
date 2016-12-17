<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/10
 * Time: 下午3:18
 */

namespace Horus\Application\Service;


use Horus\Models\Entity\Product\ProductOption;
use Horus\Models\Entity\Product\ProductOptionValue;
use Horus\Models\Entity\Product\ProductRepositoryInterface;
use Horus\Models\Entity\Product\ProductOptionRepositoryInterface AS ProductOptionRepo;
use Horus\Models\Entity\Product\ProductOptionValueRepositoryInterface AS ProductOptionValueRepo;
use Horus\Models\Entity\Product\ProductVariantRepositoryInterface AS ProductVariantRepo;
use Horus\Models\Entity\Product\Product;
use Horus\Models\Entity\Product\ProductVariant;

class ProductService extends ApplicationService
{
    protected $productRepository;

    protected $productOptionRepo;
    
    protected $productOptionValueRepo;
    
    protected $productVariantRepo;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        ProductOptionRepo $productOptionRepo,
        ProductOptionValueRepo $productOptionValueRepo,
        ProductVariantRepo $productVariantRepo
    )
    {
        $this->productRepository = $productRepo;
        $this->productOptionRepo = $productOptionRepo;
        $this->productOptionValueRepo = $productOptionValueRepo;
        $this->productVariantRepo = $productVariantRepo;
    }

    /**
     * 获取有效的商品的详情
     * @param $id
     * @return Product
     */
    public function getValidateProduct($id)
    {
        return $this->productRepository->getProductById($id);
    }

    public function getBundleOptions(Product $product)
    {
        $optionResult = array();
        $options = $this->productOptionRepo->getProductOptions($product);
        if (!$options) {
            return false;
        }
        foreach ($options as $option) {
            $optionItem = array();
            $optionItem['label'] = $option->getPresentation();
            $optionItem['name'] = $option->getId();
            $optionValues = $option->getOptionValues();
            $optionValueItem = array();
            foreach ($optionValues as $valueItem) {
                $optionValueItem[] = [
                    'value' => $valueItem->getId(),
                    'label' => $valueItem->getValue(),
                ];
            }
            $optionItem['items'] = $optionValueItem;
            $optionResult[] = $optionItem;
        }
        return $optionResult;
    }

    public function getBundleVariants(Product $product)
    {
        $variantItems = array();
        $variants = $product->getVariants();
        if (!$variants) {
            return $variantItems;
        }
        foreach ($variants as $variant) {
            $variantDetail[$variant->getSku()] = [
                'price' => $variant->getPrice(),
                'oriPrice' => $variant->getOriPrice(),
                'stock' => $variant->getOnHand(),
                'image' => $variant->getImage(),
            ];
        }
        return $variantItems;
    }
    
    public function bundlesOnSave(Product $product, $bundles = array())
    {
        $optObjArr = array();
        $needOptIds = array();
        $optValueArr = array();
        $haveValObjects = array();
        $needValIds = array();
        $options = $bundles['options'];
        foreach ($options as $option) {
            $optName = trim($option['name']);
            $optLabel = trim($option['label']);
            if (isset($optObjArr[$optName])) {
                $optObj = $optObjArr[$optName];
            } elseif (is_numeric($optName)) {
                /** @var ProductOption $optObj */
                $optObj = $this->productOptionRepo->find($optName);
//                $optObj = $this->getEntityManager()->find($this->productOptionRepo->entity(), $optName);
                if (!$optObj) {
                    continue;
                }
                $optObj->setDeleteAt(Null);
            } else {
//                $optObj= $this->productOptionRepo->findOneBy(['product' => $product, 'presentation' => $optLabel]);
                $optObj = $this->getEntityManager()
                    ->getRepository($this->productOptionRepo->entity())
                    ->findOneBy(['product' => $product, 'presentation' => $optLabel], ['id' => 'DESC']);
                if ($optObj) {
                    $optObj->setDeleteAt(NULL);
                } else {
                    $optObj = new ProductOption();
                    $optObj->setProduct($product);
                }
            }
            $optObjArr[$optName] = $optObj;
            $optObj->setName($optLabel);
            $optObj->setPresentation($optLabel);
            $optObj->setPriority(100);
            $this->productOptionRepo->saveEntity($optObj);
//            $this->getEntityManager()->persist($optObj);

            if ($optObj->getId()) {
                $needOptIds[] = $optObj->getId();
            }
            $bundleOptionValueObjects = $optObj->getOptionValues();
            foreach ($bundleOptionValueObjects as $optionValue) {
                $haveValObjects[$optName][$optionValue->getId()] = $optionValue;
            }

            foreach ($option['items'] as $item) {
                $optionValueVal = trim($item['value']);
                $optionValueLabel = trim($item['label']);

//                $this->getEntityManager()->getFilters()->disable('soft-deleteable');
                if (isset($optValueArr[$optName][$optionValueVal])) {
                    $optionValueObject = $optionValueVal[$optName][$optionValueVal];
                } elseif (is_numeric($optionValueVal)) {
                    /** @var ProductOptionValue $optionValueObject */
                    $optionValueObject = $this->productOptionValueRepo->find($optionValueVal);
                    if (!$optionValueObject) {
                        continue;
                    }
                    $optionValueObject->setDeleteAt(null);
                } else {
                    $optionValueObject = null;
                    if ($optObj->getId()) {
                        $optionValueObject = $this->productOptionValueRepo->findOneBy(['option' => $optObj, 'value' => $optionValueLabel]);
                    }
                    if ($optionValueObject) {
                        $optionValueObject->setDeleteAt(null);
                    } else {
                        $optionValueObject = new ProductOptionValue();
                        $optionValueObject->setOption($optObj);
                    }
                }
//                $this->getEntityManager()->getFilters()->enable('soft-deleteable');
                $optValueArr[$optName][$optionValueVal] = $optionValueObject;
                $optionValueObject->setValue($optionValueLabel);
                $optionValueObject->setPriority(100);
                $this->productOptionValueRepo->saveEntity($optionValueObject);
//                $this->getEntityManager()->persist($optionValueObject);
                if ($optionValueObject->getId()) {
                    $needValIds[$optName][$optionValueObject->getId()] = 1;
                }
            }
        }
        foreach ($haveValObjects as $optionName => $optionValueArr) {
            foreach ($optionValueArr as $optionValueId => $optionValueObject) {
                if (!isset($needValIds[$optionName][$optionValueId])) {
                    $this->productOptionValueRepo->removeEntity($optionValueObject);
                }
            }
        }

        /** @var ProductOption[] $haveOptionObject */
        $haveOptionObject = $this->productOptionRepo->findBy(['product' => $product]);
        foreach ($haveOptionObject as $optionObject) {
            if (!in_array($optionObject->getId(), $needOptIds)) {
                $this->productOptionRepo->removeEntity($optionObject);
            }
        }

        $needSkuIds = array();
        $haveSkuObjects = $product->getVariants()->toArray();

        $variants = $bundles['variants'];
        foreach ($variants as $sku => $variant) {
            $optionValueItems = array();
            $attrItems = explode(';', $sku);
            foreach ($attrItems as $attrDetail) {
                $pair = explode(':', $attrDetail);
                if (count($pair) != 2) {
                    return false;
                }
                $optionValueItems[] = $optValueArr[trim($pair[0])][trim($pair[1])];
            }
            $sku = ProductVariant::buildSku($optionValueItems);
            
//            $this->getEntityManager()->getFilters()->disable('soft-deleteable');
            /** @var ProductVariant $skuObject */
            $skuObject = $this->productVariantRepo->findOneBy(['sku' => $sku, 'object' => $product]);
//            $this->getEntityManager()->getFilters()->enable('soft-deleteable');

            $price = trim($variant['price']);
            if ($skuObject) {
                $skuObject->setDeleteAt(NULL);

            } else {
                $skuObject = new ProductVariant();
                $skuObject->setObject($product);
            }
            $skuObject->getOptions()->clear();
            foreach ($optionValueItems as $optionValueObject) {
                $skuObject->addOption($optionValueObject);
            }
            $skuObject->setPrice($price);
            $oriPrice = trim($variant['oriPrice']);
            if ($oriPrice && $oriPrice >= $price) {
                $skuObject->setOriPrice($oriPrice);
            }
            $stock = isset($variant['stock']) ? intval($variant['stock']) : 0;
            $skuObject->setOnHand($stock);
            
            $img = $variant['img'];
            $skuObject->setImage($img);

            $skuObject->setSold(0);

            $skuObject->setSku($sku);
            $skuObject->setUpdateAt(new \DateTime());

            $this->productVariantRepo->saveEntity($skuObject);
            $needSkuIds[] = $skuObject->getId();
        }
        foreach ($haveSkuObjects as $skuObject) {
            if (!in_array($skuObject->getId(), $needSkuIds)) {
                $this->productVariantRepo->removeEntity($skuObject);
            }
        }
    }
}
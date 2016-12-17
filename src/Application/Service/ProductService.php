<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/10
 * Time: 下午3:18
 */

namespace Horus\Application\Service;


use Horus\Models\Entity\Product\ProductRepositoryInterface;
use Horus\Models\Entity\Product\ProductOptionRepositoryInterface AS ProductOptionRepo;
use Horus\Models\Entity\Product\Product;

class ProductService extends ApplicationService
{
    protected $productRepository;

    protected $productOptionRepo;

    public function __construct(ProductRepositoryInterface $productRepo, ProductOptionRepo $productOptionRepo)
    {
        $this->productRepository = $productRepo;
        $this->productOptionRepo = $productOptionRepo;
    }

    /**
     * 获取有效的商品的详情
     * @param $id
     * @return mixed
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
}
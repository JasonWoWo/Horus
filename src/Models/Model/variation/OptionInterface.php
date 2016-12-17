<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/10
 * Time: 上午10:49
 */

namespace Horus\Models\Model\Variation;


use Doctrine\Common\Collections\Collection;
use Horus\Models\Model\Product\Product;

interface OptionInterface
{
    /**
     * Get Option's Id
     * @return int
     */
    public function getId();

    /**
     * Set Option's Name
     * @param $name
     */
    public function setName($name);

    /**
     * Get Option's Name
     * @return string
     */
    public function getName();

    /**
     * Set Option's Presentation
     * @param $presentation
     */
    public function setPresentation($presentation);

    /**
     * Get Option's Presentation
     * @return mixed
     */
    public function getPresentation();

    /**
     * Update Option's OptionValues
     * @param Collection $optionValues
     * @return mixed
     */
    public function setOptionValues(Collection $optionValues);

    /**
     * Obtain option's OptionValue Items
     * @return OptionValueInterface[]
     */
    public function getOptionValues();

    /**
     * Set option's Update Time
     * @param $updateOn
     * @return mixed
     */
    public function setUpdateAt($updateOn);

    /**
     * Get option's Update Time
     * @return mixed
     */
    public function getUpdateAt();

    /**
     * Set Option Delete Time
     * @param $deleteAt
     * @return mixed
     */
    public function setDeleteAt($deleteAt);

    /**
     * @param Product $product
     * @return OptionInterface
     */
    public function setProduct(Product $product);

    /**
     * @return Product
     */
    public function getProduct();
}
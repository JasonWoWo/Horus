<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/3
 * Time: 下午8:08
 */

namespace Horus\Models\Model\Variation;


use Doctrine\Common\Collections\ArrayCollection;
use Horus\Models\Model\Product\Product;

interface VariantInterface
{
    /**
     * Set VariantId
     * @param $id
     */
    public function setId($id);

    /**
     * Obtain Variant Id
     * @return int
     */
    public function getId();

    /**
     * Set Variant relate Product
     * @param Product $product
     */
    public function setObject(Product $product);

    /**
     * Set Variant Update time
     * @param \DateTime $update
     */
    public function setUpdateAt(\DateTime $update);

    /**
     * Set Variant Delete time
     * @param \DateTime $deleteAt
     */
    public function setDeleteAt(\DateTime $deleteAt);

    /**
     * Set Option link OptionValue Items
     * @param OptionValueInterface $option
     */
    public function setOptions(OptionValueInterface $option);

    /**
     * Obtain OptionValue Items
     * @return OptionValueInterface[]|ArrayCollection
     */
    public function getOptions();

    /**
     * Check Option contain OptionValue Item
     * @param OptionValueInterface $option
     * @return bool
     */
    public function hasOption(OptionValueInterface $option);

    /**
     * Remove Option Contain OptionValue Item
     * @param OptionValueInterface $option
     */
    public function removeOption(OptionValueInterface $option);

    /**
     * Add OptionValue To Option 
     * @param OptionValueInterface $option
     */
    public function addOption(OptionValueInterface $option);
}
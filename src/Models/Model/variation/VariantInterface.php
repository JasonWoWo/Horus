<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/3
 * Time: 下午8:08
 */

namespace Horus\Models\Model\Variation;


interface VariantInterface
{
    public function setId($id);
    
    public function getId();

    public function setObject(OptionValueInterface $optionValue);

    public function setUpdateAt(\DateTime $update);

    public function setDeleteAt(\DateTime $deleteAt);
    
    public function setOptions(OptionValueInterface $option);
    
    public function getOptions();
}
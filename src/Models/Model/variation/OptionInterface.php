<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/10
 * Time: 上午10:49
 */

namespace Horus\Models\Model\Variation;


use Doctrine\Common\Collections\Collection;

interface OptionInterface
{
    public function getId();

    public function setName($name);

    public function getName();

    public function setPresentation($presentation);

    public function getPresentation();
    
    public function setOptionValues(Collection $optionValues);
    
    public function getOptionValues();

    public function setUpdateAt($updateOn);

    public function getUpdateAt();

    public function setDeleteAt($deleteAt);
}
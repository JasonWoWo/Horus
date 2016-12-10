<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/12/10
 * Time: 上午10:45
 */

namespace Horus\Models\Model\Variation;


interface OptionValueInterface
{
    public function getId();

    public function getOption();

    public function setOption(OptionInterface $option);

    public function setValue($value);

    public function getValue();
}
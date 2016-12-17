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
    /**
     * Get OptionValue's Id
     * @return mixed
     */
    public function getId();

    /**
     * Obtain the OptionValue's Option
     * @return mixed
     */
    public function getOption();

    /**
     * Set OptionValue's Option
     * @param OptionInterface $option
     */
    public function setOption(OptionInterface $option);

    /**
     * Set OptionValue's value
     * @param $value
     */
    public function setValue($value);

    /**
     * Get OptionValue's value
     * @return string
     */
    public function getValue();
}
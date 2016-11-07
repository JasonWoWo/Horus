<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 2016/11/5
 * Time: 下午5:29
 */

namespace Horus\Comprehend\Repository\Brand;

use Horus\Comprehend\Repository\DoctrineRepository as BaseMappingRepository;
use Horus\Models\Entity\Brand\Brand;
use Horus\Models\Entity\Brand\BrandRepositoryInterface;

class BrandRepository extends BaseMappingRepository implements BrandRepositoryInterface
{
    public function entity()
    {
        // TODO: Implement entity() method.
        return Brand::class;
    }

}
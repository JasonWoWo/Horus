<?php

return [
    'repositoryMapping' => [
        Horus\Models\Entity\Admin\ManagerRepositoryInterface::class => Horus\Comprehend\Repository\Account\ManagerRepository::class,
        Horus\Models\Entity\User\ClientRepositoryInterface::class => Horus\Comprehend\Repository\Client\ClientRepository::class,
        Horus\Models\Entity\Brand\BrandRepositoryInterface::class => Horus\Comprehend\Repository\Brand\BrandRepository::class,
        Horus\Models\Entity\Product\ProductRepositoryInterface::class => \Horus\Comprehend\Repository\Product\ProductRepository::class,
        Horus\Models\Entity\Product\ProductOptionRepositoryInterface::class => Horus\Comprehend\Repository\Product\ProductOptionRepository::class,
    ],
];
<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/7/29
 * Time: 下午9:16
 */

namespace Horus\Application\Service;


use Horus\Models\Entity\Admin\Manager;
use Horus\Models\Entity\Admin\ManagerRepositoryInterface;

class ManagerAccountService extends ApplicationService
{
    public $managerRepository;

    public function __construct(ManagerRepositoryInterface $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }

    public function registerFreshManagerAccount($username, $phone, $password, $email, $gender)
    {
        /** @var Manager $freshManagerAccount */
        $freshManagerAccount = $this->managerRepository->createFreshEntity();
        $freshManagerAccount->setUsername($username);
        $freshManagerAccount->setEmail($email);
        $freshManagerAccount->setPassword($password);
        $freshManagerAccount->setPhone($phone);
        $freshManagerAccount->setGender($gender);
        try {
            $this->managerRepository->saveEntity($freshManagerAccount);
            return $freshManagerAccount;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
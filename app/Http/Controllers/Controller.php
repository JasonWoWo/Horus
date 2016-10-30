<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Lavary\Menu\Builder;
use Lavary\Menu\Item;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public $formatService;

    public function __construct()
    {

    }

    /**
     * @param $repositoryClass
     * @return \Horus\Models\Entity\RepositoryInterface
     */
    public function getRepository($repositoryClass)
    {
        return app($repositoryClass);
    }

    public function registerSideBarMenu()
    {
    }
}

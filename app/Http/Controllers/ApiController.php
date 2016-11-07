<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/9/10
 * Time: 下午4:17
 */

namespace App\Http\Controllers;


use Horus\Application\Service\FormatComponentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

abstract class ApiController extends Controller
{
    public $formatService;
    
    public function __construct(FormatComponentService $format)
    {
        parent::__construct();
        $this->formatService = $format;
    }

    /**
     * Add Entity related property
     */
    abstract function buildPropertyCollection();
    
    public function homeView()
    {
        return view('home');
    }

    /**
     * Exhibition the data related to entity
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->buildPropertyCollection();
        $data = $this->formatService->assembleExhibitData();
        return $this->getFormatJson($data);
    }

    /**
     * Edit the modify data
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $this->buildPropertyCollection();
        $data = $this->formatService->assembleEditDetail($id);
        return $this->getFormatJson($data);
    }

    /**
     * Create the new entity link the property
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->buildPropertyCollection();
        $data = $this->formatService->assembleCreateDetail();
        return $this->getFormatJson($data);
    }

    /**
     * Update the Entity
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->buildPropertyCollection();
        $this->formatService->setPropertyForRequestItem($request);
        $success = $this->formatService->assembleCommitDetail($id);
        return $this->getFormatJson(compact('success'));
    }

    /**
     * Through the post method And store the message
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->buildPropertyCollection();
        $this->formatService->setPropertyForRequestItem($request);
        $success = $this->formatService->assembleCommitDetail();
        return $this->getFormatJson(compact('success'));
    }

    /**
     * Delete the data where inputting id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return \Response::json(array('success' => 1, 'id' => $id));
    }

    /**
     * @param array $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFormatJson($item = array())
    {
        return \Response::json($item);
    }
    
}
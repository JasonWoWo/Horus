<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/8/29
 * Time: 下午7:36
 */

namespace App\Http\Controllers;


use App\Http\Requests\Request;

class TaskOnAjaxController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $a = ['id' => 1, 'name' => 'Qenrik', 'content' => '23333', 'created_at' => '2016-08-27'];
        $b = ['id' => 2, 'name' => 'Henrik', 'content' => '3339999', 'created_at' => '2016-08-27'];
        $list = array($a, $b);
        return \Response::json($a);
//        return view('task', [ 
//            'tasks' => [(object)$a, (object)$b]
//        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required'
        ]);
        return \Response::json(array('code' => 'ok'));
    }

    public function destroy($id)
    {
        return \Response::json(array('code' => '200', 'destroy' => $id));
    }
    
    public function show($id)
    {
        $showItems = array(
            'id' => $id,
            'name' => 'Henrik',
            'content' => '15948321824'
        );
        return \Response::json($showItems);
//        return response()->json($showItems);
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'Genrik',
            'content' => '18767183816'
        ]);
        $showItems = array(
            'id' => 231,
            'name' => 'Henrik',
            'content' => '15948321824'
        );
        $showItems['username'] = $request->get('name');
        $showItems['phone'] = $request->get('content');
        return \Response::json($showItems);
    }
}
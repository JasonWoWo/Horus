<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/9/8
 * Time: 下午7:45
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Horus\Models\Entity\Admin\Manager;
use Horus\Models\Entity\Admin\ManagerRepositoryInterface;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        try {
            if (! $token = \JWTAuth::attempt($credentials)) {
                return \Response::json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return \Response::json(['error' => 'could_not_create_token'], 500);
        }

        return \Response::json(compact('token'));
    }

    public function authenticateOnUser(Request $request)
    {
        $userId = $request->get('userId');
        /** @var Manager $user */
        $user = $this->getRepository(ManagerRepositoryInterface::class)->find($userId);
        if (!$user) {
            return \Response::json(['error' => 'not found', 400]);
        }
        $token = \JWTAuth::fromUser($user);
        return \Response::json(compact('token'));
    }
    
    public function testTokenItems(Request $request)
    {
        $token = $request->get('token');
        return \Response::json(array('item' => 'Henrik', 'token' => $token));
    }
}
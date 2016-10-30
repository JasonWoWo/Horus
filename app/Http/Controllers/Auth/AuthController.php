<?php

namespace App\Http\Controllers\Auth;

use Horus\Models\Entity\Admin\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use \Horus\Models\Entity\Admin\ManagerRepositoryInterface;
use \Horus\Application\Service\ManagerAccountService AS ManagerAccountService;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $managerAccountService;

    /**
     * Create a new authentication controller instance.
     * @param  ManagerAccountService $managerService
     */
    public function __construct(ManagerAccountService $managerService)
    {
//        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        parent::__construct();
        $this->managerAccountService = $managerService;

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $rules = [
            'phone' => 'required',
            'password' => 'required|min:6'
        ];

        $messages = [
            'phone' => '手机号必填',
            'password' => '密码必填',
        ];
        $this->validate($request, $rules, $messages);
    }

    /**
     * 登录页面
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return $this->showLoginForm();
    }
    
    public function postLogin(Request $request)
    {
        $this->validateLogin($request);

//        if ($lockedOut = $this->hasTooManyLoginAttempts($request)) {
//            $this->fireLockoutEvent($request);
//
//            return $this->sendLockoutResponse($request);
//        }

        $phone = $request->get('phone');
        $password = $request->get('password');
        /** @var \Horus\Models\Entity\Admin\ManagerRepositoryInterface  $managerRepository */
        $managerRepository = $this->getRepository(ManagerRepositoryInterface::class);
        /** @var Manager $manager */
        $manager = $managerRepository->getQueryUserForPhoneWithPassword($phone, $password);
        if ($manager) {

            Auth::guard($this->getGuard())->login($manager, true);
            return \Redirect::intended('backend/manager');
        }
        
//        if (!$lockedOut) {
//            $this->incrementLoginAttempts($request);
//        }

//        return $this->sendFailedLoginResponse($request);
    }

    /**
     * 注册用户页面
     */
    public function getRegister()
    {
        return $this->showRegistrationForm();
    }
    
    public function postRegister(Request $request)
    {
        $rules = [
            'username' => 'required',
            'phone' => 'required|max:255',
            'password' => 'required',
            'doublePassword' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'ticket' => 'required',
        ];
        $message = [
            'phone' => '',
            'password' => '',
            'gender' => '',
            'email' => '',
            'ticket' => '',
        ];
        $this->validate($request, $rules, $message);

        $username = $request->input('username');
        $phone = $request->input('phone');
        $password = $request->input('password');
        $email = $request->input('email');
        $ticket = $request->input('ticket');
        $gender = $request->input('gender');

        $freshManager = $this->managerAccountService->registerFreshManagerAccount($username, $phone, $password, $email, $gender);

        if (!$freshManager) {
            return Redirect::back()->withInput();
        }
        Auth::guard($this->getGuard())->login($freshManager, true);
        return \Redirect::intended('backend/manager');
    }

}

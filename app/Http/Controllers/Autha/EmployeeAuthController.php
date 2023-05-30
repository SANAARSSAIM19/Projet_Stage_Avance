<?php

namespace App\Http\Controllers\Autha;

use Illuminate\Http\Request;
//use AuthenticatesUsers;
use App\Http\Controllers\Controller;
 use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use App\MyCustomAuthClass;
    
class EmployeeAuthController extends Controller
{
    use AuthenticatesUsers;
//namespace App\Http\Controllers\Auth;






    protected $redirectTo = 'dashboard';

    public function __construct()
    {
        $this->middleware('guest:employee')->except('logout');
    }

    public function showEmployeeLoginForm()
    {
        return view('autha.employee-login');
    }

    protected function guard()
    {
        return Auth::guard('employee');
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    public function login(Request $request)
{
    $this->guard('employee')->attempt();

    $this->validateLogin($request);

    if ($this->attemptLogin($request)) {
        return $this->sendLoginResponse($request);
    }

    return $this->sendFailedLoginResponse($request);
}

public function logout(Request $request)
{
    $this->guard('employee')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('employee/loginn');
}

  


}


<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('login');
    }

    public function login_admin(Request $request){
        $this->validate(
            $request, [
                'nik' => 'required|numeric',
                'password' => 'required',
            ]
        );
        $data = [
            'nik' => $request->nik,
            'password' => $request->password,
        ];
        if(Auth::guard('admin')->attempt($data, (bool) $request->remember)){
            session::put('token',$request->_token);
            return redirect('/admin');
        }
        return redirect()->back()->with('alert','');
    }

    public function login_cabang(Request $request){
        $this->validate(
            $request, [
                'cabang' => 'required|string',
                'password' => 'required',
            ]
        );
        $data = [
            'id' => $request->cabang,
            'password' => $request->password,
        ];
        if(Auth::attempt($data, (bool) $request->remember)){
            if(Auth::user()->active==true){
                session::put('token',$request->_token);
                return redirect('/cabang');
            }else{
                Auth::logout();
                session::flush();
                session::regenerate();
                return redirect()->back()->with('error','akun anda di nonaktifkan dari sistem, hubungi admin');
            }
        }
        return redirect()->back()->with('alert','');
    }

    public function logout(){
        Auth::logout();
        Auth::guard('admin')->logout();
        session::flush();
        session::regenerate();
        return redirect('login');
    }
}

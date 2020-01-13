<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Superadmin;
use App\Admin;

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
    protected $redirectTo = '/home';
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
         $this->middleware('guest:admin')->except('logout');
         $this->middleware('guest:superadmin')->except('logout');
    }



    
    public function showAdminLoginForm()
    {
        return view('adminlogin', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status'=>1,], $request->get('remember'))) {
Toastr::success("WellCome Back", "Hello Admin");
            return redirect()->intended('/admin/dashboard');
        }
       
        if ( ! Admin::where('email', $request->email)->first() ) {
            return redirect()->back()
                    ->withErrors([
                    'email' => Lang::get('auth.email'),
                ]);
        }
 if ( ! Admin::where('email', $request->email)->where('status', '<>', 2)->first() ) {
            return redirect()->back()
                    ->withErrors([
                    'status' => Lang::get('auth.status'),
                ]);
        }
        if ( ! Admin::where('email', $request->email)->where('password', bcrypt($request->password))->first() ) {
            return redirect()->back()
                    ->withErrors([
                    'password' => Lang::get('auth.password'),
                ]);
        }
       


    }
    public function showSuperadminLoginForm()
    {
        return view('adminlogin', ['url' => 'superadmin']);
    }

    public function superadmin(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('superadmin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
Toastr::success('WellCome Back','Hello Superadmin ');
            return redirect()->intended('/superadmin/dashboard');
        }

       
        if ( ! Superadmin::where('email', $request->email)->first() ) {
            return redirect()->back()
                    ->withErrors([
                    'email' => Lang::get('auth.email'),
                ]);
        }

        if ( ! Superadmin::where('email', $request->email)->where('password', bcrypt($request->password))->first() ) {
            return redirect()->back()
                    ->withErrors([
                    'password' => Lang::get('auth.password'),
                ]);
        }





    }


    
   
}

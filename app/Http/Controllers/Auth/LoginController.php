<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\AuthUserAPI;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Faker\Factory;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = RouteServiceProvider::REG;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

   public function authenticate(Request $request, AuthUserAPI $api)
   {

      /* if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
         // Authentication was successful...
         // return redirect('regDoc')->with('success', "Account successfully registered.");
      } else {
         $errors = [$this->username() => ('ไม่พบชื่อผู้ใช้ ตรวจสอบชื่อผู้ใช้')];
         // Load user from database
         $user = User::where($this->username(), $request->{$this->username()})->first();

         if ($user && !Hash::check($request->password, $user->password)) {
            $errors = ['password' => 'รหัสผ่านผิด'];
         }

         return redirect()->back()
         ->withInput($request->only($this->username(), 'remember'))
         ->withErrors($errors);
      } */

      $user = $api->authenticate($request->username, $request->password);
      if($user['reply_code'] != 0){
         echo "not ok";
         $errors = new MessageBag; // initiate MessageBag

         
         $errors = new MessageBag(['password' => ['รหัสผ่านไม่ถูก']]); // if Auth::attempt fails (wrong credentials) create a new message bag instance.

         return redirect()->back()
         ->withErrors($errors); // redirect back to the login page, using ->withErrors($errors) you send the error created above
      }else{
         return Redirect::route('reg.show');
      }

      // dd($user);
   }
   public function logout(Request $request)
   {
      Auth::logout();

      return Redirect::route('login');
   }
}

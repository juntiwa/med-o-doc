<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\AuthUserAPI;
use App\Http\Controllers\Controller;
use App\Models\activityLog;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Faker\Factory;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
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
      $userregis = User::where('username', $request->username)->first();
      if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
         // Authentication was successful... 
         if ([$request->username => 'admin']){
            return redirect()->intended('activitylog');
            // echo "test";
         }else{
            $username = $userregis->username;
            $email = $userregis->email;
            $fname = $userregis->fname;
            $lname = $userregis->lname;
            $description = 'เข้าสู่ระบบ';
            $dt = Carbon::now();
            $todaydate = $dt->toDayDateTimeString();
            $created_at = date_create();
            $updated_at = date_create();

            $activityLog = [
               'username' => $username,
               'fname' => $fname,
               'lname' => $lname,
               'email' => $email,
               'description' => $description,
               'date_time' => $todaydate,
               'created_at' => $created_at,
               'updated_at' => $updated_at,
            ];
            activityLog::insert($activityLog);
            return redirect('regDoc')->with('success', "Account successfully registered.");
         }
      } else {
         // Load user from database
         // $userregis = User::where('username', $request->username)->first();
         if ($userregis && !Hash::check($request->password, $userregis->password)) {
            $errors = ['password' => 'รหัสผ่านผิด'];
            // echo "password";
            return Redirect::back()->withErrors($errors)->withInput($request->all());
         }else{
            $errors = [$this->username() => ('ไม่พบชื่อผู้ใช้ ตรวจสอบชื่อผู้ใช้')];
            // echo "username";
            return Redirect::back()->withErrors($errors)->withInput($request->all());
         }
      }
      
      // $user = $api->authenticate($request->username, $request->password);
      // if($user['reply_code'] != 0){
      //    echo "not ok";
      //    $errors = new MessageBag; // initiate MessageBag


      //    $errors = new MessageBag(['password' => ['รหัสผ่านไม่ถูก']]); // if Auth::attempt fails (wrong credentials) create a new message bag instance.

      //    return redirect()->back()
      //    ->withErrors($errors); // redirect back to the login page, using ->withErrors($errors) you send the error created above
      // }else{
      //    return Redirect::route('reg.show');
      // }

      // dd($user);
   }
   public function logout(Request $request)
   {

      $user = Auth::User();
      Session::put('user', $user);
      $user = Session::get('user');
      $username = $user->username;
      $email = $user->email;
      $fname = $user->fname;
      $lname = $user->lname;
      $description = 'ออกจากระบบ';
      $dt = Carbon::now();
      $todaydate = $dt->toDayDateTimeString();
      $created_at = date_create();
      $updated_at = date_create();

      $activityLog = [
         'username' => $username,
         'fname' => $fname,
         'lname' => $lname,
         'email' => $email,
         'description' => $description,
         'date_time' => $todaydate,
         'created_at' => $created_at,
         'updated_at' => $updated_at,
      ];
      activityLog::insert($activityLog);
      Auth::logout();
      return Redirect::route('login');
   }
}

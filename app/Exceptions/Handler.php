<?php

namespace App\Exceptions;

use App\Models\activityLog;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
      /* $this->reportable(function (Throwable $e) {
            //
        }); */

      $this->renderable(function (\Exception $e) {
         if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
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
            return redirect()->route('login');
         };
      });
    }
}

<?php

namespace App\APIs;

use App\Contracts\AuthUserAPI;
use Illuminate\Support\Facades\Auth;

class FakeUserAPI implements AuthUserAPI
{
    public function authenticate($username, $password)
    {
        // Auth::attempt(['username' => $username, 'password' => $password])
        if ($username === $password ) {
              return [
                'ok' => true,
                'found' => true,
                'login' => 'admin.sys',
                'org_id' => '10012345',
                'full_name' => 'น.ส. ผู้ใช้งาน ทั่วไป',
                'full_name_en' => 'Miss User System',
                'position_name' => 'นักวิชาการคอมพิวเตอร์',
                'division_name' => 'ภ.อายุรศาสตร์',
                'department_name' => 'ภ.อายุรศาสตร์',
                'office_name' => 'สนง.ภาควิชาอายุรศาสตร์',
                'email' => '',
                'password_expires_in_days' => 46,
                'remark' => 'สนง.ภาควิชาอายุรศาสตร์ ภ.อายุรศาสตร์',
                'name' => 'น.ส. ผู้ใช้งาน ทั่วไป',
                'name_en' => 'Miss User System',
                'reply_code' => 0,
            ];
           /* return [
                'ok' => true,
                'found' => true,
                'login' => 'test.sys',
                'org_id' => '10012346',
                'full_name' => 'นาย ทดสอบ ระบบ',
                'full_name_en' => 'Mr. Test System',
                'position_name' => 'นักวิชาการคอมพิวเตอร์',
                'division_name' => 'ภ.อายุรศาสตร์',
                'department_name' => 'ภ.อายุรศาสตร์',
                'office_name' => 'สนง.ภาควิชาอายุรศาสตร์',
                'email' => '',
                'password_expires_in_days' => 46,
                'remark' => 'สนง.ภาควิชาอายุรศาสตร์ ภ.อายุรศาสตร์',
                'name' => 'นาย ทดสอบ ระบบ',
                'name_en' => 'Mr. Test System',
                'reply_code' => 0,
            ];*/
        } else {
            return [
                'reply_code' => 1,
                'reply_text' => 'Username or Password is incorrect',
                'found' => 'false',
            ];
        }
    }
}

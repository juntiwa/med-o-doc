<?php
namespace App\APIs;

use App\Contracts\AuthUserAPI;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;

class FakeUserAPI implements AuthUserAPI
{
   public function authenticate($username, $password)
   {
      // Auth::attempt(['username' => $username, 'password' => $password])
      if ($username === $password) {
         return [
            "ok" => true,
            "found" => true,
            "login" => "test",
            "org_id" => "100xxxx",
            "full_name" => "น.ส. จันทิมา นุชโยธิน",
            "full_name_en" => "Miss JUNTIMA NUCHYOTIN",
            "position_name" => "นักวิชาการคอมพิวเตอร์",
            "division_name" => "ภ.อายุรศาสตร์",
            "department_name" => "ภ.อายุรศาสตร์",
            "office_name" => "สนง.ภาควิชาอายุรศาสตร์",
            "email" => "",
            "password_expires_in_days" => 46,
            "remark" => "สนง.ภาควิชาอายุรศาสตร์ ภ.อายุรศาสตร์",
            "name" => "น.ส. จันทิมา นุชโยธิน",
            "name_en" => "Miss JUNTIMA NUCHYOTIN",
            "reply_code" => 0,
         ];
      } else {
         return [
            "reply_code" => "1",
            "reply_text" => "Username or Password is incorrect",
            "found" => "false",
         ];
      }
   }

}
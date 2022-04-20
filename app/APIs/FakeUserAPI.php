<?php
namespace App\APIs;

use App\Contracts\AuthUserAPI;
use Faker\Factory;

class FakeUserAPI implements AuthUserAPI
{
   public function authenticate($username, $password)
   {
      if ($username === $password) {
         return [
            "reply_code" => 0,
            "ok" => true,
            "found" => true,
            "username" => "juntima.nuc",
            "email" => "juntima.nuc@mahidol.ac.th",
            "name" => "นางสาว จันทิมา นุชโยธิน",
            "name_en" => "Miss JUNTIMA NUCHYOTHIN",
            "org_id" => "1004xxxx",
            "remark" => "สำนักงานภาควิชาอายุรศาสตร์ ภาควิชาอายุรศาสตร์",
            "tel_no" => "",
            "active" => 1,
            "position_name" => "นักวิชาการคอมพิวเตอร์",
            "division_name" => "ภาควิชาอายุรศาสตร์",
            "department_name" => "ภาควิชาอายุรศาสตร์",
            "office_name" => "สำนักงานภาควิชาอายุรศาสตร์",
            "password_expires_in_days" => 62,
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
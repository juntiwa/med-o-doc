/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/adduser.js ***!
  \*********************************/
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// version 1.1
$(document).ready(function () {
  var html = "";
  html += '<section id="user">';
  html += '<div class="card w-full bg-base-100 drop-shadow-md  bg-white">';
  html += '<div class="card-body">';
  html += '<h2 class="text-slate-900 text-xl font-semibold">เพิ่มผู้ใช้งาน</h2>';
  html += '<div class="form-control w-full">';
  html += '<label class="label">';
  html += '<span class="label-text text-slate-900 text-lg font-medium">รหัสพนักงาน SAPID <b class="text-rose-600">*</b></span>';
  html += "</label>";
  html += '<input type="text" placeholder="99999999" pattern="[0-9]+" minlength="8" maxlength="8" name="sapid[]" id="sapid--index--" required class="input input-bordered w-full bg-white border-slate-400 text-lg font-medium" data-user-index="--index--" />';
  html += '<input id="username--index--" type="text" placeholder="ชื่อผู้ใช้งาน" class="mt-3 input w-full max-w-lg text-base disabled:border-none disabled:bg-white disabled:text-slate-900" disabled />';
  html += "</div>";
  html += '<div class="form-control w-full mr-4">';
  html += '<label class="label">';
  html += '<span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน <b class="text-rose-600">*</b></span>';
  html += "</label>";
  html += '<select disabled required name="permission[]" id="permission--index--" class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal w-full">';
  html += '<option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>';
  html += '<option value="1" {{ (old("permission") == "1" ? "selected": "") }}>ผู้ดูแลระบบ</option>';
  html += '<option value="0" {{ (old("permission") == "0" ? "selected": "") }}>ผู้ใช้งานทั่วไป</option>';
  html += "</select>";
  html += "</div>";
  html += '<div class="card-actions mt-5 justify-end">';
  html += '<button id="remove" type="button" class="btn bg-red-500 border-none hover:bg-red-700">ลบช่องกรอกข้อมูล</button>';
  html += "</div>";
  html += "</div>";
  html += "</div>";
  html += "</section>";
  var emptyUser = {
    sapid: null,
    username: null,
    permission: null,
    error: false
  };
  var users = [];
  users.push(_objectSpread({}, emptyUser));

  function getUserbySapId(index) {
    var sapid = $("#sapid" + index).val();
    $.ajax({
      url: sapidroute,
      type: "post",
      data: {
        sapid: sapid,
        _token: CSRF_TOKEN
      },
      success: function success(result) {
        // console.log(result);
        $("#username" + index).val(result.AccountName);

        if (result.Status == "Active") {
          if (result.Exist == "Yes") {
            $("#username" + index).removeClass("disabled:text-teal-500");
            $("#username" + index).addClass("disabled:text-red-500");
            $("#permission" + index).prop("disabled", true);
            $("#saveButton").prop("disabled", true);
            users[index].error = true;
          } else {
            $("#username" + index).removeClass("disabled:text-red-500");
            $("#username" + index).addClass("disabled:text-teal-500");
            $("#permission" + index).prop("disabled", false);
            $("#saveButton").prop("disabled", false);
            users[index].error = false;
          }
        } else if (result.Status == "Null") {
          $("#username" + index).removeClass("disabled:text-teal-500");
          $("#username" + index).addClass("disabled:text-red-500");
          $("#permission" + index).prop("disabled", true);
          $("#saveButton").prop("disabled", true);
          users[index].error = true;
        } else {
          // inactive
          $("#username" + index).removeClass("disabled:text-teal-500");
          $("#username" + index).addClass("disabled:text-red-500");
          $("#permission" + index).prop("disabled", true);
          $("#saveButton").prop("disabled", true);
          users[index].error = true;
        }

        if (users.reduce(function (a, b) {
          return a || b.error;
        }, false)) {
          $("#errors").removeClass("hidden");
        } else {
          $("#errors").addClass("hidden");
        }
      }
    });
  }

  function sapidOnchange() {
    var index = $(this)[0].id.slice(5); // console.log(index)

    var val = $(this).val();
    console.log(val);

    if (val === "") {
      console.log("ok");
      $("#username".concat(index)).val(""); // $(`#permission${index}`).val('');

      $("#permission0").val("");
      $("#permission0").prop("disabled", true);
      users[index].error = false;

      if (users.reduce(function (a, b) {
        return a || b.error;
      }, false)) {
        $("#errors").removeClass("hidden");
      } else {
        $("#errors").addClass("hidden");
      }
    } else {
      getUserbySapId($(this).data("user-index"));
    }
  }

  $("#sapid0").change(sapidOnchange);
  $("#plus_icon").click(function () {
    users.push(_objectSpread({}, emptyUser));
    var index = users.length - 1;
    var template = html.replaceAll("--index--", index);
    $("#newuser").append(template);
    $("#sapid" + index).change(sapidOnchange);
    $("#remove").prop("disabled", false);
  });
  $(document).on("click", "#remove", function () {
    --users.length;
    $(this).closest("#user").remove();

    if (users.length == 1) {
      $("#remove").prop("disabled", true);
    }
  });
});
/******/ })()
;
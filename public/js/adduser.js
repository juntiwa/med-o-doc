$(document).ready(function () { 
   var html = '';
      html += '<section id="user" class="sm:flex sm:flex-col md:grid md:grid-cols-2 lg:grid lg:grid-cols-2 gap4">';
      html += '<div class="form-control w-full max-w-xs">';
      html += '<label class="label">';
      html += '<span class="label-text text-slate-900 text-lg font-medium">รหัสพนักงาน SAPID <b class="text-rose-600">*</b></span>';
      html += '</label>';
      html += '<input type="text" placeholder="99999999" pattern="[0-9]+" minlength="8" maxlength="8" name="sapid[]" id="sapid--index--" required class="input input-bordered w-full max-w-xs bg-white border-slate-400 text-lg font-medium" data-user-index="--index--"/>';
      html += '</div>';
      html += '<div class="flex w-full justify-between">';
      html += '<div class="form-control w-full max-w-xs mr-4">';
      html += '<label class="label">';
      html += '<span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน <b class="text-rose-600">*</b></span>';
      html += '</label>';
      html += '<select disabled required name="permission[]" id="permission--index--" class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal">';
      html += '<option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>';
      html += '<option value="1" {{ (old("permission") == "1" ? "selected": "") }}>ผู้ดูแลระบบ</option>';
      html += '<option value="0" {{ (old("permission") == "0" ? "selected": "") }}>ผู้ใช้งานทั่วไป</option>';
      html += '</select>';
      html += '</div>';
      html += '<div class="flex justify-end items-end">';
      html += '<button id="remove" type="button" class="btn btn-error">ลบช่อง</button>';
      html += '</div>';
      html += '</div>';
      html += '<input id="username--index--" type="text" placeholder="ชื่อผู้ใช้งาน" class="mt-3 input w-full max-w-xs text-base disabled:border-none disabled:bg-white disabled:text-slate-900" disabled />';
      html += '</section>';
   var emptyUser = { sapid: null, username: null, permission: null, error: false }
   var users = [];
   users.push({...emptyUser})

   function getUserbySapId(index) {
      var sapid = $('#sapid'+index).val()
      $.ajax({
         url: sapidroute,
         type: 'post',
         data: {
            sapid: sapid,
            _token: CSRF_TOKEN
         },
         success: function (result) {
            console.log(result);
            if (result.Status == 'Active') {
               if (result.Exist == 'Yes') {
                  $('#username' + index).val(result.AccountName);
                  $('#username' + index).removeClass('disabled:text-teal-500');
                  $('#username' + index).addClass('disabled:text-red-500');
                  $('#message').removeClass('hidden');
                  users[index].error = true;
               } else {
                  $('#username' + index).val(result.AccountName);
                  $('#username' + index).removeClass('disabled:text-red-500');
                  $('#username' + index).addClass('disabled:text-teal-500');
                  $('#message').addClass('hidden');
               }
            } else {
               $('#username' + index).val(result.AccountName);
               $('#username' + index).removeClass('disabled:text-teal-500');
               $('#username' + index).addClass('disabled:text-red-500');
               $('#message').removeClass('hidden');
               users[index].error = true;
            }

            if (users.reduce((a, b) => a || b.error, false)) {
               $('#test-error').removeClass('hidden');
            }
         }
      })
   }
   function sapidOnchange() {
      getUserbySapId($(this).data('user-index'));
   }
   $('#sapid0').change(sapidOnchange)
   
   $("#plus_icon").click(function () {
      users.push({ ...emptyUser });
      var index = users.length - 1;
      var template = html.replaceAll('--index--', index)
      $('#newuser').append(template);
      $('#sapid'+index).change(sapidOnchange)
      if (users.length == 6) {
         $('#plus_icon').prop('disabled', true)
         $('#plas_svg').removeClass('cursor-pointer fill-teal-400')
         $('#plas_svg').addClass('cursor-not-allowed fill-slate-100')
      }      
   });

   $(document).on('click', '#remove', function () {
      --users.length
      $(this).closest('#user').remove();
   });
});
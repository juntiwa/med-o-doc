$(document).ready(function () { 
   $('#user2').hide();
   $('#user3').hide();
   $('#user4').hide();
   $('#user5').hide();
   $('#user6').hide();

   var plus_count = 1
   var plus = document.getElementById("plus_icon")
   var del = document.getElementById("del_icon")

   $(plus).click(function () {
      plus_count++
      var html = ''
      html += '<section id="user" class="sm:flex sm:flex-col md:grid md:grid-cols-2 lg:grid lg:grid-cols-2 gap4">'
      html += '<div class="form-control w-full pr-4">'
      html += '<label class="label">'
      html += '<span class="label-text text-slate-900 text-lg font-medium">รหัสพนักงาน SAPID <b class="text-rose-600">*</b></span>'
      html += '</label>'
      html += '<input type="text" placeholder="99999999" pattern="[0-9]+" minlength="8" maxlength="8" name="sapid" id="sapid"  required '
      html += 'class="input input-bordered w-full max-w-xs bg-white border-slate-400 text-lg font-medium"/>'
      html += '</div>'
      html += '<div class="form-control w-full max-w-xs">'
      html += '<label class="label">'
      html += '<span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน <b class="text-rose-600">*</b></span>'
      html += '</label>'
      html += '<select disabled required name="permission" id="permission" class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal">'
      html += '<option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>'
      html += '<option value="1" {{ (old("permission1") == "1" ? "selected": "") }}>ผู้ดูแลระบบ</option>'
      html += '<option value="0" {{ (old("permission1") == "0" ? "selected": "") }}>ผู้ใช้งานทั่วไป</option>'
      html += '</select>'
      html += '</div>'
      html += '<div class="col-span-2 mt-2">'
      html += '<input type="text" id="username" class="input input-bordered w-full max-w-xs disabled:bg-white disabled:border-white text-lg font-medium" placeholder="ชื่อผู้ใช้งาน" disabled>'
      html += '</div>'
      
      html += '</section>'

      $('#newuser').append(html)
      console.log(plus_count);
      // remove row
      $(del).click(function () {
         $(this).closest('#user').remove();
      });
   })

   // remove
   
    

   // show username when input sapid
   $('input[name=sapid1]').change(function () {
      var sapid = $(this).val();
      // console.log(sapid)
      if (sapid !== '') {
         $('#permission1').prop('disabled', false)
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
                     $('#username1').val(result.AccountName);
                     $('#username1').addClass('disabled:text-red-500');
                  } else {
                     $('#username1').val(result.AccountName);
                     $('#username1').addClass('disabled:text-teal-500');
                  }
               } else {
                  $('#username1').val(result.AccountName);
                  $('#username1').addClass('disabled:text-red-500');
               }
            }
         })
         
      } else {
         $('#permission1').val('')
         $('#permission1').prop('disabled', true)
      }
   })
   $('input[name=sapid2]').change(function () {
      var sapid = $(this).val();
      // console.log(sapid)
      if (sapid !== '') {
         $('#permission2').prop('disabled', false)
         $('#permission2').prop('required', true)
         $.ajax({  
         url: sapidroute,
            type: 'post',
            data: {
               sapid: sapid,
               _token: CSRF_TOKEN
            },
            success: function (result) {
               if (result.Status == 'Active') {
                  $('#username2').val(result.AccountName);
                  $('#username2').addClass('disabled:text-teal-500');
               } else {
                  $('#username2').val(result.AccountName +' สถานะ '+ result.Status);
                  $('#username2').addClass('disabled:text-red-500');
               }
            }
         })
      } else {
         $('#permission2').val('')
         $('#permission2').prop('disabled', true)
         $('#permission2').prop('required', false)
      }
   })
   $('input[name=sapid3]').change(function () {
      var sapid = $(this).val();
      // console.log(sapid)
      if (sapid !== '') {
         $('#permission3').prop('disabled', false)
         $('#permission3').prop('required', true)
         $.ajax({  
         url: sapidroute,
            type: 'post',
            data: {
               sapid: sapid,
               _token: CSRF_TOKEN
            },
            success: function (result) {
               if (result.Status == 'Active') {
                  $('#username3').val(result.AccountName);
                  $('#username3').addClass('disabled:text-teal-500');
               } else {
                  $('#username3').val(result.AccountName +' สถานะ '+ result.Status);
                  $('#username3').addClass('disabled:text-red-500');
               }
            }
         })
      } else {
         $('#permission3').val('')
         $('#permission3').prop('disabled', true)
         $('#permission3').prop('required', false)
      }
   })
   $('input[name=sapid4]').change(function () {
      var sapid = $(this).val();
      // console.log(sapid)
      if (sapid !== '') {
         $('#permission4').prop('disabled', false)
         $('#permission4').prop('required', true)
         $.ajax({  
         url: sapidroute,
            type: 'post',
            data: {
               sapid: sapid,
               _token: CSRF_TOKEN
            },
            success: function (result) {
               if (result.Status == 'Active') {
                  $('#username4').val(result.AccountName);
                  $('#username4').addClass('disabled:text-teal-500');
               } else {
                  $('#username4').val(result.AccountName +' สถานะ '+ result.Status);
                  $('#username4').addClass('disabled:text-red-500');
               }
            }
         })
      } else {
         $('#permission4').val('')
         $('#permission4').prop('disabled', true)
         $('#permission4').prop('required', false)
      }
   })
   $('input[name=sapid5]').change(function () {
      var sapid = $(this).val();
      // console.log(sapid)
      if (sapid !== '') {
         $('#permission5').prop('disabled', false)
         $('#permission5').prop('required', true)
         $.ajax({  
         url: sapidroute,
            type: 'post',
            data: {
               sapid: sapid,
               _token: CSRF_TOKEN
            },
            success: function (result) {
               if (result.Status == 'Active') {
                  $('#username5').val(result.AccountName);
                  $('#username5').addClass('disabled:text-teal-500');
               } else {
                  $('#username5').val(result.AccountName +' สถานะ '+ result.Status);
                  $('#username5').addClass('disabled:text-red-500');
               }
            }
         })
      } else {
         $('#permission5').val('')
         $('#permission5').prop('disabled', true)
         $('#permission5').prop('required', false)
      }
   })
   $('input[name=sapid6]').change(function () {
      var sapid = $(this).val();
      // console.log(sapid)
      if (sapid !== '') {
         $('#permission6').prop('disabled', false)
         $('#permission6').prop('required', true)
         $.ajax({  
            url: sapidroute,
            type: 'post',
            data: {
               sapid: sapid,
               _token: CSRF_TOKEN
            },
            success: function (result) {
               if (result.Status == 'Active') {
                  $('#username6').val(result.AccountName);
                  $('#username6').addClass('disabled:text-teal-500');
               } else {
                  $('#username6').val(result.AccountName +' สถานะ '+ result.Status);
                  $('#username6').addClass('disabled:text-red-500');
               }
            }
         })
      } else {
         $('#permission6').val('')
         $('#permission6').prop('disabled', true)
         $('#permission6').prop('required', false)
      }
   })

   
 })


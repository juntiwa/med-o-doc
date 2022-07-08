
   $(document).ready(function () {
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
                  // $('#idfrom').val(ui.item.unitid);
                  if (result.Status == 'Active') {
                     $('#username1').val(result.Acplus_countName);
                     $('#username1').addClass('disabled:text-teal-500');
                  } else {
                     $('#username1').val(result.Acplus_countName +' สถานะ '+ result.Status);
                     $('#username1').addClass('disabled:text-red-500');
                  }
                  // console.log(result.Status);
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
                     $('#username2').val(result.Acplus_countName);
                     $('#username2').addClass('disabled:text-teal-500');
                  } else {
                     $('#username2').val(result.Acplus_countName +' สถานะ '+ result.Status);
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
                     $('#username3').val(result.Acplus_countName);
                     $('#username3').addClass('disabled:text-teal-500');
                  } else {
                     $('#username3').val(result.Acplus_countName +' สถานะ '+ result.Status);
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
                     $('#username4').val(result.Acplus_countName);
                     $('#username4').addClass('disabled:text-teal-500');
                  } else {
                     $('#username4').val(result.Acplus_countName +' สถานะ '+ result.Status);
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
                     $('#username5').val(result.Acplus_countName);
                     $('#username5').addClass('disabled:text-teal-500');
                  } else {
                     $('#username5').val(result.Acplus_countName +' สถานะ '+ result.Status);
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
                     $('#username6').val(result.Acplus_countName);
                     $('#username6').addClass('disabled:text-teal-500');
                  } else {
                     $('#username6').val(result.Acplus_countName +' สถานะ '+ result.Status);
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

      // old input
      var sapid1old = $('input[name=sapid1]').val()
      let permission1old = $('#permission1').val()
      // console.log(sapid1old);
      if (sapid1old !== '') {
         $('input[name=sapid1]').change();
      }
      if (permission1old !== '') {
         $('#permission1').change();
      }
      var sapid2old = $('input[name=sapid2]').val()
      let permission2old = $('#permission2').val()
      // console.log(sapid1old);
      if (sapid2old !== '') {
         $('input[name=sapid2]').change();
      }
      if (permission2old !== '') {
         $('#permission2').change();
      }
      var sapid3old = $('input[name=sapid3]').val()
      let permission3old = $('#permission3').val()
      // console.log(sapid1old);
      if (sapid3old !== '') {
         $('input[name=sapid3]').change();
      }
      if (permission3old !== '') {
         $('#permission3').change();
      }
      var sapid4old = $('input[name=sapid4]').val()
      let permission4old = $('#permission4').val()
      // console.log(sapid1old);
      if (sapid4old !== '') {
         $('input[name=sapid4]').change();
      }
      if (permission4old !== '') {
         $('#permission4').change();
      }
      var sapid5old = $('input[name=sapid5]').val()
      let permission5old = $('#permission5').val()
      // console.log(sapid1old);
      if (sapid5old !== '') {
         $('input[name=sapid5]').change();
      }
      if (permission5old !== '') {
         $('#permission5').change();
      }
      var sapid6old = $('input[name=sapid6]').val()
      let permission6old = $('#permission6').val()
      // console.log(sapid1old);
      if (sapid6old !== '') {
         $('input[name=sapid6]').change();
      }
      if (permission6old !== '') {
         $('#permission6').change();
      }
   }); 

$(document).ready(function () { 
   $('#user2').hide();
   $('#user3').hide();
   $('#user4').hide();
   $('#user5').hide();
   $('#user6').hide();
   $('#delete_icon1').hide();

   var plus_count = 1
   var plus = document.getElementById("plus_icon")
   var del = document.getElementById("del_icon")

   plus.onclick = function () {
      plus_count++;
      // console.log(plus_count);
      if (plus_count === 2) {
         $('#user2').show()
      }
      if (plus_count === 3) {
         $('#user3').show()
      }
      if (plus_count === 4) {
         $('#user4').show()
      }
      if (plus_count === 5) {
         $('#user5').show()
      }
      if (plus_count === 6) {
         $('#user6').show()
         $('#plus_icon').prop('disabled', true)
         $('#plas_svg').removeClass('fill-blue-500')
         $('#plas_svg').addClass('fill-slate-100')
      }

      var del_count = plus_count + 1

      del.onclick = function () {
         console.log(del_count);
         del_count--
         if (del_count === 6) {
            $('#user6').hide()
         }
         if (del_count === 5) {
            $('#user5').hide()
         }
         if (del_count === 4) {
            $('#user4').hide()
         }
         if (del_count === 3) {
            $('#user3').hide()
         }
         if (del_count === 2) {
            $('#user2').hide()
            console.log('ok');
            $('#del_icon').prop('disabled', true)
            $('#del_svg').removeClass('fill-blue-500')
            $('#del_svg').addClass('fill-slate-100')
         }
      }
   }
   
 })


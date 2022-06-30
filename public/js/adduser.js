$.ajaxSetup({
   headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});
$(document).ready(function () {
   // remove class hidden on change
   $('#permission1').change(function () {
      let permission = $(this).val();
      console.log(permission);
      if (permission !== '') {
         $('#user2').removeClass('hidden');
      } else {
         $('#user2').addClass('hidden');
      }
   });
   $('#permission2').change(function () {
      let permission = $(this).val();
      console.log(permission);
      if (permission !== '') {
         $('#user3').removeClass('hidden');
      } else {
         $('#user3').addClass('hidden');
      }
   });
   $('#permission3').change(function () {
      let permission = $(this).val();
      console.log(permission);
      if (permission !== '') {
         $('#user4').removeClass('hidden');
      } else {
         $('#user4').addClass('hidden');
      }
   });
   $('#permission4').change(function () {
      let permission = $(this).val();
      console.log(permission);
      if (permission !== '') {
         $('#user5').removeClass('hidden');
      } else {
         $('#user5').addClass('hidden');
      }
   });
   $('#permission5').change(function () {
      let permission = $(this).val();
      console.log(permission);
      if (permission !== '') {
         $('#user6').removeClass('hidden');
      } else {
         $('#user6').addClass('hidden');
      }
   });
   
   // show username when input sapid
   $('input[name=sapid1]').change(function () {
      var sapid = $(this).val();
      // console.log(sapid)
      if (sapid !== '') {
         $('#permission1').prop('disabled', false)
         $.ajax({  
            url: "/check-sapid",
            type: 'post',
            data: {
               sapid: sapid
            },
            success: function (result) {
               // $('#idfrom').val(ui.item.unitid);
               if (result.Status == 'Active') {
                  $('#username1').val(result.AccountName);
                  $('#username1').addClass('disabled:text-teal-500');
               } else {
                  $('#username1').val(result.AccountName +' สถานะ '+ result.Status);
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
            url: "/check-sapid",
            type: 'post',
            data: {
               sapid: sapid
            },
            success: function (result) {
               // $('#idfrom').val(ui.item.unitid);
               $('#username2').val(result.AccountName);
               // console.log(result);
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
            url: "/check-sapid",
            type: 'post',
            data: {
               sapid: sapid
            },
            success: function (result) {
               // $('#idfrom').val(ui.item.unitid);
               $('#username3').val(result.AccountName);
               // console.log(result);
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
            url: "/check-sapid",
            type: 'post',
            data: {
               sapid: sapid
            },
            success: function (result) {
               // $('#idfrom').val(ui.item.unitid);
               $('#username4').val(result.AccountName);
               // console.log(result);
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
            url: "/check-sapid",
            type: 'post',
            data: {
               sapid: sapid
            },
            success: function (result) {
               // $('#idfrom').val(ui.item.unitid);
               $('#username5').val(result.AccountName);
               // console.log(result);
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
            url: "/check-sapid",
            type: 'post',
            data: {
               sapid: sapid
            },
            success: function (result) {
               // $('#idfrom').val(ui.item.unitid);
               $('#username6').val(result.AccountName);
               // console.log(result);
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
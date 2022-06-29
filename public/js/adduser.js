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
   $('#sapid1').change(function () {
      let sapid = $(this).val();
      if (sapid !== '') {
         $('#permission').prop('disabled', false);
         $.ajax({  
            url: "/check-sapid",
            type: 'post',
            data: {
               sapid: sapid
            },
            success: function (result) {
               // $('#idfrom').val(ui.item.unitid);
               $('#username1').val(result.AccountName);
               console.log(result);
            }
         });
      }
   })
});
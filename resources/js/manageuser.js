// version 1.0
function sap_click(clicked) {
   let sap_show = document.getElementById("sapShow" + clicked);
   sap_show.innerHTML = clicked;
   $('.switch' + clicked).prop('disabled', true);
   $('#sapHidden' + clicked).addClass('hidden');

   // card
   let sap_showCard = document.getElementById("sapShow_" + clicked);
   sap_showCard.innerHTML = clicked;
   $('#sapHidden_' + clicked).addClass('hidden');
//    console.log(clicked);
   // console.log(sap_show);
   $.ajax({
      url: "/show-sapid",
      type: 'post',
      data: {
         sapid: clicked
      },
      success: function (result) {
        //  console.log(result);
      }
   });
}

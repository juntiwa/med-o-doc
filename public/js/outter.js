$("#unitOutter").autocomplete({
   source: function (request, response) {
      $.ajax({
         url: outterURL,
         type: 'POST',
         dataType: "json",
         data: {
            search: request.term,
            _token: CSRF_TOKEN
         },
         success: function (data) {
            response(data);
         }
      });
   },
   select: function (event, ui) {
      $('#unitOutter').val(ui.item.label);
      $('#idunitOutter').val(ui.item.unitid);
      // console.log(ui.item);
      return false;
   }
});
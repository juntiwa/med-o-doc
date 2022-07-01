$(document).ready(function () {
   $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // toggle hide show  from input
   $("#swapinputSearch").click(function () {
      $("#inputSearch").slideToggle("slow")
   })

    // type
    $("#type").change(function () {
      let typeid = parseInt($(this).val())
      // console.log(typeid)
      
      if (typeid === 0) {
         // console.log(typeid)
         $("#unitInner").removeClass('hidden')
         $("#unitOutter").prop('hidden', true)
         $("#unitInner").prop('disabled', false)
         $("#unitOutter").val('')
         $("#idunitOutter").val('')
         let unitinner = $('#idunitInner').val(); 
         // console.log(unitinner)
         $("#unitInner").html('<option value="">เลือกหน่วยงานที่รับ</option>')
         $.ajax({
            url: innerURL,
            method: "POST",
            data: {
               typeid: typeid,
               unitinner: unitinner,
               _token: CSRF_TOKEN
            },
            success: function (result) {
               $('#unitInner').html(result)
               // console.log(unitinner)
            }
         })
         
      } else if(typeid === 3){
         $("#unitInner").addClass('hidden')
         $("#unitOutter").prop('hidden', false)
         $("#unitOutter").prop('disabled', false)
         $("#unitInner").val('')
         // console.log('ok')
         $("#unitOutter").autocomplete({
            source: function (request, response) {
               $.ajax({
                  url: outterURL,
                  type: 'GET',
                  dataType: "json",
                  data: {
                     search: request.term
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
      } else {
         $("#unitInner").prop('disabled', true)
         $("#unitOutter").prop('disabled', true)
         $("#unitOutter").val('')
         $("#idunitOutter").val('')
         $("#unitInner").val('')

      }
   })

   // start month
   $("#startMonth").change(function () {
      let startMonth = parseInt($(this).val())
      let endMonth = parseInt($('#endMonth option:selected').val())
      if (endMonth < startMonth) {
         $('#endMonth').val('')
      }
      // console.log(startMonth)
      $("#endMonth").prop('required', true) //required true
      $("#endMonth").prop('disabled', false) //disabled false

      let startMonthID = $(this).val()
      if (startMonthID == '') {
         $("#endMonth").val('') //set valur endMonth = null
         $("#endMonth").prop('disabled', true) //disabled true
      }
      $("#endMonth > option").filter(function () {
         return $(this).attr("value") < startMonth
      }).prop('disabled', true)

      $("#endMonth > option").filter(function () {
         return $(this).attr("value") >= startMonth
      }).prop('disabled', false)
      
      let startYear = parseInt($("#startYear option:selected").val())
      let endYear = parseInt($("#endYear option:selected").val())
      if (endYear > startYear) {
         $("#endMonth > option").prop('disabled',false)
      }
   }) 

   // start year
   $("#startYear").change(function () {
      let startYear = parseInt($(this).val())
      let endYear = parseInt($("#endYear option:selected").val())
      if (endYear < startYear) {
         $("#endYear").val('')
      }
      $("#endYear").prop('required', true) //required true
      $("#endYear").prop('disabled', false) //disabled false

      let startYearID = $(this).val()
      if (startYearID == '') {
         $("#endYear").val()
         $("#endYear").prop('disabled', true) //disabled true
      }

      $("#endYear > option").filter(function () {
         return $(this).attr("value") < startYear
      }).prop('disabled', true)

      $("#endYear > option").filter(function () {
         return $(this).attr("value") >= startYear
      }).prop('disabled', false)
      
      if (endYear > startYear) {
         $("#endYear > option").prop('disabled',false)
      } else {
         let startMonth = parseInt($("#startMonth option:selected").val())
         let endMonth = parseInt($("#endMonth option:selected").val())
         if (endMonth < startMonth) {
            $("#endMonth").val('')
         }
         $("#endMonth > option").filter(function () {
            return $(this).attr("value") < startMonth
         }).prop('disabled', true)
      }

      $("#endYear").change(function () {
         let endYear = parseInt($(this).val())
         if (endYear > startYear) {
            $("#endYear").prop('disabled',false)
         } else {
            let startMonth = parseInt($("#startMonth option:selected").val())
            let endMonth = parseInt($("#endMonth option:selected").val())
            if (endMonth < startMonth) {
               $("#endMonth").val('')
            }
            $("#endYear > option").filter(function () {
               return $(this).attr("value") < startMonth
            }).prop('disabled', true)
         }
      })
   })

   // endYear
   $('#endYear').change(function () {
      var startYear = parseInt($('#startYear option:selected').val());
      $("#endYear > option").filter(function () {
         return $(this).attr("value") < startYear
      }).prop('disabled', true);
      var endYear = parseInt($(this).val())
      if (endYear > startYear) {
         $("#endMonth > option").prop('disabled', false);
      } else {
         var startMonth = parseInt($('#startMonth option:selected').val())
         var endMonth = parseInt($('#endMonth option:selected').val())
         if (endMonth < startMonth) {
            $('#endMonth').val('')
         }
         $("#endMonth > option").filter(function () {
            return $(this).attr("value") < startMonth
         }).prop('disabled', true);
      }
   })

   // old input
   var type = $('#idtype').val(); 
   var startMonth = $('#startMonth').val();
   var startYear = $('#startYear').val();
   // console.log(type);
   if (type != '') {
      // console.log(type);
      $('#type').val(type);
      $("#type").change(); //ให้ on change เพื่อ get value หน่วยงานที่ส่ง
   }
   if (startMonth != '') {
      // console.log(startMonth);
      $("#startMonth").change(); //ให้ on change เพื่อ disabled false endMonth
   }
   if (startYear != '') {
      // console.log(startYear);
      $("#startYear").change(); //ให้ on change เพื่อ disabled false endYear
   }
   
   
})
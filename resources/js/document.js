$("#inputSearch").css({ display: "none" });
// เก็บค่าไว้ใน localStorage และตรวจสอบว่าเท่ากับ 0 หรือไม่ ถ้าใช่ให้แสดงช่อง
if (window.localStorage.getItem("tt") == 0) {
    $("#inputSearch").slideDown();
    $("#swapinputSearch").prop("checked", true);
} else {
    $("#swapinputSearch").prop("checked", false);
    $("#inputSearch").slideUp();
}

$("#swapinputSearch").click(function () {
    // toggle 0 1 ว่าค่าเป็นอะไรเเละเปลี่ยนเป็น 1 หรือ 0
    if (+window.localStorage.getItem("tt")) {
        window.localStorage.setItem("tt", 0);
    } else {
        window.localStorage.setItem("tt", 1);
    }
    // ตรวจสอบค่าว่าเป็น 0 หรือ 1 และทำอะไรต่อไป
    if (window.localStorage.getItem("tt") == 0) {
        $("#inputSearch").slideDown();
    } else {
        $("#inputSearch").slideUp();
        $("#swapinputSearch").prop("checked", false);
    }
});

$(".menu").click(function () {
    window.localStorage.setItem("tt", 0);
});

$(document).ready(function () {
    // window.localStorage.setItem("tt", 0);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    if (window.localStorage.getItem("tt") == null) {
        window.location.href = notfound;
    }
    // toggle hide show  from input
    // var switchs = false;

    // type
    $("#type").change(function () {
        let typeid = parseInt($(this).val());
        // console.log(typeid)

        if (typeid === 0) {
            // console.log(typeid)
            $("#unitInner").removeClass("hidden");
            $("#unitOutter").prop("hidden", true);
            $("#unitInner").prop("disabled", false);
            $("#unitOutter").val("");
            $("#idunitOutter").val("");
            let unitinner = $("#idunitInner").val();
            // console.log(unitinner)
            $("#unitInner").html(
                '<option value="">เลือกหน่วยงานที่รับ</option>'
            );
            $.ajax({
                url: innerURL,
                method: "POST",
                data: {
                    typeid: typeid,
                    unitinner: unitinner,
                    _token: CSRF_TOKEN,
                },
                success: function (result) {
                    $("#unitInner").html(result);
                    // console.log(unitinner)
                },
            });
        } else if (typeid === 3) {
            $("#unitInner").addClass("hidden");
            $("#unitOutter").prop("hidden", false);
            $("#unitOutter").prop("disabled", false);
            $("#unitInner").val("");
            //  console.log(outterURL);
            $("#unitOutter").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: outterURL,
                        type: "POST",
                        dataType: "json",
                        data: {
                            search: request.term,
                            _token: CSRF_TOKEN,
                        },
                        success: function (data) {
                            response(data);
                        },
                    });
                },
                select: function (event, ui) {
                    $("#unitOutter").val(ui.item.label);
                    $("#idunitOutter").val(ui.item.id);
                    console.log(ui.item);
                    return false;
                },
            });
        } else {
            $("#unitInner").prop("disabled", true);
            $("#unitOutter").prop("disabled", true);
            $("#unitOutter").val("");
            $("#idunitOutter").val("");
            $("#unitInner").val("");
        }
    });

    // start month
    $("#startMonth").change(function () {
        let startMonth = parseInt($(this).val());
        let endMonth = parseInt($("#endMonth option:selected").val());
        console.log(startMonth);
        console.log(endMonth);
        // console.log(startMonth)
        $("#endMonth").prop("required", true); //required true
        $("#endMonth").prop("disabled", false); //disabled false

        let startMonthID = $(this).val();
        if (startMonthID == "") {
            $("#endMonth").val(""); //set valur endMonth = null
            $("#endMonth").prop("disabled", true); //disabled true
        }
        if (endMonth < startMonthID) {
            $("#endMonth").val("");
        }
        $("#endMonth > option")
            .filter(function () {
                return $(this).attr("value") < startMonth;
            })
            .prop("disabled", true);

        $("#endMonth > option")
            .filter(function () {
                return $(this).attr("value") >= startMonth;
            })
            .prop("disabled", false);


        let startYear = parseInt($("#startYear option:selected").val());
        let endYear = parseInt($("#endYear option:selected").val());
        if (endYear > startYear) {
            $("#endMonth > option").prop("disabled", false);
        }


    });

    // start year
    $("#startYear").change(function () {
        let startYear = parseInt($(this).val());
        let endYear = parseInt($("#endYear option:selected").val());
        if (endYear < startYear) {
            $("#endYear").val("");
        }
        $("#endYear").prop("required", true); //required true
        $("#endYear").prop("disabled", false); //disabled false

        let startYearID = $(this).val();
        if (startYearID == "") {
            $("#endYear").val("");
            $("#endYear").prop("disabled", true); //disabled true
        }

        $("#endYear > option")
            .filter(function () {
                return $(this).attr("value") < startYear;
            })
            .prop("disabled", true);

        $("#endYear > option")
            .filter(function () {
                return $(this).attr("value") >= startYear;
            })
            .prop("disabled", false);

        if (endYear > startYear) {
            $("#endYear > option").prop("disabled", false);
        } else {
            let startMonth = parseInt($("#startMonth option:selected").val());
            let endMonth = parseInt($("#endMonth option:selected").val());
            if (endMonth < startMonth) {
                $("#endMonth").val("");
            }
            $("#endMonth > option")
                .filter(function () {
                    return $(this).attr("value") < startMonth;
                })
                .prop("disabled", true);
        }

        $("#endYear").change(function () {
            let endYear = parseInt($(this).val());
            if (endYear > startYear) {
                $("#endYear").prop("disabled", false);
            } else {
                let startMonth = parseInt(
                    $("#startMonth option:selected").val()
                );
                let endMonth = parseInt($("#endMonth option:selected").val());
                if (endMonth < startMonth) {
                    $("#endMonth").val("");
                }
                $("#endYear > option")
                    .filter(function () {
                        return $(this).attr("value") < startMonth;
                    })
                    .prop("disabled", true);
            }
        });
    });

    // endYear
    $("#endYear").change(function () {
        var startYear = parseInt($("#startYear option:selected").val());
        $("#endYear > option")
            .filter(function () {
                return $(this).attr("value") < startYear;
            })
            .prop("disabled", true);
        var endYear = parseInt($(this).val());
        if (endYear > startYear) {
            $("#endMonth > option").prop("disabled", false);
        } else {
            var startMonth = parseInt($("#startMonth option:selected").val());
            var endMonth = parseInt($("#endMonth option:selected").val());
            if (endMonth < startMonth) {
                $("#endMonth").val("");
            }
            $("#endMonth > option")
                .filter(function () {
                    return $(this).attr("value") < startMonth;
                })
                .prop("disabled", true);
        }
    });

    // old input
    var type = $("#idtype").val();
    var startMonth = $("#startMonth").val();
    var startYear = $("#startYear").val();
    // console.log(type);
    if (type != "") {
        // console.log(type);
        $("#type").val(type);
        $("#type").change(); //ให้ on change เพื่อ get value หน่วยงานที่ส่ง
    }
    if (startMonth != "") {
        // console.log(startMonth);
        $("#startMonth").change(); //ให้ on change เพื่อ disabled false endMonth
    }
    if (startYear != "") {
        // console.log(startYear);
        $("#startYear").change(); //ให้ on change เพื่อ disabled false endYear
    }
});

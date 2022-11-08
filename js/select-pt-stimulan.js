$(document).ready(function () {
    $.ajaxSetup({ headers: { "X-CSRF-Token": $('meta[name="_token"]').attr("content") } }),
        $("#semester").prop("disabled", !0),
        $("#jenispt").prop("disabled", !0),
        $("#dikti").prop("disabled", !0),
        $("#prodi").prop("disabled", !0),
        $("#strata").change(function () {
            var i = $("#strata").val();
            $.ajax({
                type: "POST",
                url: "/get-pt/semester",
                data: { strata: i },
                success: function (i) {
                    $("#semester").prop("disabled", !1),
                        $("#jenispt").val(""),
                        $("#dikti").val(""),
                        $("#prodi").val(""),
                        $("#jenispt").prop("disabled", !0),
                        $("#dikti").prop("disabled", !0),
                        $("#prodi").prop("disabled", !0),
                        $("#semester").html(i);
                },
            });
        }),
        $("#strata").change(function () {
            $("#lulusantahun").hide(), $("#lulus_tahun").attr("required", !1), $("#un").hide(), $("#evaluasi").hide(), $("#ipk").hide(), $("#ipk2").hide();
        }),
        // $("#semester").change(function () {
        //     $("#jenispt").prop("disabled", !1);
        //     var i = $("#strata").val();
        //     "Semester I" === $("#semester").val()
        //         ? "D-I" == i || "D-II" == i || "D-III" == i || "D-IV" == i || "S1" == i
        //             ? ($("#lulusantahun").show(),
        //               $("#lulus_tahun").attr("required", !0),
        //               $("#ipk").hide(),
        //               $("#nilai_ip").attr("required", !1),
        //               $("#un").hide(),
        //               $("#nilai_un").attr("required", !1),
        //               $("#evaluasi").hide(),
        //               $("#nilai_evaluasi").attr("required", !1))
        //             : ("S2" != i && "S3" != i && "Profesi" != i && "Spesialis" != i) ||
        //               ($("#lulusantahun").hide(),
        //               $("#lulus_tahun").attr("required", !1),
        //               $("#ipk2").show(),
        //               $("#nilai_ip").attr("required", !0),
        //               $("#nilai_ip").attr("name", "nilai_ip"),
        //               $("#un").hide(),
        //               $("#nilai_un").attr("required", !1),
        //               $("#nilai_un").attr("name", "x"),
        //               $("#evaluasi").hide(),
        //               $("#nilai_evaluasi").attr("required", !1),
        //               $("#nilai_evaluasi").attr("name", "x"))
        //         : ($("#lulusantahun").hide(),
        //           $("#lulus_tahun").attr("required", !1),
        //           $("#ipk").show(),
        //           $("#nilai_ip").attr("required", !0),
        //           $("#nilai_ip").attr("name", "nilai_ip"),
        //           $("#un").hide(),
        //           $("#nilai_un").attr("required", !1),
        //           $("#nilai_un").attr("name", "x"),
        //           $("#evaluasi").hide(),
        //           $("#nilai_evaluasi").attr("required", !1),
        //           $("#nilai_evaluasi").attr("name", "x"));
        // }),
        $("#semester").change(function () {
            $("#jenispt").prop("disabled", !1);
            var i = $("#strata").val();
            if (i == "D-III" || i == "D-IV" || i == "S1" || i == "Profesi" || i == "Spesialis")
            {
                $("#lulusantahun").hide(),
                  $("#lulus_tahun").attr("required", !1),
                  $("#ipk").show(),
                  $("#nilai_ip").attr("required", !0),
                  $("#nilai_ip").attr("name", "nilai_ip"),
                  $("#nilai_ip2").attr("required", !1),
                  $("#nilai_ip2").attr("name", "nilai_ip2"),
                  $("#un").hide(),
                  $("#nilai_un").attr("required", !1),
                  $("#nilai_un").attr("name", "x"),
                  $("#evaluasi").hide(),
                  $("#nilai_evaluasi").attr("required", !1),
                  $("#nilai_evaluasi").attr("name", "x");
            } else 
            {
                $("#lulusantahun").hide(),
                  $("#lulus_tahun").attr("required", !1),
                  $("#ipk2").show(),
                  $("#nilai_ip2").attr("required", !0),
                  $("#nilai_ip2").attr("name", "nilai_ip"),
                  $("#nilai_ip").attr("required", !1),
                  $("#nilai_ip").attr("name", "nilai_ip1"),
                  $("#un").hide(),
                  $("#nilai_un").attr("required", !1),
                  $("#nilai_un").attr("name", "x"),
                  $("#evaluasi").hide(),
                  $("#nilai_evaluasi").attr("required", !1),
                  $("#nilai_evaluasi").attr("name", "x");
            }
        }),
        $("#lulus_tahun").change(function () {
            var i = $("#lulus_tahun").val();
            "2020-" === i
                ? ($("#un").show(),
                  $("#nilai_un").attr("required", !0),
                  $("#nilai_un").attr("name", "nilai_ip"),
                  $("#evaluasi").hide(),
                  $("#nilai_evaluasi").attr("required", !1),
                  $("#nilai_evaluasi").attr("name", "x"),
                  $("#ipk").hide(),
                  $("#nilai_ip").attr("required", !1),
                  $("#nilai_ip").attr("name", "x"))
                : "2020+" === i &&
                  ($("#un").hide(),
                  $("#nilai_un").attr("required", !1),
                  $("#nilai_un").attr("name", "x"),
                  $("#evaluasi").show(),
                  $("#nilai_evaluasi").attr("required", !0),
                  $("#nilai_evaluasi").attr("name", "nilai_ip"),
                  $("#ipk").hide(),
                  $("#nilai_ip").attr("required", !1),
                  $("#nilai_ip").attr("name", "x"));
        }),
        $("#jenispt").change(function () {
            var i = $("#jenispt").val();
            $.ajax({ method: "POST", url: "/get-pt/stimulan/dikti", data: { jpt: i } }).done(function (i) {
                $("#dikti").prop("disabled", !1), $("#dikti").html(i);
            });
        }),
        $("#dikti").change(function () {
            var i = $("#dikti").val(),
                a = $("#strata").val();
            $.ajax({ method: "POST", url: "/get-pt/stimulan/prodi", data: { dikti: i, strata: a } }).done(function (i) {
                $("#prodi").prop("disabled", !1), $("#prodi").html(i);
            });
        }),
        $(".js-example-basic-single").select2(),
        $("ukt").keydown(function (i) {
            -1 !== $.inArray(i.keyCode, [46, 8, 9, 27, 13, 110]) ||
                (65 == i.keyCode && (!0 === i.ctrlKey || !0 === i.metaKey)) ||
                (35 <= i.keyCode && i.keyCode <= 40) ||
                ((i.shiftKey || i.keyCode < 48 || 57 < i.keyCode) && (i.keyCode < 96 || 105 < i.keyCode) && i.preventDefault());
        }),
        $("#ukt").keyup(function (i) {
            37 <= i.which && i.which <= 40 && i.preventDefault(),
                $(this).val(function (i, a) {
                    return ((e = (a = a.replace(/,/g, "")).toString().split("."))[0] = e[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",")), e.join(".");
                    var e;
                });
        }),
        $("#biaya_sertifikasi").keydown(function (i) {
            -1 !== $.inArray(i.keyCode, [46, 8, 9, 27, 13, 110]) ||
                (65 == i.keyCode && (!0 === i.ctrlKey || !0 === i.metaKey)) ||
                (35 <= i.keyCode && i.keyCode <= 40) ||
                ((i.shiftKey || i.keyCode < 48 || 57 < i.keyCode) && (i.keyCode < 96 || 105 < i.keyCode) && i.preventDefault());
        }),
        $("#biaya_sertifikasi").keyup(function (i) {
            37 <= i.which && i.which <= 40 && i.preventDefault(),
                $(this).val(function (i, a) {
                    return ((e = (a = a.replace(/,/g, "")).toString().split("."))[0] = e[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",")), e.join(".");
                    var e;
                });
        }),
        $(".allownumericwithoutdecimal").on("keypress keyup blur", function (i) {
            $(this).val(
                $(this)
                    .val()
                    .replace(/[^\d].+/, "")
            ),
                (i.which < 48 || 57 < i.which) && i.preventDefault();
        });
});

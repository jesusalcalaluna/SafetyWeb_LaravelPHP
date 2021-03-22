/*---------------------------------------------
Template name :  Dashmin
Version       :  1.0
Author        :  ThemeLooks
Author url    :  http://themelooks.com


** Custom Sweetalert JS

----------------------------------------------*/


$(function() {
    'use strict';

    $(document).ready(function () {
        
        $("#type-success").on("click", function () {
            Swal.fire({ title: "Good job!", text: "You clicked the button!", type: "success", confirmButtonClass: "btn long", buttonsStyling: !1 });
        }),
        $("#type-info").on("click", function () {
            Swal.fire({ title: "Info!", text: "You clicked the button!", type: "info", confirmButtonClass: "btn long", buttonsStyling: !1 });
        }),
        $("#type-warning").on("click", function () {
            Swal.fire({ title: "Warning!", text: " You clicked the button!", type: "warning", confirmButtonClass: "btn long", buttonsStyling: !1 });
        }),
        $("#type-error").on("click", function () {
            Swal.fire({ title: "Error!", text: " You clicked the button!", type: "error", confirmButtonClass: "btn long", buttonsStyling: !1 });
        })
    });
});
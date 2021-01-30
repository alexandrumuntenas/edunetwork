function googlebooks() {
    var isbn = $("#ISBN").val();
    $.ajax({
        type: "POST",
        url: "./bp-include/modules/ajax-calls/gbook.php",
        data: {
            gbook: isbn,
        },
        success: function (html) {
            $("#gapisresult").html(html).show();
        },
    });
}

require('./bootstrap');

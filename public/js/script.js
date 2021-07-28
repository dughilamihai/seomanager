$(function () {
    $(".btn-site").click(function () {
        var id = $(this).attr("id");
        url = window.location.origin + '/go_to/' + id;
        window.open(url, '_blank');
    });
});


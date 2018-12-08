$("[data-type='detail']").click(function () {
    location.href = url + "/detail/" + $(this).attr("data-id");
});
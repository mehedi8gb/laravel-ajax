//custom jquery method for toggle attr


function notify(type = "dark", message = "") {
    $.notify({
        // options
        message: message,
    }, {
        // settings
        showProgressbar: true,
        delay: 2500,
        mouse_over: "pause",
        placement: {
            from: "bottom",
            align: "left",
        },
        animate: {
            enter: "animated fadeInUp",
            exit: "animated fadeOutDown",
        },
        type: type,
        template: '<div data-notify="container" class="aiz-notify alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" data-notify="dismiss" class="close"><i class="las la-times"></i></button>' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            "</div>" +
            "</div>",
    });
}
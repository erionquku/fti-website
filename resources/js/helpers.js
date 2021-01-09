function showAlert(type, message, boldMessage = "") {
    return '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert" id="singlealert">\n' +
        '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
        '    <span aria-hidden="true">&times;</span>\n' +
        '  </button>\n' +
        '  <strong>' + boldMessage + '</strong> ' + message +
        '</div>'
}

function login (path) {
    $.ajax({
        url: path,
        method: "POST",
        data: {
            "password": $("#password").val()
        },
        success: function (msg) {
            console.log("msg: " + msg);
            const response = JSON.parse(msg);
            if (!response.success) {
                $('#alerts').empty().prepend(showAlert('danger', response.message , 'Error!'));
            } else if (response.success) {
                window.location.replace("/home/");
            }
            $("#alerts").last().hide().fadeIn(200);
        }
    });
}

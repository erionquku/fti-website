function showAlert(type, message, boldMessage = "") {
    return '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert" id="singlealert">\n' +
        '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
        '    <span aria-hidden="true">&times;</span>\n' +
        '  </button>\n' +
        '  <strong>' + boldMessage + '</strong> ' + message +
        '</div>'
}

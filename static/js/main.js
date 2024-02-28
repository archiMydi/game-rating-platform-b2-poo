function showLoginForm() {
    $('form-input').value = "";

    $('.login-modal').show();
}

window.onclick = function (event) {
    let modalLogin = $('.login-modal')[0];
    if (event.target == modalLogin) {
        $(modalLogin).hide();
    }
}
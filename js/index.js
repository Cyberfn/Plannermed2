$('#btn_olho_senha').on('click', function() {
    if ($('#input_senha_login').attr('type') === 'password') {
        $('#input_senha_login').attr('type', 'text');
        $('#icon_olho_senha').removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    } else {
        $('#input_senha_login').attr('type', 'password');
        $('#icon_olho_senha').removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
    }
});
$("#form_cadastro_usuario").submit(function (event) {
  let valid = true;

  if (!$("#nome").val()) {
    valid = false;
    $("#nome").addClass("is-invalid");
    $("#nome").siblings(".invalid-feedback").text("Nome é obrigatório.");
  } else {
    $("#nome").removeClass("is-invalid");
  }

  if (!$("#login").val()) {
    valid = false;
    $("#login").addClass("is-invalid");
    $("#login").siblings(".invalid-feedback").text("Username é obrigatório.");
  } else {
    $("#login").removeClass("is-invalid");
  }

  if (!validateEmail($("#email").val())) {
    valid = false;
    $("#email").addClass("is-invalid");
    $("#email")
      .siblings(".invalid-feedback")
      .text("Por favor, insira um email válido.");
  } else {
    $("#email").removeClass("is-invalid");
  }

  if (!$("#tipo_usuario").val()) {
    valid = false;
    $("#tipo_usuario").addClass("is-invalid");
  } else {
    $("#tipo_usuario").removeClass("is-invalid");
  }

  if ($("#senha").val().length < 6) {
    valid = false;
    $("#senha").addClass("is-invalid");
    $("#senha-error").show();
  } else {
    $("#senha").removeClass("is-invalid");
    $("#senha-error").hide();
  }

  if ($("#senha").val() !== $("#senha_confirmacao").val()) {
    valid = false;
    $("#senha_confirmacao").addClass("is-invalid");
    $("#senha-confirmacao-error").show();
  } else {
    $("#senha_confirmacao").removeClass("is-invalid");
    $("#senha-confirmacao-error").hide();
  }

  if (!valid) {
    event.preventDefault();
  }
});

function validateEmail(email) {
  let re = /\S+@\S+\.\S+/;
  return re.test(email);
}

$("#btn_voltar").click(function () {
  window.location.href = "index.php";
});

$(document).ready(function() {
    function validateEmail(email) {
      let re = /\S+@\S+\.\S+/;
      return re.test(email);
    }
  
    $("#form_confirma_dados").submit(function(event) {
      let valid = true;
  
      if (!$("#email").val()) {
        valid = false;
        $("#email").addClass("is-invalid");
        $("#email").siblings(".invalid-feedback").text("Email é obrigatório.");
      } else if (!validateEmail($("#email").val())) {
        valid = false;
        $("#email").addClass("is-invalid");
        $("#email").siblings(".invalid-feedback").text("Por favor, insira um email válido.");
      } else {
        $("#email").removeClass("is-invalid");
      }
  
      if (!$("#login").val()) {
        valid = false;
        $("#login").addClass("is-invalid");
        $("#login").siblings(".invalid-feedback").text("Username é obrigatório.");
      } else {
        $("#login").removeClass("is-invalid");
      }
  
      if ($("#senha").val().length < 6) {
        valid = false;
        $("#senha").addClass("is-invalid");
        $("#senha-error").show();
      } else {
        $("#senha").removeClass("is-invalid");
        $("#senha-error").hide();
      }
  
      if ($("#senha").val() !== $("#confirma").val()) {
        valid = false;
        $("#confirma").addClass("is-invalid");
        $("#senha-confirmacao-error").show();
      } else {
        $("#confirma").removeClass("is-invalid");
        $("#senha-confirmacao-error").hide();
      }
  
      if (!valid) {
        event.preventDefault();
      }
    });
  
    function mostrarOcultarSenha(button, inputId) {
      var input = $("#" + inputId);
      var icon = button.find("i");
      if (input.attr("type") === "password") {
        input.attr("type", "text");
        icon.removeClass("bi-eye-fill").addClass("bi-eye-slash-fill");
      } else {
        input.attr("type", "password");
        icon.removeClass("bi-eye-slash-fill").addClass("bi-eye-fill");
      }
    }
  
    $("#btn_mostrar_senha").on("click", function() {
      mostrarOcultarSenha($(this), "senha");
    });
  
    $("#btn_mostrar_confirma").on("click", function() {
      mostrarOcultarSenha($(this), "confirma");
    });
  
    $("#btn_voltar").click(function() {
      window.location.href = "index.php";
    });
  });
  
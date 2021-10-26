$(document).ready(function() {
  $(".mbr-form").submit(function() {
      var name = $(".mbr-form input[name='name']").val();
      var email = $(".mbr-form input[name='email']").val();
      var phone = $(".mbr-form input[name='phone']").val();
      var cidade = $(".mbr-form input[name='cidade']").val();
      if(name && email && phone && cidade) {
          $.ajax({
            url: 'sendEmailContato.php',
            data: {
              name: name,
              email: email,
              phone: phone,
              cidade: cidade
            },  
            type: 'POST',
            success: function(data){
              console.log("success: ", data);
              $(".mbr-form")[0].reset();
              $('[data-form-type="formoid"]').find("[data-form-alert-danger]").attr('hidden', 'hidden')
              $('[data-form-type="formoid"]').find("[data-form-alert]").removeAttr('hidden');
            },
            error: function(errors) {
              console.log("errors: ", errors);
              //(".mbr-form")[0].reset();
              $('[data-form-type="formoid"]').find("[data-form-alert]").attr('hidden', 'hidden');
              $('[data-form-type="formoid"]').find("[data-form-alert-danger]").removeAttr('hidden').text("Ocorreu um erro ao enviar seu e-mail. Por gentileza tente novamente mais tarde.");
            }
          });
      } else {
          $('[data-form-type="formoid"]').find("[data-form-alert]").attr('hidden', 'hidden');
          $('[data-form-type="formoid"]').find("[data-form-alert-danger]").removeAttr('hidden').text("Preencha todos os campos");
      }
      return false;
  });
});
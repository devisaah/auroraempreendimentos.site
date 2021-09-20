$(document).ready(function() {
    $(".mbr-form").submit(function() {
        $.ajax({
          url: 'sendEmailContato.php',
          data: {
            name: $(".mbr-form input[name='name']").val(),
            email: $(".mbr-form input[name='email']").val(),
            phone: $(".mbr-form input[name='phone']").val(),
            cidade: $(".mbr-form input[name='cidade']").val()
          },  
          type: 'POST',
          success: function(data){
            console.log("success: ", data);
            $(".mbr-form")[0].reset();
            $('[data-form-type="formoid"]').find("[data-form-alert]").removeAttr('hidden');
          },
          error: function(errors) {
            console.log("errors: ", errors);
            $(".mbr-form")[0].reset();
            $('[data-form-type="formoid"]').find("[data-form-alert-danger]").removeAttr('hidden');
          }
        });
        return false;
    });
});
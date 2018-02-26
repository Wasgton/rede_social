//Validação de campos em branco

$(document).ready( function () {
    $('#btn_login').click(function () {
        var campo_vazio = false;

        if($('#campo_usuario').val()==''){
            $('#campo_usuario').css({'border-color': 'red'});
            campo_vazio =  true;
        }else{
            $('#campo_usuario').css({'border-color': '#CCC'});
        }
        if($('#campo_senha').val()==''){
            $('#campo_senha').css({'border-color': 'red'});
            campo_vazio =  true;
        }else{
            $('#campo_senha').css({'border-color': '#CCC'});
        }
        if(campo_vazio) return false;
    });

    $('#senha').blur(function(){
        var senha = $('#senha').val();

        if(senha.length<6){
            $('#senha').focus();
            $('#senha').css({'border-color': 'red'});
            $('#erro').html('Senha precisa conter pelo menos 6 digitos');
        }

      $('#cadastrar').click(function () {
          if(senha.length<6) {
              return false;
          }
      })

    });

});
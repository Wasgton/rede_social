$(document).ready(function () {
//validação do post e inclusão via ajax
$('#btn_comentar').click(function (){
    var texto_comentario = $('#comentario').val();
    var id_post_comentario = $('#id_post_comentario').val();

    if(texto_comentario.trim().length>0){
        $.ajax({
            url:'incluir_comentario.php',
            method: 'post',
            data:{comentario:texto_comentario,id_post:id_post_comentario},
            success: function (data) {
                $('#post').val('');
                location.href="comentario.php?id="+id_post_comentario;
            }
        });
    }else{
        return false;
    }
});

function get_comentario(){

var id_post = $('#id_post_comentario').val();

        $.ajax({
            url:'get_comentario.php',
            method: 'post',
            data:{id_post:id_post},
            success: function(data){
                //exibe os post recuperados
                $('#comentarios').html(data);
            }
        });
}
    get_comentario();
});
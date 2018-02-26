
$(document).ready(function (){
    //requisição para seguir
    $('.btn_seguir').click(function () {
        console.log(1)
        var id_usuario = $(this).data('id_usuario');
        $.ajax({
            url: 'seguir.php',
            method: 'post',
            data: {usuario: id_usuario},
            success: function (data) {
                $('#btn_seguir_' + id_usuario).hide();
                $('#btn_deixar_seguir_' + id_usuario).show();
            }
        });
    });
    //requisição para deixar de seguir
    $('.btn_deixar_seguir').click(function () {
        console.log(1)
        var id_usuario = $(this).data('id_usuarios');
        $.ajax({
            url: 'deixar_seguir.php',
            method: 'post',
            data: {deixar_seguir: id_usuario},
            success: function (data) {
                $('#btn_seguir_' + id_usuario).show();
                $('#btn_deixar_seguir_' + id_usuario).hide();
            }
        });
    });
});
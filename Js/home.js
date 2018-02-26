
    $(document).ready(function () {

        //validação do post e inclusão via ajax
        $('#btn_post').click(function (){
            var texto_post = $('#post').val();
            if(texto_post.trim().length>0){
                $.ajax({
                    url:'inclui_post.php',
                    method: 'post',
                    data:{postagem:texto_post},
                    success: function (data) {
                        $('#post').val('');
                        get_post();
                    }
                });
            }else{
                alert("Não é permitido realizar postagens em branco!");
                texto_post.css({'border-color': 'red'});
                texto_post.focus();
                return false;
            }
        });

    // Recupera os post
    function get_post(){
     $.ajax({
       url:'get_posts.php',
       success: function(data){
        //exibe os post recuperados
        $('#posts').html(data);
               //verifica se o botão de curtir foi clicado para adicionar a curtida
               $('.btn_curtir').click(function () {
                    var id_post = $(this).data('id_post');
                    $.ajax({
                       url:'curtir.php',
                       method: 'post',
                       data:{id_post:id_post},
                       success: function (data) {
                           get_post();
                       }
                   });
               });
                       // verifica se o botão de curtir foi clicado para remover a curtida
                       $('.btn_deixar_curtir').click(function () {
                           var id_post = $(this).data('id_post');
                           $.ajax({
                               url:'deixar_curtir.php',
                               method: 'post',
                               data:{id_post:id_post},
                               success: function (data) {
                                   get_post();
                               }
                           });
                       });
       }
     });
    }
    get_post();
});
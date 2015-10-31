/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#e-id').on('click',function() {
    var ids = $('#grid').yiiGridView('getSelectedRows');
    var ajaxRequest=$.ajax({
            type:"POST",
            url:"index.php?r=perfil-mongo/delete-few",
            dataType:"json",
            data:{ids:ids}
            });
    ajaxRequest.done(function(mensaje){
       // $('#id-men').text(mensaje);
        
        $.pjax.reload({url:"index.php?r=perfil-mongo/index&mensaje="+mensaje,container:'#grid'}); 
    });

   
});

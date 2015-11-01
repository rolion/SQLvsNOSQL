/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#id-mongo-link').on('click',function() {
    var ids = $('#id-grid-mongo').yiiGridView('getSelectedRows');
    var ajaxRequest=$.ajax({
            type:"POST",
            url:"index.php?r=perfil-mongo/delete-few",
            dataType:"json",
            data:{ids:ids}
            });
    ajaxRequest.done(function(mensaje){
        $.pjax.reload({url:"index.php?r=perfil-mongo/index&mensaje="+mensaje,container:'#id-grid-mongo'}); 
    });

   
});
$('#id-sql-link').on('click',function() {
    var ids = $('#id-grid-sql').yiiGridView('getSelectedRows');
    var ajaxRequest=$.ajax({
            type:"POST",
            url:"index.php?r=persona/delete-few",
            dataType:"json",
            data:{ids:ids}
            });
    ajaxRequest.done(function(mensaje){
        $.pjax.reload({url:"index.php?r=persona/index&mensaje="+mensaje,container:'#id-grid-sql'}); 
    });
    ajaxRequest.fail(function(jqXHR, textStatus){
        alert('jqXHR: '+jqXHR+ 'textStatus: '+textStatus);
    });

   
});
$('#id-asset-link').on('click',function() {
    var ids = $('#id-grid-asset-mongo').yiiGridView('getSelectedRows');
    var ajaxRequest=$.ajax({
            type:"POST",
            url:"index.php?r=asset/delete-selected",
            dataType:"json",
            data:{ids:ids}
            });
    ajaxRequest.done(function(mensaje){
        $.pjax.reload({url:"index.php?r=asset/index&mensaje="+mensaje,container:'#id-grid-asset-mongo'}); 
    });
    ajaxRequest.fail(function(jqXHR, textStatus){
        alert('jqXHR: '+jqXHR+ 'textStatus: '+textStatus);
    });

   
});

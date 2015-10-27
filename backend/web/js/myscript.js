/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#e-id').on('click',function() {
    var keys = $('#grid').yiiGridView('getSelectedRows');
    alert(keys);
});

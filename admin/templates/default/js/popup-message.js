$(document).ready(function(){

    $('.alert').alert();

    $('.close').click(function(){
        $(this).parents('.alert').alert('close');
    });

});
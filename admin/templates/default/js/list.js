$(document).ready(function(){

    //Установка/Снятие галочек в списке
    $('.check-all').change(function(){

        var checks = $('.check-item');
        if ($(this).is(':checked')) {
            checks.attr('checked','checked');
        }
        else {
            checks.removeAttr('checked');
        }
    });

    //Запуск фильтра
    $('.filter').change(function(){
        $(this).parents('form').submit();
    });
});
/**
 * Created by Алексей on 23.03.2017.
 */

$(document).ready(function(){
    $('body').on('click', '.hours_change',function(e){
        e.stopPropagation();
        e.preventDefault();
        var form = $(this).closest('form');
        console.log(form);
        form.find('.hours_change').hide();
        form.find('.hours_input').show();
        form.find('.hours_save').show();
        form.find('.hours_view').hide();
    })
        //При изменении в поле формы НОМЕР ПРОЕКТА или НАИМЕНОВАНИЕ ПРОЕКТА выполнить функцию
    $('body').on('change','#timesheet-project_number_id, #timesheet-project_name_id',function(e){
       /* $.ajax({
            type: "POST",
            url: "/timesheet/create",
            data: { project_id: $(this).val()},
            success: function(msg){
                //alert(msg);
                $('#select2-timesheet-project_name_id-container').html(msg);
            }
        });
       // alert($(this).val());
       */
       // var project_id =$("#timesheet-project_number_id option:selected").val();
        //получаю id выбранного проекта
        var project_id =$(this).find('option:selected').val();
        //Получаю значение атрибута href скрытой ссылки, которую исспользую для pjax-запроса
        var href=$('#id_link').attr('href');
        //добавляю параметр в href, благодаря этому выбранное значение не пропадает в поле формы после выполнения pjax запроса
        href+="?project_id="+project_id;
        //Пприсваиваю новое значение атрибуту href
        $('#id_link').attr('href',href);
        //кликаю на невидимую ссылку во вьюхе
        $('#id_link').click();

    })
    $('body').on('change','#timesheet-order_number_id',function(e){
        //получаю id выбранного заказа
        var order_id =$(this).find('option:selected').val();
        //Получаю значение атрибута href скрытой ссылки, которую исспользую для pjax-запроса
        var href=$('#id_link').attr('href');
        //добавляю параметр в href, благодаря этому выбранное значение не пропадает в поле формы после выполнения pjax запроса
        href+="?order_id="+order_id;
        //Пприсваиваю новое значение атрибуту href
        $('#id_link').attr('href',href);
        //кликаю на невидимую ссылку во вьюхе
        $('#id_link').click();

    })

})


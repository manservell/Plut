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
        var project_id =$(this).find('option:selected').val();
        var href=$('#id_link').attr('href');
        href+="?project_id="+project_id; //передаю параметр в адресной строке, благодаря этому выбранное значение не пропадает в поле формы после выполнения pjax запроса
        $('#id_link').attr('href',href);
        $('#id_link').click(); //кликаю на невидимую ссылку во вьюхе

    })
    $('body').on('change','#timesheet-order_number_id',function(e){
        var order_id =$(this).find('option:selected').val();
        var href=$('#id_link').attr('href');
        href+="?order_id="+order_id; //передаю параметр в адресной строке, благодаря этому выбранное значение не пропадает в поле формы после выполнения pjax запроса
        $('#id_link').attr('href',href);
        $('#id_link').click(); //кликаю на невидимую ссылку во вьюхе

    })

})


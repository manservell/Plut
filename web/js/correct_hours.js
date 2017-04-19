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
        //alert(project_id);
        var href=$('#project_number_id_link').attr('href');
       // alert(href);
        href+="?project_id="+project_id;
       // alert(href);
        $('#project_number_id_link').attr('href',href);
        $('#project_number_id_link').click();

    })





})

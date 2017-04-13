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
    $('body').on('change','#timesheet-project_number_id',function(e){
       /* $.ajax({
            type: "POST",
            url: "/timesheet/create",
            data: { project_id:  },
            success: function(data){
                alert(data);
            }
        });*/
        console.log (e);
    })





})

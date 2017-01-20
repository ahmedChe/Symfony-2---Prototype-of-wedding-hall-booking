/**
 * Created by !L-PAzZ0 on 10/06/2016.
 */
function proposition(id)
{
    $('#form_propositions_propositions').empty();
    $('#form_propositions_propositions').append("<option>Loading...</option>");
    $.ajax({
        type:"POST",
        url: "{{ path('propositions') }}",
        data: {'id': id},
        success: function(msg)
        {
            $('#form_propositions_propositions').empty();
            if (msg != ''){
                $('#form_propositions_propositions').html(msg);
            }
            else
            {
                $('#form_propositions_propositions').html('<em>Pas de proposition</em>');
            }
        },
        complete: function()
        {}
    });
}
$(document).ready(function(){
    $('#form_propositions_libelleService').change(function(){
        var id=$('#form_propositions_libelleService').val();
        proposition(id);
    });
});

var password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");
function validatePassword()
{
    if(password.value != confirm_password.value)
    {
        confirm_password.setCustomValidity.badInput;
    }
}
var validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
$(document).ready(function () {
    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],input[type='file'],input[type='password']"),
            isValid = true;
        var test=true;
        var password = document.getElementById("password")
            , confirm_password = document.getElementById("confirm_password");
        if(password.value != confirm_password.value)
        {
            test=false;
        }
        else
        {
            test=true;
        }
        $(".form-group").removeClass("has-error");

        for(var i=0; i<curInputs.length; i++)
        {
            if((curInputs[i].type=='password') && !test)
            {
                isValid = false;

                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
            if ((!curInputs[i].validity.valid) ||(curInputs[i].validity.patternMismatch)||(curInputs[i].validity.badInput)||(curInputs[i].validity.typeMismatch))
            {
                isValid = false;

                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }

            //alert(curInputs[i].type);
            if(curInputs[i].type=='file')
            {
                //alert("ok");
                var FileName = curInputs[i].value;

                if (FileName.length > 0)
                {
                    isValid = false;
                    for (var j = 0; j < validFileExtensions.length; j++)
                    {
                        var CurrentExtension = validFileExtensions[j];
                        if (FileName.substr(FileName.length - CurrentExtension.length, CurrentExtension.length).toLowerCase() == CurrentExtension.toLowerCase())
                        {
                            isValid = true;
                            break;
                        }
                    }
                    if (!isValid)
                    {
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
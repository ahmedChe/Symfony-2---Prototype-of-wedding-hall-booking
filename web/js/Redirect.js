/**
 * Created by !L-PAzZ0 on 02/06/2016.
 */

    $(document).ready(function(){
        activaTab('create');
    });

function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};

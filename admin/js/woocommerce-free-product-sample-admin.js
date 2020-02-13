jQuery(function () {

    jQuery(".enable_freesample").on('click', function(){

        if(jQuery(this).is(':checked')){
            jQuery(".enabled-area").show();          
        } else {
            jQuery(".enabled-area").hide();
        }
        
    });

    let enable_freesample = jQuery(".enable_freesample").val();
    if( enable_freesample == "open" ){
        jQuery(".enabled-area").show();
    }

   jQuery("#wfp_from_date, #wfp_to_date").datetimepicker();

});



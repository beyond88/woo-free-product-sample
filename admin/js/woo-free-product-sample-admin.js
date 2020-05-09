jQuery(function ($) {

    let exclude_type = $("#exclude_type").val();
    if( exclude_type == 'product' ) {
        $('.exclude_product_area').show();
        $('.exclude_category_area').hide();
    } else {
        $('.exclude_product_area').hide();
        $('.exclude_category_area').show();
    }

});



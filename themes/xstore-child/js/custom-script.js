/**
 * Created by DynamicAction on 4/30/2018.
 */
jQuery(document).ready(function($){

    $('#place_order').live('click', function(e){
        $('.shipping-error').remove();
        $('.shipping').removeClass('error-tr');
        var checked_shipping = $('.shipping_method:checked').length;
        //console.log(checked_shipping);

        if(checked_shipping === 0){
            e.preventDefault();
            e.stopPropagation();
            var shipping_error = '<ul class="woocommerce-error" role="alert"><li>Please select your shipping method.</li></ul>';
            $('.shipping').addClass('error-tr');
            //console.log('NO shipping');
            $('<div class="shipping-error">'+shipping_error+'</div>').insertAfter('#payment');

        }
    });

    var check_wholesale = $('.woocommerce-checkout').hasClass('wholesale_customer');
    if(check_wholesale == false){
        //console.log(check_wholesale);
        // $('.woocommerce-checkout').find('#billing_address_google_field').remove();
        // $('.woocommerce-checkout').find('#shipping_address_google_field').remove();
    }
    if(check_wholesale == true){

    }

    //conversio recommended widget
    setTimeout(function(){
        $( ".rf-recommendation-product" ).each(function() {
            $( '.related_prod_container' ).hide();
            var prod_url = $(this).find('.rf-title a').attr('href');
            var prod_id = $(this).find('.rf-title a').attr('data-rf-track');
            var btn = add_bth_html(prod_id, prod_url);
            $( this ).append( btn );
            console.log("test");
        });
    }, 3000);

    function add_bth_html(id, link){
        var add_btn_html = '<a href="'+link+'" data-rf-track="'+id+'" data-rf-track-source="widget" data-rf-widget-name="default" class="button product_type_simple">Read more</a>';
        return add_btn_html;
    }
});
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1, maximum-scale=2.0"/>
	<?php wp_head(); ?>
	<style>
		.shopping-container .cart-bag .badge-number{
			background-color: #000;
			opacity: 1;
		}
		.shipping-error{
			position: relative;
			top: 10px;
			color: red;
		}
		.shipping-error .woocommerce-error{
			padding: 1em 4em !important;
		}		
		.woocommerce-info{
			border-top-color: #428ebf;
			color: #313131;
			background-color: #f8f8f8;	
			line-height: 1.6em;			
		}
		.woocommerce-info b, .cart-popup .woocommerce-Price-amount{
			color: #333;			
		}
		.woocommerce-checkout.wholesale_customer .quantity.buttons_added{
			opacity: 1;
		}
		.quantity{
			opacity: 1;
		}
		
		.quantity.buttons_added span:hover, table.cart .remove-item:hover,
		input[type=submit]:hover, .btn:hover, .back-top:hover, .button:hover, 
		.swiper-entry .swiper-custom-left:hover, .swiper-entry .swiper-custom-right:hover {
			background-color: #dadada;
		}
		.header-search.act-default [role=searchform] .btn:hover{
			background-color: #4a4a4a !important;
		}
		table.cart .product-details a:hover, .cart-widget-products .remove:hover, .cart-widget-products a:hover, .shipping-calculator-button, .tabs .tab-title:hover, .next-post .post-info .post-title, .prev-post .post-info .post-title, .form-submit input[type=submit]{
			color: #000 !important;
		}
        .form-submit input[type=submit]:hover{
            color: white !important;
        }
		.shipping-calculator-button:hover{
			text-decoration: underline; 			
		}
		.active.et-opened .tab-title.opened{
			border: 1px solid #e6e6e6;
		}
		.posts-nav-btn:hover .button:before{
			color: #cbcbcb;
		}
		
		#wc-stripe-payment-request-wrapper, #wc-stripe-payment-request-button-separator, .wholesale_customer .cart-subtotal{
			display: none !important;
		}
        .single-product .product-type-subscription .woocommerce-price-suffix{
            float: left;
        }
        .shipping.recurring-total{
            display: none;
        }
        .single-product .tabs{
            margin-bottom: 0;
        }
        .cart-subtotal-wholesale .wholesale-amount{
            font-size: 20px;
            font-weight: bold;
        }
        .cart-subtotal-wholesale .orginal-amount{
            padding-left: 5px;
            font-size: 18px;
        }
        .off-wholesale .wholesale-amount, .on-wholesale .orginal-amount {
            text-decoration: line-through;
        }
        .cart_totals th{
            width: 160px;
        }
        .cart-subtotal-wholesale th, .cart-subtotal-wholesale td{
            border-top: 2px solid #1e1e1e;
        }
        .wholesale-shipping p{
            font-size: 0.86rem;
            text-transform: uppercase;
            color: #1e1e1e;
            font-weight: bold;
        }

        ::-moz-selection { background: #d2c5ff !important; }
        ::selection { background: #d2c5ff !important; }
	</style>
	<script type="text/javascript">
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
				$('.woocommerce-checkout').find('#billing_address_google_field').remove();
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

	</script>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'et_after_body' ); ?>

<?php
$header_type = etheme_get_header_type();
?>

<div class="template-container">
	<?php if ( is_active_sidebar('top-panel') && etheme_get_option('top_panel') && etheme_get_option('top_bar')): ?>
		<div class="top-panel-container">
			<div class="top-panel-inner">
				<div class="container">
					<?php dynamic_sidebar( 'top-panel' ); ?>
					<div class="close-panel"></div>
				</div>
			</div>
		</div>
	<?php endif ?>
	<div class="mobile-menu-wrapper">
		<div class="container">
			<div class="navbar-collapse">
				<?php if(etheme_get_option('search_form')): ?>
					<?php etheme_search_form( array(
						'action' => 'default'
					)); ?>
				<?php endif; ?>
				<?php etheme_get_mobile_menu(); ?>
				<?php etheme_top_links( array( 'short' => true ) ); ?>
				<?php dynamic_sidebar('mobile-sidebar'); ?>
			</div><!-- /.navbar-collapse -->
		</div>
	</div>
	<div class="template-content">
		<div class="page-wrapper" data-fixed-color="<?php etheme_option( 'fixed_header_color' ); ?>">

<?php get_template_part( 'headers/' . $header_type ); ?>
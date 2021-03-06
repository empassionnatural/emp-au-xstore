<?php

add_action( 'woocommerce_init', 'empdev_woocommerce_redirect_product_url' );

function empdev_woocommerce_redirect_product_url() {

	if ( is_user_logged_in() ) {

		if ( isset( $_GET['redirect_permalink'] ) ) {
			wp_safe_redirect( $_GET['redirect_permalink'], 302 );
			exit;
		}
	}
}

add_action('woocommerce_add_to_cart', 'empdev_new_customers_redirect_purchase', 100);
function empdev_new_customers_redirect_purchase() {

	if( ! is_user_logged_in() ){
		if ( ! WC()->cart->is_empty()  ) {

			$cart = WC()->cart->get_cart();
			$empdev_limit_new_customers_ids = get_option( 'empdev_limit_new_customers_ids', false );
			$blog_link = get_bloginfo('url');

			foreach ( $cart as $cart_item_key => $cart_item ) {

				$cart_item_id = $cart_item['product_id'];

				if ( in_array( $cart_item_id, $empdev_limit_new_customers_ids ) ) {

					wp_redirect( $blog_link . '/my-account/?redirect_permalink='.$blog_link.'/cart/');
					die;

				}

			}
		}
	}

}


add_action('woocommerce_after_cart', 'empdev_new_customers_cart_restriction');

add_action('woocommerce_after_checkout_form', 'empdev_new_customers_cart_restriction');

function empdev_new_customers_cart_restriction(){

	if ( ! WC()->cart->is_empty()  ) {

		$empdev_limit_new_customers_ids = get_option( 'empdev_limit_new_customers_ids', false );
		$customer_orders = EMPDEV_WC_Static_Helper::get_recent_order();
		$blog_link = get_bloginfo('url');

		if ( ( is_cart() || is_checkout () ) && ! empty ( $empdev_limit_new_customers_ids ) && count( $customer_orders ) > 0 ){

			$cart = WC()->cart->get_cart();
			//var_dump($cart);
			$cart_item_id = null;
			$send_error_notice = false;
			foreach ( $cart as $cart_item_key => $cart_item ) {

				$cart_item_id = $cart_item['product_id'];

				if ( in_array( $cart_item_id, $empdev_limit_new_customers_ids ) ) {

					$send_error_notice = true;
					break;
				}

			}

			if($send_error_notice){
				wc_clear_notices();
				$product_title = get_the_title($cart_item_id);

				if( is_user_logged_in() ){
					$message_title = "Sorry, ".$product_title." is only valid for new customers! ";
				} else {
					$message_title = "Login is required to purchase ".$product_title . ". <span><a href='".$blog_link."/my-account/?redirect_permalink=".$blog_link."/cart'>Click here to login.</a></span>";
				}

				$message = __( $message_title, "woocommerce" );
				wc_add_notice( $message, 'error' );
			}

		}

	}

}

function etheme_top_links($args = array()) {

	$links = etheme_get_links($args);
	if( ! empty($links)) :
		?>

			<?php foreach ($links as $link): ?>

				<?php

				$submenu = '';

				if( isset( $link['submenu'] ) ) {
					$submenu = $link['submenu'];
				}

				printf(
					$submenu
				);
				?>
			<?php endforeach ?>

	<?php endif;

}

function etheme_get_links($args) {
	extract(shortcode_atts(array(
		'short'  => false,
		'popups'  => true,
	), $args));
	$links = array();

	$reg_id = etheme_tpl2id('et-registration.php');

	$login_link = wp_login_url( get_permalink() );

	if( class_exists('WooCommerce')) {
		$login_link = get_permalink( get_option('woocommerce_myaccount_page_id') );
	}

	if(etheme_get_option('promo_popup')) {
		$links['popup'] = array(
			'class' => 'popup_link',
			'link_class' => 'etheme-popup',
			'href' => '#etheme-popup-holder',
			'title' => etheme_get_option('promo-link-text'),
		);
		if(!etheme_get_option('promo_link')) {
			$links['popup']['class'] .= ' hidden';
		}
		if(etheme_get_option('promo_auto_open')) {
			$links['popup']['link_class'] .= ' open-click';
		}
	}

	if( etheme_get_option('top_links') ) {
		$class = ( etheme_get_header_type() == 'hamburger-icon' ) ? ' type-icon' : '';
		if ( is_user_logged_in() ) {
			if( class_exists('WooCommerce')) {
				if ( has_nav_menu( 'my-account' ) ) {
					$submenu = wp_nav_menu(array(
						'theme_location' => 'my-account',
						'before' => '',
						'container_class' => 'menu-main-container',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 100,
						'fallback_cb' => false,
						'walker' => new ETheme_Navigation,
						'echo' => false
					));
				} else {
					$submenu = '<ul class="dropdown-menu">';
					$permalink = wc_get_page_permalink( 'myaccount' );

					foreach ( wc_get_account_menu_items() as $endpoint => $label ) {
						$url = ( $endpoint != 'dashboard' ) ? wc_get_endpoint_url( $endpoint, '', $permalink ) : $permalink ;
						$submenu .= '<li class="' . wc_get_account_menu_item_classes( $endpoint ) . '"><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
					}

					$submenu .= '</ul>';
				}

				$links['my-account'] = array(
					'class' => 'my-account-link' . $class,
					'link_class' => '',
					'href' => get_permalink( get_option('woocommerce_myaccount_page_id') ),
					'title' => esc_html__( 'Account', 'xstore' ),
					'submenu' => $submenu
				);

			}
			// $links['logout'] = array(
			//     'class' => 'logout-link' . $class,
			//     'link_class' => '',
			//     'href' => wp_logout_url(home_url()),
			//     'title' => esc_html__( 'Logout', 'xstore' )
			// );
		} else {

			$login_text = ($short) ? esc_html__( 'Sign In', 'xstore' ): esc_html__( 'Login | Register', 'xstore' );

//			$links['login'] = array(
//				'class' => 'login-link' . $class,
//				'link_class' => '',
//				'href' => $login_link,
//				'title' => $login_text
//			);

			if(!empty($reg_id)) {
				$links['register'] = array(
					'class' => 'register-link' . $class,
					'link_class' => '',
					'href' => get_permalink($reg_id),
					'title' => esc_html__( 'Register', 'xstore' )
				);
			}

		}
	}

	return apply_filters('etheme_get_links', $links);
}

if ( class_exists( 'WJECF_Wrap' ) ) {

	add_filter( 'woocommerce_coupon_is_valid', 'empdev_exclude_sale_free_products', 20, 2 );

	function empdev_exclude_sale_free_products( $valid, $coupon ) {

		$wrap_coupon          = WJECF_Wrap( $coupon );
		$exclude_sales_items  = $wrap_coupon->get_meta( 'exclude_sale_items' );
		$get_free_product_ids = WJECF_API()->get_coupon_free_product_ids( $coupon );

		if ( ! empty( $get_free_product_ids ) && $exclude_sales_items === true ) {

			$get_coupon_minimum_amount = $wrap_coupon->get_meta( 'minimum_amount' );

			$cart = WC()->cart->get_cart();

			//var_dump(WC()->cart->get_totals());
			//reference meta abstract-wc-product.php

			$calculate_regular_price = 0;
			foreach ( $cart as $cart_item_key => $cart_item ) {

				$cart_item_id = $cart_item['product_id'];

				if ( ! in_array( $cart_item_id, $get_free_product_ids ) ) {
					$sale_price         = $cart_item['data']->get_sale_price();
					$cart_item_quantity = $cart_item['quantity'];

					if ( empty( $sale_price ) ) {

						$regular_price = $cart_item['data']->get_regular_price();

						$calculate_regular_price += (float) $regular_price * (int) $cart_item_quantity;
					}
				}

			}

			if ( $calculate_regular_price < (float) $get_coupon_minimum_amount ) {
				return false;
			}

		}

		return $valid;
	}
}
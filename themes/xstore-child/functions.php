<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array( 'bootstrap' ) );


	if ( is_rtl() ) {
		wp_enqueue_style( 'rtl-style', get_template_directory_uri() . '/rtl.css' );
	}

	$timestamp = strtotime( "now" );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'parent-style', 'bootstrap' ), '0.1.' . $timestamp
	);

	//wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array(), '', true );

}

add_action( 'pmpro_after_checkout', 'sync_woo_billing_func' );

if ( ! function_exists( 'sync_woo_billing_func' ) ) {
	function sync_woo_billing_func() {
		global $current_user;
		$user_id = get_current_user_id();

		update_user_meta( $user_id, 'billing_first_name', $_REQUEST['bfirstname'] );
		update_user_meta( $user_id, 'billing_last_name', $_REQUEST['blastname'] );
		update_user_meta( $user_id, 'billing_address_1', $_REQUEST['baddress1'] );
		update_user_meta( $user_id, 'billing_address_2', $_REQUEST['baddress2'] );
		update_user_meta( $user_id, 'billing_city', $_REQUEST['bcity'] );
		update_user_meta( $user_id, 'billing_state', $_REQUEST['bstate'] );
		update_user_meta( $user_id, 'billing_postcode', $_REQUEST['bzipcode'] );
		update_user_meta( $user_id, 'billing_country', $_REQUEST['bcountry'] );
		update_user_meta( $user_id, 'billing_email', $_REQUEST['bconfirmemail'] );
		update_user_meta( $user_id, 'billing_phone', $_REQUEST['bphone'] );

		update_user_meta( $user_id, 'shipping_first_name', $_REQUEST['bfirstname'] );
		update_user_meta( $user_id, 'shipping_last_name', $_REQUEST['blastname'] );
		update_user_meta( $user_id, 'shipping_address_1', $_REQUEST['baddress1'] );
		update_user_meta( $user_id, 'shipping_address_2', $_REQUEST['baddress2'] );
		update_user_meta( $user_id, 'shipping_city', $_REQUEST['bcity'] );
		update_user_meta( $user_id, 'shipping_state', $_REQUEST['bstate'] );
		update_user_meta( $user_id, 'shipping_postcode', $_REQUEST['bzipcode'] );
		update_user_meta( $user_id, 'shipping_country', $_REQUEST['bcountry'] );

	}
}

function wc_ninja_remove_password_strength() {
	if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
		wp_dequeue_script( 'wc-password-strength-meter' );
	}
}

add_action( 'wp_print_scripts', 'wc_ninja_remove_password_strength', 100 );

add_filter( "pmpro_registration_checks", "check_username" );

function check_username( $pmpro_continue_registration ) {
	$isValid                     = preg_match( '/^[-a-zA-Z0-9 .]+$/', $_REQUEST['username'] );
	$pmpro_error_fields[]        = "";
	$pmpro_continue_registration = true;
	if ( ! $isValid ) {
		pmpro_setMessage( __( "Invalid username. White space and Special character is not allowed.", 'paid-memberships-pro' ), "pmpro_error" );
		$pmpro_error_fields[]        = "username";
		$pmpro_continue_registration = false;
	}

	return $pmpro_continue_registration;
}

//conversio recommendation widget
//if ( function_exists( 'Receiptful' ) && method_exists( Receiptful()->recommendations, 'get_recommendations' ) ) {
//	add_action( 'woocommerce_after_single_product_summary', array(
//		Receiptful()->recommendations,
//		'display_recommendations'
//	), 12 );
//}

// check for empty-cart get param to clear the cart
add_action( 'woocommerce_init', 'woocommerce_clear_cart_url' );
function woocommerce_clear_cart_url() {
	global $woocommerce;
	if ( isset( $_GET['empty-cart'] ) ) {
		$woocommerce->cart->empty_cart();
	}
}
add_action( 'woocommerce_cart_actions', 'empdev_add_clear_cart_button', 20 );
function empdev_add_clear_cart_button() {

	echo '<button class="btn gray" onclick="if(confirm(\'Are you sure to remove all items?\'))window.location=\'//empassion.com.au/cart/?empty-cart=true\';else event.stopPropagation();event.preventDefault();">' . __( "Empty Cart", "woocommerce" ) . '</button>';

}

//wholesale notice filter
if( class_exists( 'WWP_Wholesale_Prices' ) ) {
	require_once( get_stylesheet_directory() . '/woocommerce-wholesale-prices-premium/class-wwpp-wholesale-price-requirement.php' );
}

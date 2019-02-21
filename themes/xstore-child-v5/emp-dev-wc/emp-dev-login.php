<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 30/07/2018
 * Time: 9:11 AM
 */

function my_account_login( $atts ) {
    $html  = '<div id="login-section">';

    $html .= '<div class="wpb_column vc_column_container vc_col-sm-6 vc_col-has-fill">';
    $html .= '<img class="bgPicLogin" src="http://staging.wa.empassion.com.au/wp-content/uploads/2018/07/Capture.png" alt="bg-pic-login">';
    $html .= '</div>';

    $html .= '<div id="login" class="wpb_column vc_column_container vc_col-sm-6 vc_col-has-fill">';
    $html .= '<div class="u-column1 col-1">';
    $html .= '<div class="container">';

    $html .= '<h2>Login</h2>';

    $html .= '<form method="post" class="woocommerce-form woocommerce-form-login login">';

    $html .= '<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">';
    $html .= '<label for="username">Username or email address&nbsp;<span class="required">*</span></label>';
    $html .= '<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="">';
    $html .= '</p>';

    $html .= '<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">';
    $html .= '<label for="password">Password&nbsp;<span class="required">*</span></label>';
    $html .= '<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password">';
    $html .= '</p>';

    $html .= '<div class="clear"></div>';

    $html .= '<p class="form-row">';
    $html .= '<input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="08d4b01eaa"><input type="hidden" name="_wp_http_referer" value="/my-account/">	';
    $html .= '<button id="btn-login" type="submit" class="woocommerce-Button button" name="login" value="Log in">Log in</button>';
    $html .= '<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">';
    $html .= '<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"> <span>Remember me</span>';
    $html .= '</label>';
    $html .= '</p>';

    $html .= '<p class="woocommerce-LostPassword lost_password">';
    $html .= '<a href="https://staging.wa.empassion.com.au/my-account/lost-password/">Lost your password?</a>';
    $html .= '</p>';


    $html .= '<div class="clear"></div>';
    $html .= '</form>';

    $html .= '<div class="et-facebook-login-wrapper"><a href="https://staging.wa.empassion.com.au/my-account/?facebook=login" class="et-facebook-login-button"><i class="fa fa-facebook"></i> Login with Facebook</a></div>';

    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    $html .= '</div>';

    return $html;
}
add_shortcode( 'my_account_login', 'my_account_login' );

function my_account_register( $atts ) {
    $html  = '<div id="login-section">';

    $html .= '<div class="wpb_column vc_column_container vc_col-sm-6 vc_col-has-fill">';
    $html .= '<img class="bgPicLogin" src="http://staging.wa.empassion.com.au/wp-content/uploads/2018/07/adult-beautiful-girl-blue-875862-1.jpg" alt="bg-pic-login">';
    $html .= '</div>';

    $html .= '<div id="login" class="wpb_column vc_column_container vc_col-sm-6 vc_col-has-fill">';
    $html .= '<div class="u-column1 col-1">';
    $html .= '<div class="container">';

    $html .= '<h2>Register</h2>';

    $html .= '<form method="post" class="woocommerce-form woocommerce-form-login login">';

    $html .= '<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">';
    $html .= '<label for="username">Username or email address&nbsp;<span class="required">*</span></label>';
    $html .= '<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="">';
    $html .= '</p>';

    $html .= '<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">';
    $html .= '<label for="password">Password&nbsp;<span class="required">*</span></label>';
    $html .= '<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password">';
    $html .= '</p>';

    $html .= '<div class="clear"></div>';

    $html .= '<p class="form-row">';
    $html .= '<input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="08d4b01eaa"><input type="hidden" name="_wp_http_referer" value="/my-account/">	';
    $html .= '<button id="btn-login" type="submit" class="woocommerce-Button button" name="login" value="Log in">Log in</button>';
    $html .= '<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">';
    $html .= '<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"> <span>Remember me</span>';
    $html .= '</label>';
    $html .= '</p>';

    $html .= '<p class="woocommerce-LostPassword lost_password">';
    $html .= '<a href="https://staging.wa.empassion.com.au/my-account/lost-password/">Lost your password?</a>';
    $html .= '</p>';


    $html .= '<div class="clear"></div>';
    $html .= '</form>';

    $html .= '<div class="et-facebook-login-wrapper"><a href="https://staging.wa.empassion.com.au/my-account/?facebook=login" class="et-facebook-login-button"><i class="fa fa-facebook"></i> Register with Facebook</a></div>';

    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    $html .= '</div>';

    return $html;
}
add_shortcode( 'my_account_register', 'my_account_register' );


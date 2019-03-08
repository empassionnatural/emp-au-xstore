<?php
/**
 * Template Name: Blank page - Landing Page
 *
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="user-scalable=1, width=device-width, initial-scale=1, maximum-scale=2.0"/>

    <?php wp_head(); ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            var select_country = '<select class="selectpicker">';
            select_country += '<option>Mustard</option>';
            select_country += '</select>';
            setTimeout(function(){
                jQuery('#switch-country').append(select_country);
            },2000);

        });
    </script>
    <style>

    </style>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'et_after_body' ); ?>
<?php
$ht = get_query_var('et_ht', 'xstore');
$color = get_query_var('et_header-color', 'dark');
$menu_class = 'menu-align-' . etheme_get_option('menu_align');
?>
<div id="top-bar-info landing-page" class="top-bar-info">
    <div class="container">
        <div class="col-md-8">

            <?php dynamic_sidebar( 'map-top-left-corner' ); ?>

        </div>
        <div class="col-md-4">
            <div class="text-right">

                <?php dynamic_sidebar( 'map-top-right-corner' ); ?>

            </div>
        </div>
    </div>
</div>
<div class="container-landing content-page-landing">

    <div class="content">
        <?php if(have_posts()): while(have_posts()) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; else: ?>

            <h3><?php esc_html_e('No pages were found!', 'xstore') ?></h3>

        <?php endif; ?>

    </div>

</div><!-- end container -->

<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */

wp_footer();
?>
<!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
    window.__lc = window.__lc || {};
    window.__lc.license = 8555798;
    (function() {
        var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
        lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
    })();
</script>
<!-- End of LiveChat code -->
</body>
</html>

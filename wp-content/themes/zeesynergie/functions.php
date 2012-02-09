<?php

// Theme Name
define('THEMEZEE_NAME', 'zeeSynergie');
define('THEMEZEE_INFO', 'http://themezee.com/zeesynergie');

//Content Width
$content_width = 480;

//Load Default Styles and Scripts for the Frontend
add_action('wp_enqueue_scripts', 'themezee_enqueue_scripts');
function themezee_enqueue_scripts() { 
	// Register and Enqueue Stylesheet
	wp_register_style('zee_stylesheet', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('zee_stylesheet');
	
	// Register Font
	wp_register_style('zee_main_font', 'http://fonts.googleapis.com/css?family=Paytone+One');
	wp_enqueue_style('zee_main_font');
	
	// Register and Enqueue Javascripts
	wp_enqueue_script('jquery');
	
	wp_register_script('zee_jquery-ui-min', get_template_directory_uri() .'/includes/js/jquery-ui-1.8.11.custom.min.js', array('jquery'));
	wp_enqueue_script('zee_jquery-ui-min');
	
	wp_register_script('zee_jquery-easing', get_template_directory_uri() .'/includes/js/jquery.easing.1.3.js', array('jquery', 'zee_jquery-ui-min'));
	wp_enqueue_script('zee_jquery-easing');
	
	wp_register_script('zee_jquery-cycle', get_template_directory_uri() .'/includes/js/jquery.cycle.all.min.js', array('jquery', 'zee_jquery-easing'));
	wp_enqueue_script('zee_jquery-cycle');
	
	wp_register_script('zee_slidemenu', get_template_directory_uri() .'/includes/js/jquery.slidemenu.js', array('jquery'));
	wp_enqueue_script('zee_slidemenu');
}
locate_template('/includes/js/jscript.php', true);
locate_template('/includes/styles/custom-css.php', true);

// init Localization
load_theme_textdomain('themezee_lang', TEMPLATEPATH . '/includes/lang');

// include Admin Files
locate_template('/includes/admin/theme-functions.php', true);
locate_template('/includes/admin/theme-settings.php', true);
locate_template('/includes/admin/theme-admin.php', true);

// Add Theme Functions
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_editor_style();
add_custom_background( 'themezee_custom_background_callback' );

// Add Custom Background Fix
function themezee_custom_background_callback() {
 
    /* Get the background image. */
    $image = get_background_image();
	
    /* If there's an image, just call the normal WordPress callback. We won't do anything here. */
    if ( !empty( $image ) ) {
        _custom_background_cb();
        return;
    }
	
    /* Get the background color. */
    $color = get_background_color();
 
    /* If no background color, return. */
    if ( empty( $color ) )
        return;
 
    /* Use 'background' instead of 'background-color'. */
    $style = "background: #{$color};";
?>
<style type="text/css">body { <?php echo trim( $style ); ?> }</style>
<?php
}

// Add Custom Header
define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', get_stylesheet_directory_uri() . '/images/default_header.jpg');
define('HEADER_IMAGE_WIDTH', 950);
define('HEADER_IMAGE_HEIGHT', 140);
define('NO_HEADER_TEXT', true );

function header_style() {
    ?><style type="text/css">
	   #custom_header img {
			margin: 0;
			width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        }
    </style><?php
}
function admin_header_style() {
    ?><style type="text/css">
        #headimg {
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        }
    </style><?php
}
add_custom_image_header('header_style', 'admin_header_style');

// Register Sidebars
register_sidebar(array('name' => 'Sidebar Blog','id' => 'sidebar-blog'));
register_sidebar(array('name' => 'Sidebar Pages','id' => 'sidebar-pages'));

// Register Menus
register_nav_menu( 'navi', 'Navigation' );

// include Plugin Files
locate_template('/includes/plugins/theme_socialmedia_widget.php', true);
locate_template('/includes/plugins/theme_ads_widget.php', true);

// Functions for correct html5 Validation
function themezee_html5_gallery($content)
{
	return str_replace('[gallery', '[gallery itemtag="div" icontag="span" captiontag="p"', $content);
}
add_filter('the_content', 'themezee_html5_gallery');
add_filter('gallery_style', create_function('$a', 'return preg_replace("%<style type=\'text/css\'>(.*?)</style>%s", "", $a);'));

?>
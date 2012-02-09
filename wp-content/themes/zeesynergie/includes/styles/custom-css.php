<?php 
add_action('wp_head', 'themezee_include_custom_css');
function themezee_include_custom_css() {
	
	echo '<style type="text/css">';
	$options = get_option('themezee_options');
	if ( $options['themeZee_stylesheet'] == "custom-color" ) {
		echo '
			a, a:link, a:visited,
			.post h2, .type-page h2, .post h2 a:link, .post h2 a:visited, .arh,
			#sidebar a:link, #sidebar a:visited,
			#comments h3, #respond h3, .comment-reply-link
			{
				color: #'.esc_attr($options['themeZee_color']).';
			}
			#sidebar ul li h2 {
				background-color: #'.esc_attr($options['themeZee_color']).';
			}
			#header, #slide_panel, .postcomments, #footer {
				background-color: #'.esc_attr($options['themeZee_color']).';
			}
		';
		}
	if ( $options['themeZee_custom_css'] <> "" ) { echo esc_attr($options['themeZee_custom_css']); }
	echo '</style>';
}

<?php
/**
 * Theme functions and definitions.
 *
 * @package Afpa
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

/**
 * Text domain definition
 */
defined( 'THEME_TD' ) ? THEME_TD : define( 'THEME_TD', 'afpa' );

// Load modules
$theme_includes = [
	'/lib/helpers.php',
	'/lib/cleanup.php',                        // Clean up default theme includes
	'/lib/enqueue-scripts.php',                // Enqueue styles and scripts
	'/lib/protocol-relative-theme-assets.php', // Protocol (http/https) relative assets path
	'/lib/framework.php',                      // Css framework related stuff (content width, nav walker class, comments, pagination, etc.)
	'/lib/theme-support.php',                  // Theme support options
	'/lib/template-tags.php',                  // Custom template tags
	'/lib/menu-areas.php',                     // Menu areas
	'/lib/widget-areas.php',                   // Widget areas
	'/lib/customizer.php',                     // Theme customizer
	'/lib/vc_shortcodes.php',                  // Visual Composer shortcodes
	'/lib/jetpack.php',                        // Jetpack compatibility file
	'/lib/acf_field_groups_type.php',          // ACF Field Groups Organizer
	'/lib/acf_blocks_loader.php',              // ACF Blocks Loader
	'/lib/wp_dashboard_customizer.php',        // WP Dashboard customizer
	'/lib/gravityforms-filter.php',        	   // GF plugin filter for simple select forms
];

foreach ( $theme_includes as $file ) {
	if ( ! locate_template( $file ) ) {
		/* translators: %s error*/
		trigger_error( esc_html( sprintf( esc_html( __('Error locating %s for inclusion', 'afpa') ), $file ) ), E_USER_ERROR ); // phpcs:ignore
		continue;
	}
	require_once locate_template( $file );
}
unset( $file, $filepath );


/**
 * wp_has_sidebar Add body class for active sidebar
 *
 * @param array $classes - classes
 * @return array
 */
function wp_has_sidebar( $classes ) {
	if ( is_active_sidebar( 'sidebar' ) ) {
		// add 'class-name' to the $classes array
		$classes[] = 'has_sidebar';
	}
	return $classes;
}

add_filter( 'body_class', 'wp_has_sidebar' );

// Remove the version number of WP
// Warning - this info is also available in the readme.html file in your root directory - delete this file!
remove_action( 'wp_head', 'wp_generator' );


/**
 * Obscure login screen error messages
 *
 * @return string
 */
function wp_login_obscure() {
	return sprintf(
		'<strong>%1$s</strong>: %2$s',
		__( 'Error' ),
		__( 'wrong username or password' )
	);
}

add_filter( 'login_errors', 'wp_login_obscure' );

/**
 * Require Authentication for All WP REST API Requests
 *
 * @param WP_Error|null|true $result WP_Error if authentication error, null if authentication method wasn't used, true if authentication succeeded.
 * @return WP_Error
 */
function rest_authentication_require( $result ) {
	if ( true === $result || is_wp_error( $result ) ) {
		return $result;
	}

	if ( ! is_user_logged_in() ) {
		return new WP_Error(
			'rest_not_logged_in',
			__( 'You are not currently logged in.' ),
			array( 'status' => 401 )
		);
	}

	return $result;
}

add_filter( 'rest_authentication_errors', 'rest_authentication_require' );


// Disable the theme / plugin text editor in Admin
define( 'DISALLOW_FILE_EDIT', true );

/**
 * Add Options page
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}

add_image_size( 'intro', 682, 682, true );
add_image_size( 'multiple-info', 960, 913, true );
add_image_size( 'news-img', 28, 21, true );
add_image_size( 'news', 794, 596, true );
add_image_size( 'news-single', 9999, 824);
add_image_size( 'environment', 825, 825, true );
add_image_size( 'afpa', 824, 9999 );
add_image_size( 'afpa-col', 1200, 1096, true );
add_image_size( 'afpa-col-bg', 150, 137, true );
add_image_size( 'afpa-col-mob', 700, 700, true );
add_image_size( 'afpa-wide', 1326, 811, true );
add_image_size( 'afpa-wide-bg', 132, 81, true );
add_image_size( 'staff', 398, 530, true );

/**
 * Custom excerpt
 */
function afpa_excerpt( $limit = 30, $text = 'Read more' ) {
	global $post;
	$the_excerpt = $post->post_content;
	$the_excerpt = trim( strip_tags( strip_shortcodes( $the_excerpt ) ) );
	$words       = explode( ' ', $the_excerpt, $limit + 1 );
	if ( count( $words ) > $limit ) :
		array_pop( $words );
		$the_excerpt = implode( ' ', $words ) . ' ...';
	endif;

	echo $the_excerpt;
}

/**
 * Gform submit button
 */
add_filter( 'gform_submit_button', 'om_form_submit_button', 10, 2 );
function om_form_submit_button( $button, $form ) {
	$button_text = !empty($form['buttonText']) ? $form['buttonText'] : 'submit';

	ob_start();
	get_template_part('template-parts/arrow-hover');
	$arrow = ob_get_contents();
	ob_end_clean();
	return "<button class='btn-fill-yellow gform_button' id='gform_submit_button_{$form['id']}'><span>{$button_text}</span>{$arrow}</button>";
}

add_action('admin_head', 'gavickpro_add_my_tc_button');

function gavickpro_add_tinymce_plugin($plugin_array) {
	$plugin_array['yellow_button'] = get_template_directory_uri().'/assets/scripts/custom-tinymce-button.js';
	return $plugin_array;
}


function yellow_button($buttons) {
	array_unshift($buttons, "yellow_button");
	return $buttons;
}

function gavickpro_add_my_tc_button() {
	global $typenow;
	// check user permissions
	if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
		return;
	}
	// verify the post type
	if( ! in_array( $typenow, array( 'post', 'page' ) ) )
			return;
	// check if WYSIWYG is enabled
	if ( get_user_option('rich_editing') == 'true') {
			add_filter("mce_external_plugins", "gavickpro_add_tinymce_plugin");
			add_filter("mce_buttons_2", "yellow_button");
	}
}

add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{
	// Add a new toolbar called "Very Simple"
	array_push($toolbars['Full' ][2], 'yellow_button');
	// return $toolbars - IMPORTANT!
	return $toolbars;
}

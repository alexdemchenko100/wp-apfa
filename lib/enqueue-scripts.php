<?php
/**
 * Enqueue all styles and scripts.
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style}
 *
 * @package Afpa
 */

if ( ! function_exists( 'afpa_scripts' ) ) :
	/**
	 * afpa_scripts
	 *
	 * @return void
	 */
	function afpa_scripts() {
		// Enqueue the main Stylesheet.
		wp_enqueue_style( 'main-stylesheet', asset_path( 'styles/main.css' ), false, '1.0.0', 'all' );

		// Deregister the jquery version bundled with WordPress.
		wp_deregister_script( 'jquery' );

		// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
		wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', [], '2.2.4', false );

		// Fancybox
		wp_enqueue_script('fancybox_js', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', false, null);
		wp_enqueue_style('fancybox', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');

		// Enqueue add-to-any share buttons.
		wp_enqueue_script( 'add-share', '//static.addtoany.com/menu/page.js', array(), null, false );

		// Enqueue the main JS file.
		wp_enqueue_script( 'main-javascript', asset_path( 'scripts/main.js' ), [ 'jquery' ], '1.0.0', true );

		// Throw variables from back to front end.
		$theme_vars = array(
			'home'   => get_home_url(),
			'isHome' => is_front_page(),
		);
		wp_localize_script( 'main-javascript', 'themeVars', $theme_vars );

		// Comments reply script
		if ( is_singular() && comments_open() ) :
			wp_enqueue_script( 'comment-reply' );
		endif;
	}

	add_action( 'wp_enqueue_scripts', 'afpa_scripts' );
endif;

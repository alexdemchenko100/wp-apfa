<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * @package Afpa
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<section id="main" class="site-main" role="main">

			<section class="not-found">
				<?php if ( function_exists('yoast_breadcrumb') ) :
					yoast_breadcrumb( '<div class="page-breadcrumbs" ><p id="breadcrumbs">','</p></div>' );
				endif; ?>
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( '404: Page Not Found', 'afpa' ); ?></h1>
				</header>

				<a class="btn-fill-yellow" href="<?php echo esc_url( home_url() ); ?>"
				   target="_self">
					<span><?php esc_html_e( 'Back to home', 'afpa' ); ?></span>
					<?php get_template_part( 'template-parts/arrow-hover' ); ?>
				</a>
				<div class="afpa-bg"></div>
			</section>

		</section>
	</div>

<?php
get_footer();

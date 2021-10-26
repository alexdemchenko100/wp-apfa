<?php
/**
 * Page template file
 *
 * @package Afpa
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<section id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>

		</section><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

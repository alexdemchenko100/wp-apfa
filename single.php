<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package Afpa
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<section id="main" class="site-main" role="main">
			<?php
			$archive_title = get_the_title( get_option('page_for_posts', true) );

			get_template_part(
				'template-parts/block/industry-hero/block',
				'',
				array(
					'text'             => $archive_title,
					'add_breadcrumbs'  => true,
				)
			);
			?>

			<?php
			while ( have_posts() ) : the_post();

				if (is_singular('post')) :

					get_template_part( 'template-parts/content', 'post' );

				else :

					get_template_part( 'template-parts/content', get_post_format() );

				endif;

			endwhile;
			?>

			<?php
			get_template_part('template-parts/block/afpa-info/block', '');
			get_template_part(
				'template-parts/block/cta/block',
				'',
				array(
					'use_options'  => 'true',
				)
			);
			?>

		</section>
	</div>

<?php
get_footer();

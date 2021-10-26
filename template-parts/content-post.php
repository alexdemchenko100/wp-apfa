<?php
/**
 * Template part for displaying post content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Afpa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-container">
		<div class="post-header">
			<div class="post-header__container">
				<div class="post-header__top">
					<h1 class="h3">
						<?php echo get_the_title(); ?>
					</h1>
					<div class="post-header__info">
						<?php
						$author = get_the_author_meta( 'nickname' );
						$date   = get_the_date();
						printf( '<h5>' . esc_html__( 'Posted by %1$s | %2$s', 'afpa' ) . '</h5>', $author, $date );
						?>
						<?php get_template_part('template-parts/share-buttons'); ?>
					</div>
				</div>

				<?php
				if ( has_post_thumbnail() ) : ?>
					<div class="post-thumb">
						<?php echo get_the_post_thumbnail( get_the_ID(), 'news-single' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="post-main">
			<?php the_content(); ?>
		</div>
		<?php get_template_part( 'template-parts/related-posts'); ?>
	</div>
</article>

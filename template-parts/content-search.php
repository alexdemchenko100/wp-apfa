<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Afpa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article-search'); ?>>
	<div class="post-content__top">
		<h4>
			<a href="<?php echo get_permalink(); ?>" class="post-content__title">
				<?php echo get_the_title(); ?>
			</a>
		</h4>
		<?php
		$author = get_the_author_meta( 'nickname' );
		$date   = get_the_date();
		printf( '<h5>' . esc_html__( 'Posted by %1$s | %2$s', 'afpa' ) . '</h5>', $author, $date );
		?>
		<?php
		if ( has_excerpt() ) :
			?>
			<div class="post-excerpt"><?php the_excerpt(); ?></div>
		<?php else : ?>
			<div class="post-excerpt"><p><?php afpa_excerpt( 70 ); ?></p></div>
		<?php endif; ?>
	</div>
	<a class="btn-outline" href="<?php echo get_permalink(); ?>"
			target="_self">
		<span><?php esc_html_e( 'Read More', 'afpa' ); ?></span>
		<?php get_template_part( 'template-parts/arrow-hover' ); ?>
	</a>
</article><!-- #post-## -->


<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Afpa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article-search'); ?>>
	<a href="<?php echo get_permalink(); ?>" class="search-block">
		<h3 class="search-block__title"><?php the_title(); ?></h3>
		<div class="search-block__arrow">
			<?php get_template_part( 'template-parts/arrow-left' ); ?>
		</div>
	</a>
</article><!-- #post-## -->


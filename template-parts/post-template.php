<?php
/**
 * The template for displaying post item.
 *
 * @package Afpa
 */

$post_class = '';
if ( ! empty( $args ) ) {
	$post_class = $args['class'];
}

?>

<div  class="post-block <?php echo $post_class; ?>">
	<div class="post-wrap">
		<?php
			$post_img    = get_the_post_thumbnail_url( get_the_ID(), 'news' );
			$default_img = get_field( 'default_post_thumb', 'option' );
			$default_url = is_array($default_img) ? wp_get_attachment_image_url( $default_img['id'], 'news' ) : '';
			$post_url    = has_post_thumbnail() ? $post_img : $default_url;
			$post_bg     = 'style="background-image: url(' . $post_url . ')"';
			?>
			<a href="<?php echo get_permalink(); ?>" class="post-image" <?php echo $post_bg; ?>>
				<?php echo get_the_post_thumbnail( get_the_ID(), 'news-img' ); ?>
			</a>
		<div class="post-content">
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
					<div class="post-excerpt"><p><?php afpa_excerpt( 20 ); ?></p></div>
				<?php endif; ?>
			</div>
			<a class="btn-outline" href="<?php echo get_permalink(); ?>"
			   target="_self">
				<span><?php esc_html_e( 'Read More', 'afpa' ); ?></span>
				<?php get_template_part( 'template-parts/arrow-hover' ); ?>
			</a>
		</div>
	</div>
</div>

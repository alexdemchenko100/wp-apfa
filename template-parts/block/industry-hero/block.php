<?php
/**
 * Block Name: Hero Industry
 * Description: Hero Industry banner block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: hero industry acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package Afpa
 *
 * @var array $block
 */

if( isset( $block['data']['preview_image_help'] )  ) :
	echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
endif;

global $post;
$slug         = ( ! empty( $block ) && is_array( $block ) ) ? str_replace( 'acf/', '', $block['name'] ) : 'industry-hero';
$block_id     = ( ! empty( $block ) && is_array( $block ) ) ? $slug . '-' . $block['id'] : '';
$align_class  = ( ! empty( $block ) && is_array( $block ) ) ? $block['align'] : '';
$custom_class = isset( $block['className'] ) ? $block['className'] : '';

if ( ! empty( $args ) ) {
	$text       	  = $args['text'];
	$add_breadcrumbs  = $args['add_breadcrumbs'];
} else {
	$text       	  = get_field( 'text' );
	$add_breadcrumbs  = get_field( 'add_breadcrumbs' );
}

$breadcrumb_class = (is_page() && $post->post_parent) ? 'child' : 'index';
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">

	<div class="<?php echo $slug; ?>__container" >
		<?php if ( function_exists('yoast_breadcrumb') && $add_breadcrumbs ) :
			yoast_breadcrumb( '<div data-aos="fade-up" data-aos-duration="500" data-aos-delay="300" data-aos-easing="ease-out" class="page-breadcrumbs ' . $breadcrumb_class .'" ><p id="breadcrumbs">','</p></div>' );
		endif; ?>
		<?php if ( $text ) :
			$trim_title = trim( strip_tags( strip_shortcodes( $text ) ) );
			$limit = 50;
			$words       = explode( ' ', $trim_title, $limit + 1 );
			if ( count( $words ) > $limit ) :
				array_pop( $words );
				$text = implode( ' ', $words ) . ' ...';
			endif; ?>
			<h2 data-aos="fade-up" data-aos-duration="500" data-aos-delay="300" data-aos-easing="ease-out">
				<?php echo $text; ?>
			</h2>
		<?php endif; ?>

		<div class="hero__scroll">
			<a class="js-scroll-down" href="#">
				<?php get_template_part( 'template-parts/scroll-down' ); ?>
			</a>
		</div>
	</div>
</section>

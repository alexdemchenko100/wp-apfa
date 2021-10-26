<?php
/**
 * Block Name: Hero
 * Description: Hero banner block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: hero acf block
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
$children 		  = get_pages( array( 'child_of' => $post->ID ) );
$slug             = str_replace( 'acf/', '', $block['name'] );
$block_id         = $slug . '-' . $block['id'];
$align_class      = $block['align'] ? 'align' . $block['align'] : '';
$custom_class     = isset( $block['className'] ) ? $block['className'] : '';
$background       = get_field( 'background' );
$bg_image         = get_field( 'bg_img' );
$background_video = get_field( 'background_video' );
$bg_video_url     = is_array($background_video) ? $background_video['url'] : '';
$block_title      = get_field( 'title' );
$heading_class    = !is_front_page() ? 'h2' : 'main';
$add_breadcrumbs  = get_field( 'add_breadcrumbs' );
$breadcrumb_class = (is_page() && $post->post_parent) ? 'child' : 'index';
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">
	<?php if ( ( $bg_image && is_array( $bg_image )) && $background === "image" ) : ?>
		<div class="hero-bg"
			 style="background-image: url(<?php echo wp_get_attachment_image_url( $bg_image['ID'], 'full' ); ?>)"></div>
	<?php elseif ( $bg_video_url && ( $background === 'video' ) ): ?>
		<div class="hero-video-bg">
			<div class="video-container">
				<video class="" loading="lazy" aria-hidden="true" playsinline="playsinline"
					   autoplay="autoplay" muted="muted"
					   loop="loop">
					<source src="<?php echo $bg_video_url; ?>"
							type="video/mp4">
				</video>
			</div>
		</div>
	<?php endif; ?>
	<div class="hero__container">
		<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() && $add_breadcrumbs ) :
			yoast_breadcrumb( '<div class="page-breadcrumbs ' . $breadcrumb_class .'" ><p id="breadcrumbs">','</p></div>' );
		endif; ?>
		<?php if ( $block_title ) :
			$trim_title = trim( strip_tags( strip_shortcodes( $block_title ) ) );
			$limit = 50;
			$words       = explode( ' ', $trim_title, $limit + 1 );
			if ( count( $words ) > $limit ) :
				array_pop( $words );
				$block_title = implode( ' ', $words ) . ' ...';
			endif; ?>
			<h1 data-aos="fade-up" data-aos-duration="500" data-aos-delay="300" data-aos-easing="ease-out" class="<?php echo $heading_class; ?>">
				<?php echo $block_title; ?>
			</h1>
		<?php endif; ?>

		<div class="hero__scroll">
			<a class="js-scroll-down" href="#">
				<?php get_template_part( 'template-parts/scroll-down' ); ?>
			</a>
		</div>
	</div>
</section>

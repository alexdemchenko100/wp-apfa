<?php
/**
 * Block Name: Environment
 * Description: Environment block managed with ACF.
 * Category: common
 * Icon: welcome-widgets-menus
 * Keywords: environment acf block
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
$children 			= get_pages( array( 'child_of' => $post->ID ) );
$slug           	= str_replace( 'acf/', '', $block['name'] );
$block_id       	= $slug . '-' . $block['id'];
$align_class    	= $block['align'] ? 'align' . $block['align'] : '';
$custom_class   	= isset( $block['className'] ) ? $block['className'] : '';
$main_image     	= get_field( 'main_image' );
$main_title       	= get_field( 'main_title' );
$read_more_link  	= get_field( 'read_more_link' );
$interior_image  	= get_field( 'interior_image' );
$interior_title  	= get_field( 'interior_title' );
$interior_subtitle	= get_field( 'interior_subtitle' );
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">

	<div class="section-parallax">
		<div class="<?php echo $slug; ?>__top parallax-content" style="background-image: url(<?php echo $main_image['url'] ?>) ">
			<?php if ( $main_title ) : ?>
				<h2>
					<?php echo $main_title; ?>
				</h2>
			<?php endif; ?>

			<?php if ($read_more_link):
				$read_more_link_target = $read_more_link['target'] ?: '_self'; ?>
				<a class="btn-arrow btn-fill-yellow" href="<?php echo $read_more_link['url'] ?>"
				   target="<?php echo esc_attr($read_more_link_target); ?>">
					<span><?php echo $read_more_link['title']; ?></span>
					<?php get_template_part( 'template-parts/arrow-hover' ); ?></a>
			<?php endif; ?>
		</div>
	</div>

	<div class="<?php echo $slug; ?>__block">
		<div class="<?php echo $slug; ?>__container">
			<div class="<?php echo $slug; ?>-bottom">
				<?php if ( $interior_image ) : ?>
					<div class="section-top">
						<div class="<?php echo $slug; ?>-bottom__image gsap-top">
							<img src="<?php echo $interior_image['sizes']['environment']  ?>" alt="">
						</div>
					</div>
				<?php endif; ?>

				<div class="<?php echo $slug; ?>-bottom__content">
					<?php if ( $interior_title ) : ?>
						<p class="<?php echo $slug; ?>-bottom__title"><?php echo $interior_title; ?></p>
					<?php endif; ?>

					<?php if ( $interior_subtitle ) : ?>
						<p class="<?php echo $slug; ?>-bottom__subtitle"><?php echo $interior_subtitle; ?></p>
					<?php endif; ?>

					<?php if ($read_more_link):
						$read_more_link_target = $read_more_link['target'] ?: '_self'; ?>
						<a class="btn-arrow btn-outline <?php echo $slug; ?>-bottom__link" href="<?php echo $read_more_link['url'] ?>"
						   target="<?php echo esc_attr($read_more_link_target); ?>">
							<span><?php echo $read_more_link['title']; ?></span>
							<?php get_template_part( 'template-parts/arrow-hover' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="environment__bg"></div>
	</div>
</section>

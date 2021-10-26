<?php
/**
 * Block Name: AFPA Block with images, content, slider
 * Description: AFPA.
 * Category: common
 * Icon: editor-unlink
 * Keywords: resources acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package Afpa
 *
 * @var array $block
 */

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
endif;

$slug             = str_replace( 'acf/', '', $block['name'] );
$block_id         = $slug . '-' . $block['id'];
$align_class      = $block['align'] ? 'align' . $block['align'] : '';
$custom_class     = isset( $block['className'] ) ? $block['className'] : '';
$top_group        = get_field( 'top' );
$top_title        = is_array($top_group) ? $top_group['title'] : '';
$top_info         = is_array($top_group) ? $top_group['info'] : '';
$top_img          = is_array($top_group) ? $top_group['image'] : '';
$main_group       = get_field( 'main' );
$main_img         = is_array($main_group) ? $main_group['image'] : '';
$main_info        = is_array($main_group) ? $main_group['info'] : '';
$slider_group     = get_field( 'slider' );
$slides           = is_array($slider_group) ? $slider_group['slides'] : '';
$bottom_group     = get_field( 'bottom' );
$bottom_top_info  = is_array($bottom_group) ? $bottom_group['top_info'] : '';
$bottom_info      = is_array($bottom_group) ? $bottom_group['info'] : '';
$bottom_img       = is_array($bottom_group) ? $bottom_group['image'] : '';
$bottom_link      = is_array($bottom_group) ? $bottom_group['link'] : '';
?>
<section id="<?php echo $block_id; ?>" class="<?php echo $slug; ?>">
	<?php if ( $top_title || $top_info || ( $top_img && is_array( $top_img ) ) ) : ?>
		<div class="afpa-top two-col">
			<?php if ( $top_title || $top_info ) : ?>
				<div class="two-col__content">
					<div class="two-col__wrap">
						<?php if ( $top_title ) : ?>
							<h5 class="two-col__title">
								<?php echo $top_title; ?></h5>
						<?php endif; ?>
						<?php if ( $top_info ) : ?>
							<h3 class="two-col__info"><?php echo $top_info; ?></h3>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( $top_img && is_array( $top_img ) ) :
				$top_sm      = wp_get_attachment_image_url($top_img['ID'], 'afpa-col-mob');
				$top_lg      = wp_get_attachment_image_url($top_img['ID'], 'afpa-col-bg');
				$top_lg_full = wp_get_attachment_image_url($top_img['ID'], 'full');
				?>
			<div class="afpa-top__img" style="background-image: url(<?php echo $top_lg_full; ?>)">
				<img width="1200" height="1096" src="<?php echo $top_lg; ?>"
					 class="attachment-afpa size-afpa" alt="<?php echo $top_img['alt']; ?>" loading="lazy"
					 srcset="<?php echo $top_lg; ?>,
					 <?php echo $top_sm; ?> 768w">
			</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="afpa-main">
		<?php if ( $main_info || ( $main_img && is_array( $main_img ) ) ) : ?>
			<div class="afpa-main__top">
				<?php if ( $main_img && is_array( $main_img ) ) : ?>
					<div class="afpa-main__img">
						<div class="afpa-main__img-wrap" style="background-image: url(<?php echo wp_get_attachment_image_url($main_img['ID'], 'full'); ?>)">
							<?php echo wp_get_attachment_image($main_img['ID'], 'afpa-wide'); ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( $main_info ) : ?>
					<div class="afpa-main__text">
						<p><?php echo $main_info; ?></p>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="afpa-main__content">
			<?php if ( $slides && is_array( $slides ) ) : ?>
				<div class="afpa-slider">
					<div class="swiper-container swiper-container_main">
						<div class="swiper-wrapper">
							<?php foreach ( $slides as $slide ) : ?>
								<?php
								$slide_img = is_array($slide) ? $slide['image'] : '';
								$bg        = ( ! empty( $slide_img ) && is_array( $slide_img ) ) ? 'style="background-image: url(' . $slide_img['url'] . ')"' : '';
								?>
								<?php if ($bg ) : ?>
									<div class="swiper-slide afpa-slide" <?php echo $bg; ?>></div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
			<?php endif; ?>
			<?php if ( $bottom_top_info ) : ?>
				<div class="afpa__container">
					<p><?php echo $bottom_top_info; ?></p>
				</div>
			<?php endif; ?>
		</div>
		<div class="afpa-main-bg"></div>
	</div>

	<?php if ( $bottom_info || ( $bottom_link && is_array( $bottom_link ) ) || ( $bottom_img && is_array( $bottom_img ) ) ) : ?>
		<div class="afpa-bottom">
			<?php if ( $bottom_img && is_array( $bottom_img ) ) : ?>
				<div class="afpa-bottom__img">
					<?php echo wp_get_attachment_image($bottom_img['ID'], 'full'); ?>
				</div>
			<?php endif; ?>
			<?php if ( $bottom_info || ( $bottom_link && is_array( $bottom_link ) ) ) : ?>
				<div class="afpa__container">
					<?php if ( $bottom_info ) : ?>
						<p><?php echo $bottom_info; ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $bottom_link ) && is_array( $bottom_link ) ) :
						$link_target = $bottom_link['target'] ? $bottom_link['target'] : '_self'; ?>
						<a class="btn-fill-yellow" href="<?php echo $bottom_link['url']; ?>"
						   target="<?php echo $link_target; ?>">
							<span><?php echo $bottom_link['title']; ?></span>
							<?php get_template_part( 'template-parts/arrow-hover' ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="afpa-bottom-bg"></div>
		</div>
	<?php endif; ?>
</section>

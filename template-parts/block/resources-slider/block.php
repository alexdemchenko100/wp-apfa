<?php
/**
 * Block Name: Resources Slider
 * Description: Slider Block.
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
$use_options      = get_field('use_options');
$resources_slides = $use_options ? get_field('resources_slides', 'option') : get_field('resources_slides');

?>
<section id="<?php echo $block_id; ?>" class="<?php echo $slug; ?> resources">
    <div class="resources-container">
		<?php if ( $resources_slides ) : ?>
			<div class="swiper-container swiper-container_resources">
				<div class="swiper-wrapper">
					<?php foreach ( $resources_slides as $links_item ) : ?>
					<?php
						$title      = is_array($links_item) ? $links_item['title'] : '';
						$text       = is_array($links_item) ? $links_item['text'] : '';
						$item_class = $text ? 'between' : 'center';
						$link       = is_array($links_item) ? $links_item['link'] : '';
						$image      = is_array($links_item) ? $links_item['image'] : '';
						$bg         = ( ! empty( $image ) && is_array( $image ) ) ? 'style="background-image: url(' . $image['url'] . ')"' : '';
						?>
						<?php if( $title || $text || ( $link && is_array( $link ) ) || ( $image && is_array( $image ) ) ): ?>
							<div class="swiper-slide resources-slide <?php echo $item_class; ?>">
								<div class="resources-slide__bg" <?php echo $bg; ?>></div>
							<div class="resources-slide__content">
								<?php if ( $title ) : ?>
									<h4 class="resources-subtitle"><?php echo $links_item['title'] ?></h4>
								<?php endif; ?>

								<?php if ( $text ) : ?>
									<p class="resources-text"><?php echo $links_item['text'] ?></p>
								<?php endif; ?>
							</div>
							<?php if ( ! empty( $link ) && is_array( $link ) ) :
								$link_target = $link['target'] ?: '_self'; ?>
									<a class="btn-arrow btn-fill-yellow" href="<?php echo $link['url']; ?>"
									   target="<?php echo esc_attr( $link_target ); ?>">
										<span>
											<?php echo $link['title']; ?>
										</span>
										<?php get_template_part( 'template-parts/arrow-hover' ); ?>
									</a>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
		<?php endif; ?>
    </div>
</section>

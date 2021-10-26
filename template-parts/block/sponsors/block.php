<?php
/**
 * Block Name: Sponsors
 * Description: Sponsors Section.
 * Category: common
 * Icon: format-image
 * Keywords: sponsors acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package Afpa
 *
 * @var array $block
 */

if (isset($block['data']['preview_image_help'])) :
	echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
endif;

$slug         = str_replace('acf/', '', $block['name']);
$block_id     = $slug . '-' . $block['id'];
$align_class  = $block['align'] ? 'align' . $block['align'] : '';
$custom_class = isset($block['className']) ? $block['className'] : '';
$sponsors	  = get_field('sponsors');
?>

<section id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">
	<div class="<?php echo $slug; ?>__block">

		<?php if ( $sponsors ) { ?>
			<div class="sponsor-item">
				<?php foreach ( $sponsors as $item ) {
					?>
					<?php if ( $item['title'] ) : ?>
						<h4 class="sponsor-item__title"><?php echo $item['title']; ?> </h4>
					<?php endif; ?>
					<?php if ( $item['sponsors'] ) { ?>
						<div class="sponsor-subitem">
							<div class="swiper-container">
								<div class="swiper-wrapper">
							<?php foreach ( $item['sponsors'] as $slider ) {
								?>
								<?php if ( $slider['logo'] && $slider['url'] ) : ?>
									<a href="<?php echo $slider['url'] ?>" target="_blank" class="swiper-slide">
										<img src="<?php echo $slider['logo']['url'] ?>" alt="">
									</a>
								<?php endif; ?>

								<?php
							} ?>
								</div>

								<?php if (count($item['sponsors'] ) > 1 ) {
									?> <div class="swiper-button-prev"></div>
									<div class="swiper-button-next"></div>  <?php
								}?>
							</div>
						</div> <?php
					}
					?>
					<?php
				} ?>
			</div> <?php
		}
		?>
	</div>

	<div class="<?php echo $slug; ?>__bg"></div>
</section>

<?php
/**
 * Block Name: AFPA Info
 * Description: AFPA Info banner block managed with ACF.
 * Category: common
 * Icon: align-left
 * Keywords: afpa info acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package Afpa
 *
 * @var array $block
 */

if( isset( $block['data']['preview_image_help'] )  ) :
	echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
endif;

$slug         = ( ! empty( $block ) && is_array( $block ) ) ? str_replace( 'acf/', '', $block['name'] ) : 'afpa-info';
$block_id     = ( ! empty( $block ) && is_array( $block ) ) ? $slug . '-' . $block['id'] : '';
$align_class  = ( ! empty( $block ) && is_array( $block ) ) ? $block['align'] : '';
$custom_class = isset( $block['className'] ) ? $block['className'] : '';
$title        = get_field( 'info_title', 'options' );
$text         = get_field( 'info_text', 'options' );
$link         = get_field( 'info_link', 'options' );
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">

	<div class="<?php echo $slug; ?>__container" data-aos="fade-up" data-aos-duration="500" data-aos-delay="300" data-aos-easing="ease-out">
		<?php if ( $title ) : ?>
			<h5>
				<?php echo $title; ?>
			</h5>
		<?php endif; ?>

		<?php if ( $text ) : ?>
			<h3>
				<?php echo $text; ?>
			</h3>
		<?php endif; ?>

		<?php if ($link):
			$link_target = $link['target'] ?: '_self'; ?>
			<a class="btn-arrow btn-fill-yellow" href="<?php echo $link['url'] ?>"
			   target="<?php echo esc_attr($link_target); ?>">
				<span><?php echo $link['title']; ?></span>
				<?php get_template_part( 'template-parts/arrow-hover' ); ?></a>
		<?php endif; ?>
	</div>
</section>

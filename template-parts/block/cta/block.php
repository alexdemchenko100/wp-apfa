<?php
/**
 * Block Name: CTA
 * Description: CTA Section.
 * Category: common
 * Icon: format-image
 * Keywords: hero acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package Afpa
 *
 * @var array $block
 */

if (isset($block['data']['preview_image_help'])) :
	echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
endif;

$slug         = ( ! empty( $block ) && is_array( $block ) ) ? str_replace( 'acf/', '', $block['name'] ) : 'cta';
$block_id     = ( ! empty( $block ) && is_array( $block ) ) ? $slug . '-' . $block['id'] : '';
$align_class  = ( ! empty( $block ) && is_array( $block ) ) ? $block['align'] : '';
$custom_class = isset( $block['className'] ) ? $block['className'] : '';

if ( ! empty( $args ) ) {
	$use_options = $args['use_options'];
} else {
	$use_options = get_field('use_options');
}

$select_view  = !$use_options ? get_field('select_view') : 'col';
$ctas         = $use_options ? get_field('ctas', 'option') : get_field('ctas');


if ( is_admin() && $use_options ) :
	echo '<p>';
	_e( 'The fields for this block can be edited in the theme options CTA tab: Admin panel -> Option -> CTA' );
	echo '</p>';
	return;
endif;
?>

<?php if ( !empty( $ctas ) && is_array( $ctas ) ) : ?>
	<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">
		<div class="cta__rows <?php echo $select_view; ?>">
			<?php foreach ( $ctas as $cta ) : ?>
				<?php
				$icon        = is_array($cta) ? $cta['icon'] : '';
				$tag         = is_array($cta) ? $cta['tag'] : '';
				$info        = is_array($cta) ? $cta['info'] : '';
				$sub_info    = is_array($cta) ? $cta['sub_info'] : '';
				$link        = is_array($cta) ? $cta['link'] : '';
				$add_bg      = is_array($cta) ? $cta['add_bg'] : '';
				$bg_class    = $add_bg ? 'bg' : '';
				$bg_img      = is_array($cta) ? $cta['bg_img'] : '';
				$bg_pos      = is_array($cta) ? $cta['bg_position'] : '';
				$bg_pos_item = !empty($bg_pos) ? $bg_pos : '50% 50%';
				$bg_url      = ( ! empty( $bg_img ) && is_array( $bg_img ) ) ? $bg_img['url'] : '';
				?>
				<div class="cta-item <?php echo $bg_class; ?> <?php echo $select_view; ?>"  style="background-image: url(<?php echo $bg_url; ?>); background-position: <?php echo $bg_pos_item; ?>; ">
					<div class="cta-item__container <?php echo $select_view; ?>">
						<?php if ( $icon && is_array( $icon ) ) : ?>
							<?php echo wp_get_attachment_image($icon['ID'], 'full'); ?>
						<?php endif; ?>
						<?php if ( $tag ) : ?>
							<p class="tag"><?php echo $tag; ?></p>
						<?php endif; ?>
						<?php if ( $info ) : ?>
							<div class="cta-item__info"><?php echo $info; ?></div>
						<?php endif; ?>
						<?php if ( $sub_info ) : ?>
							<p class="sub <?php echo $select_view; ?>"><?php echo $sub_info; ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $link ) && is_array( $link ) ) :
							$link_target = $link['target'] ?: '_self'; ?>
							<a class="btn-arrow btn-fill-yellow" href="<?php echo $link['url']; ?>"
							   target="<?php echo esc_attr( $link_target ); ?>">
										<span><?php echo $link['title']; ?></span>
								<?php get_template_part( 'template-parts/arrow-hover' ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>
<?php endif; ?>

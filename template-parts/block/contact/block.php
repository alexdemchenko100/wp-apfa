<?php
/**
 * Block Name: Contact
 * Description: Contact Section with Map, Text and Form.
 * Category: common
 * Icon: email
 * Keywords: contact form
 * Supports: { "align":false, "anchor":true }
 *
 * @package Afpa
 *
 * @var array $block
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
endif;

$slug              = str_replace( 'acf/', '', $block['name'] );
$block_id          = $slug . '-' . $block['id'];
$align_class       = $block['align'] ? 'align' . $block['align'] : '';
$custom_class      = isset( $block['className'] ) ? $block['className'] : '';
$content           = get_field( 'content' );
$left_col          = is_array( $content ) ? $content['left_col'] : '';
$left_text         = is_array( $left_col ) ? $left_col['text'] : '';
$right_col		   = is_array( $content ) ? $content['right_col'] : '';
$info              = is_array( $right_col ) ? $right_col['text'] : '';
$map               = get_field( 'map_iframe' );
$form_id	  	   = get_field( 'choices' );
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">
	<div class="contact__container intro__container">
		<div class="contact-top intro-top bold">
			<?php if ( $left_text ): ?>
					<div class="intro-top__bold">
						<h4><?php echo $left_text; ?></h4>
					</div>
				<?php endif; ?>
			<?php if ( $info ) : ?>
					<div class="intro-top__content contact-content">
						<?php echo $info; ?>
					</div>
				<?php endif; ?>
		</div>
		<?php if ( $map ) : ?>
			<div class="contact-map">
				<?php echo $map; ?>
			</div>
		<?php endif; ?>
		<?php if ( $form_id ) : ?>
			<div class="contact-form">
				<?php echo do_shortcode('[gravityform id="' . $form_id . '" title="true" description="false" ajax="true"]'); ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
/**
 * Block Name: Agenda
 * Description: Agenda block managed with ACF.
 * Category: common
 * Icon: editor-kitchensink
 * Keywords: agenda acf block
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
$slug           	= str_replace( 'acf/', '', $block['name'] );
$block_id       	= $slug . '-' . $block['id'];
$align_class    	= $block['align'] ? 'align' . $block['align'] : '';
$custom_class   	= isset( $block['className'] ) ? $block['className'] : '';
$bg_before   		= get_field( 'change_bg_before_section' );
$change_bg_before   = $bg_before ? 'js-change js-change-bg-before' : '';
$bg_after   		= get_field( 'change_bg_before_section' );
$change_bg_after   	= $bg_after ? 'js-change js-change-bg-after' : '';
$image_position  	= get_field( 'image_position' );
$position  			= isset( $image_position ) ? $slug . '-' . $image_position : '';
$image  			= get_field( 'image' );
$title  			= get_field( 'title' );
$agenda				= get_field( 'agenda' );
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?> <?php echo $change_bg_before; ?>
 <?php echo $change_bg_after; ?>">
	<div class="<?php echo $slug; ?>__block">
		<div class="<?php echo $slug; ?>-top <?php echo $position ?>">
			<?php if ( $image ) : ?>
				<div class="<?php echo $slug; ?>-top__image">
					<img src="<?php echo $image['sizes']['multiple-info']  ?>" alt="">
				</div>
			<?php endif; ?>

			<div class="<?php echo $slug; ?>-top__content">
				<div class="<?php echo $slug; ?>-top__content-wrap">
					<?php if ( $title ) : ?>
						<div class="<?php echo $slug; ?>-top__title"><?php echo $title; ?></div>
					<?php endif; ?>

					<?php if ( $agenda ) { ?>
						<div class="agenda-block">
							<?php foreach ( $agenda as $item ) {
								?>
								<div class="agenda-item">
									<?php if ( $item['title'] || $item['info'] ) : ?>
										<div class="agenda-item__left">
											<?php if ( $item['title'] ) : ?>
												<h4 class="agenda-title"><?php echo $item['title']; ?> </h4>
											<?php endif; ?>

											<?php if ( $item['time'] ) : ?>
												<h5 class="agenda-item__time_mobile"><?php echo $item['time']; ?> </h5>
											<?php endif; ?>

											<?php if ( $item['info'] ) : ?>
												<div class="agenda-info"><?php echo $item['info']; ?> </div>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<?php if ( $item['time'] ) : ?>
										<h5 class="agenda-item__time"><?php echo $item['time']; ?> </h5>
									<?php endif; ?>
								</div>
								<?php
							} ?>
						</div> <?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>

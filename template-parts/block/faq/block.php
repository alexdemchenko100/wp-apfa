<?php
/**
 * Block Name: FAQ
 * Description: FAQ block managed with ACF.
 * Category: common
 * Icon: editor-kitchensink
 * Keywords: faq acf block
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
$bg_before   		= get_field( 'change_bg_before_section' );
$change_bg_before   = $bg_before ? 'js-change js-change-bg-before' : '';
$bg_after   		= get_field( 'change_bg_before_section' );
$change_bg_after   	= $bg_after ? 'js-change js-change-bg-after' : '';
$bg_color       	= get_field( 'bg_color' );
$bg      			= isset( $bg_color ) ? $bg_color : '';
$image_position  	= get_field( 'image_position' );
$position  			= isset( $image_position ) ? $slug . '-' . $image_position : '';
$image  			= get_field( 'image' );
$title  			= get_field( 'content_small_title' );
$questions			= get_field( 'questions' );
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?> <?php echo $change_bg_before; ?>
 <?php echo $change_bg_after; ?>  <?php echo 'section-bg-'.$bg; ?>">
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
					<h5 class="<?php echo $slug; ?>-top__title"><?php echo $title; ?></h5>
				<?php endif; ?>

					<?php if ( $questions ) { ?>
					<div class="faq-block">
						<?php foreach ( $questions as $item ) {
							?>
							<div class="faq-item">
								<?php if ( $item['question'] ) : ?>
									<div class="faq-item__shown"><h4 class="shown-title"><?php echo $item['question']; ?> </h4>
										<span class="shown-icon"><?php get_template_part( 'template-parts/faq' ); ?></span>
									</div>
								<?php endif; ?>
								<?php if ( $item['answer'] || $item['link'] ) : ?>
									<div class="faq-item__hidden">

										<?php if ( $item['answer'] ) : ?>
											<?php echo $item['answer']; ?>
										<?php endif; ?>

										<?php if ($item['link']):
											$link_target = $item['link']['target'] ?: '_self'; ?>
											<a class="btn-arrow btn-outline" href="<?php echo $item['link']['url'] ?>"
											   target="<?php echo esc_attr($link_target); ?>">
												<span><?php echo $item['link']['title']; ?></span>
												<?php get_template_part( 'template-parts/arrow-hover' ); ?></a>
										<?php endif; ?>
									</div>
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

<?php
/**
 * Block Name: Socials and Media
 * Description: Block with Social li.
 * Category: common
 * Icon: editor-kitchensink
 * Keywords: multiple info acf block
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
$bg_color           = get_field( 'bg_color' );
$left_col           = get_field( 'left_col' );
$left_col_tag       = is_array( $left_col ) ? $left_col['tag'] : '';
$left_col_text      = is_array( $left_col ) ? $left_col['text'] : '';
$left_col_links     = is_array( $left_col ) ? $left_col['links'] : '';
$right_col		    = get_field( 'right_col' );
$right_col_text		= is_array( $right_col ) ? $right_col['text'] : '';
$video_repeater		= get_field( 'video_repeater' );
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>
	<?php echo $change_bg_before; ?> <?php echo $change_bg_after; ?> sm">
	<div class="sm__container">
		<div class="sm__top">
			<?php if ( $left_col_tag || ( ! empty( $left_col_links ) && is_array( $left_col_links ) ) ) : ?>
				<div class="sm__tag">
					<?php if ( $left_col_tag ) : ?>
						<h5><?php echo $left_col_tag; ?></h5>
					<?php endif; ?>
					<?php if ( ! empty( $left_col_links ) && is_array( $left_col_links ) ) : ?>
						<div class="socials">
							<?php foreach ( $left_col_links as $social ): ?>
								<?php if (!empty($social['url'] && !empty($social['select_type']))) : ?>
									<a class="socials__link" href="<?php echo $social['url']; ?>" target="_blank">
										<?php echo $social['select_type']; ?>
									</a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="sm__row">
				<div class="sm__col">
					<?php if ( $left_col_text ) : ?>
						<h4><?php echo $left_col_text; ?></h4>
					<?php endif; ?>
				</div>
				<?php if ( $right_col_text ) : ?>
					<div class="sm__col sm__content">
						<?php echo $right_col_text; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( is_array($video_repeater) ) : ?>
			<div class="sm__videos multiple-info__videos">
				<?php foreach ( $video_repeater as $item ) : ?>
					<?php
					$media_type = is_array( $item ) ? $item['media_type'] : 'video';
					?>
					<?php if ( $media_type === 'video') :
						$bg = is_array( $item['video_preview'] ) ? 'style="background-image: url(' . $item['video_preview']['url'] . ')"' : ''; ?>
						<a href="<?php echo $item['select_video_type'] === 'media' ? $item['video']['url'] : $item['video_url'] ?>"
						   data-fancybox class="video-block sm-item" <?php echo $bg; ?>>
							<div class="sm-item__wrap">
								<?php if ( $item['title'] ) : ?>
									<h4 class="video-block__title"><?php echo $item['title'] ?></h4>
								<?php endif; ?>
								<?php if ( $item['subtitle'] ) : ?>
									<p class="video-block__subtitle"><?php echo $item['subtitle'] ?></p>
								<?php endif; ?>
								<?php get_template_part( 'template-parts/play' ); ?>
							</div>
						</a>
					<?php else : ?>
						<?php
						$icon        = is_array($item) ? $item['icon'] : '';
						$info        = is_array($item) ? $item['text'] : '';
						$link        = is_array($item) ? $item['link'] : '';
						$bg_img      = is_array($item) ? $item['img_bg'] : '';
						$bg          = is_array( $bg_img ) ? 'style="background-image: url(' . $bg_img['url'] . ')"' : '';
						?>
						<div class="sm-item sm-item__content" <?php echo $bg; ?>>
							<div class="sm-item__wrap">
								<div class="sm-item__container">
									<?php if ( $icon && is_array( $icon ) ) : ?>
										<?php echo wp_get_attachment_image($icon['ID'], 'full'); ?>
									<?php endif; ?>
									<?php if ( $info ) : ?>
										<h4 class="sm-item__info"><?php echo $info; ?></h4>
									<?php endif; ?>
									<?php if ( ! empty( $link ) && is_array( $link ) ) :
										$link_target = $link['target'] ?: '_self'; ?>
										<a class="btn-fill-yellow" href="<?php echo $link['url']; ?>"
										   target="<?php echo esc_attr( $link_target ); ?>">
											<span><?php echo $link['title']; ?></span>
											<?php get_template_part( 'template-parts/arrow-hover' ); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

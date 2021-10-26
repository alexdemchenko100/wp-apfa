<?php
/**
 * Block Name: Our Staff
 * Description: Block with Video, Text, Team info.
 * Category: common
 * Icon: format-gallery
 * Keywords: our staff acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package Afpa
 *
 * @var array $block
 */

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
endif;

$slug         = str_replace( 'acf/', '', $block['name'] );
$block_id     = !empty($block['anchor']) ? $block['anchor'] : $slug . '-' . $block['id'];
$align_class  = $block['align'] ? 'align' . $block['align'] : '';
$custom_class = isset( $block['className'] ) ? $block['className'] : '';
$info         = get_field( 'info' );
$video        = get_field( 'video' );
$team         = get_field( 'team' );
?>
<section id="<?php echo $block_id; ?>" class="<?php echo $slug; ?> os">
	<div class="os__container">
		<div class="os-top">
			<?php if ( $video && is_array( $video ) ):
				$bg    = is_array( $video['preview'] ) ? 'style="background-image: url(' . $video['preview']['url'] . ')"' : '';
				$url   = ( $video['select_video_type'] === 'media' ) ? $video['video_file']['url'] : $video['video_url'];
				$title = $video['title'];
			?>
				<?php if ( $url ) : ?>
					<a href="<?php echo $url; ?>" data-fancybox class="video-block sm-item" <?php echo $bg; ?>>
						<div class="sm-item__wrap">
							<?php if ( $title ) : ?>
								<h4 class="video-block__title"><?php echo $title; ?></h4>
							<?php endif; ?>
							<?php get_template_part( 'template-parts/play' ); ?>
						</div>
					</a>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( $info ) : ?>
				<div class="intro-top__content os-top__content">
					<?php echo $info; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="os__container os__container--team">
		<?php if ( $team ) : ?>
			<div class="os__team team">
				<?php foreach ( $team as $person ) :
					$person_img     = is_array($person) ? $person['image'] : '';
					$default_thumb  = get_field('default_thumbnail', 'option');
					$thumb          = ! empty( $person_img ) && is_array( $person_img ) ? $person_img : $default_thumb;
					?>
					<div class="team-item">
						<?php if ( ! empty( $thumb ) && is_array( $thumb ) ) : ?>
							<div class="team-item__image">
								<?php echo wp_get_attachment_image( $thumb['ID'], 'staff' ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $person['name'] || $person['position'] ) : ?>
							<div class="team-item__info">
								<?php if ( $person['name'] ) : ?>
									<p class="team-item__name"><?php echo $person['name']; ?></p>
								<?php endif; ?>

								<?php if ( $person['position'] ) : ?>
									<p class="team-item__position"><?php echo $person['position']; ?></p>
								<?php endif; ?>

								<?php if ( $person['phone'] && is_array($person['phone']) ) : ?>
									<a class="team-item__link" href="<?php echo $person['phone']['url']; ?>" target="_blank">
										<?php echo $person['phone']['title']; ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="os__bg"></div>
</section>

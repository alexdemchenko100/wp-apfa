<?php
/**
 * Block Name: Multiple Info
 * Description: Multiple Info block managed with ACF.
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
$children 			= get_pages( array( 'child_of' => $post->ID ) );
$slug           	= str_replace( 'acf/', '', $block['name'] );
$block_id       	= $slug . '-' . $block['id'];
$align_class    	= $block['align'] ? 'align' . $block['align'] : '';
$custom_class   	= isset( $block['className'] ) ? $block['className'] : '';
$bg_before   		= get_field( 'change_bg_before_section' );
$change_bg_before   = $bg_before ? 'js-change js-change-bg-before' : '';
$bg_after   		= get_field( 'change_bg_before_section' );
$change_bg_after   	= $bg_after ? 'js-change js-change-bg-after' : '';
$bg_pattern      	= get_field( 'background_pattern' );
$bg      			= $bg_pattern ? 'pattern' : '';
$image_position  	= get_field( 'image_position' );
$position  			= isset( $image_position ) ? $slug . '-' . $image_position : '';
$image  			= get_field( 'image' );
$title  			= get_field( 'content_small_title' );
$content			= get_field( 'content' );
$titles				= get_field( 'green_titles' );
$green_titles		= $titles ? 'green-titles' : '';
$link				= get_field( 'link' );
$link_bg			= get_field( 'link_yellow_bg' );
$yellow_bg			= $link_bg ? 'btn-fill-yellow' : 'btn-outline';
$bottom_element		= get_field( 'bottom_element' );
$video_repeater		= get_field( 'video_repeater' );
$slides				= get_field( 'slider' );
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?> <?php echo $change_bg_before; ?>
 <?php echo $change_bg_after; ?> <?php echo 'section-bg-'.$bg; ?>">
	<div class="<?php echo $slug; ?>__block">
		<div class="<?php echo $slug; ?>-top <?php echo $position ?>">
			<?php if ( $image ) : ?>
				<div class="<?php echo $slug; ?>-top__image">
					<img src="<?php echo $image['sizes']['multiple-info']  ?>" alt="">
				</div>
			<?php endif; ?>

			<div class="<?php echo $slug; ?>-top__content <?php echo $slug; ?>-top__content--<?php echo $position ?>">
				<div class="<?php echo $slug; ?>-top__content-wrap">
					<?php if ( $title ) : ?>
						<h5 class="<?php echo $slug; ?>-top__title"><?php echo $title; ?></h5>
					<?php endif; ?>

					<?php if ( $content ) : ?>
						<div class="<?php echo $slug; ?>-top__text <?php echo $green_titles ?>"><?php echo $content; ?></div>
					<?php endif; ?>

					<?php if ($link):
						$link_target = $link['target'] ?: '_self'; ?>
						<a class="btn-arrow <?php echo $yellow_bg ?> <?php echo $slug; ?>-top__link" href="<?php echo $link['url'] ?>"
						   target="<?php echo esc_attr($link_target); ?>">
							<span><?php echo $link['title']; ?></span>
							<?php get_template_part( 'template-parts/arrow-hover' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="<?php echo $slug; ?>__bg"></div>

		<?php if ( is_array( $video_repeater ) && $bottom_element == 'videos' ) : ?>
			<div class="<?php echo $slug; ?>__videos">
				<?php foreach ( $video_repeater as $video ) : ?>
					<?php
					$bg = is_array( $video['video_preview'] ) ? 'style="background-image: url(' . $video['video_preview']['url'] . ')"' : '';
					?>
					<a href="<?php echo $video['select_type'] == 'media'? $video['video']['url'] : $video['url'] ?>"
					   data-fancybox class="video-block">
						<div class="video-block__bg" <?php echo $bg; ?>></div>
						<?php if ( $video['title'] ) : ?>
							<p class="video-block__title"><?php echo $video['title'] ?></p>
						<?php endif; ?>

						<?php if ( $video['subtitle'] ) : ?>
							<p class="video-block__subtitle"><?php echo $video['subtitle'] ?></p>
						<?php endif; ?>

						<?php get_template_part( 'template-parts/play' ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $slides && is_array( $slides ) && $bottom_element == 'slider' ) : ?>
			<div class="<?php echo $slug; ?>__slider">
				<div class="swiper-container swiper-container_main">
					<div class="swiper-wrapper">
						<?php foreach ( $slides as $slide ) : ?>
							<?php
							$slide_img = is_array($slide) ? $slide['slide'] : '';
							$bg        = ( ! empty( $slide_img ) && is_array( $slide_img ) ) ? 'style="background-image: url(' . $slide_img['url'] . ')"' : '';
							?>
							<?php if ($bg ) : ?>
								<div class="swiper-slide <?php echo $slug; ?>-slide" <?php echo $bg; ?>>
									<p class="caption"><?php echo $slide['сaption'] ?></p>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
		<?php endif; ?>
	</div>
</section>

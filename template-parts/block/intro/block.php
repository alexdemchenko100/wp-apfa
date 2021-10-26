<?php
/**
 * Block Name: Intro
 * Description: Intro Section with Image, Text, Link and Table.
 * Category: common
 * Icon: format-image
 * Keywords: intro acf block
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
$left_col_content  = is_array( $left_col ) ? $left_col['content_type'] : '';
$row_class         = ( $left_col_content === 'img' ) ? 'center' : 'bold';
$left_image        = is_array( $left_col ) ? $left_col['image'] : '';
$left_text         = is_array( $left_col ) ? $left_col['text'] : '';
$right_col		   = is_array( $content ) ? $content['right_col'] : '';
$info              = is_array( $right_col ) ? $right_col['text'] : '';
$link              = is_array( $right_col ) ? $right_col['link'] : '';
$data              = get_field( 'data' );
$title             = is_array( $data ) ? $data['title'] : '';
$rows              = is_array( $data ) ? $data['rows'] : '';
$disable_bg        = get_field( 'disable_bg' );
$disable_bg_class  = $disable_bg ? 'sm' : '';
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">
	<div class="intro__container">
		<div class="intro-top <?php echo $row_class; ?> <?php echo $disable_bg_class; ?>">
				<?php if ( ( $left_col_content === 'img' ) && ( ! empty( $left_image ) && is_array( $left_image ) ) ) : ?>
					<div class="intro-top__image">
						<?php echo wp_get_attachment_image( $left_image['ID'], 'intro' ); ?>
					</div>
				<?php elseif ( ( $left_col_content === 'text' ) && $left_text ): ?>
					<div class="intro-top__bold">
						<h4><?php echo $left_text; ?></h4>
					</div>
				<?php endif; ?>

				<?php if ( $info || ( $link && is_array( $link ) ) ) : ?>
					<div class="intro-top__content">
						<?php if ( $info ) : ?>
							<?php echo $info; ?>
						<?php endif; ?>
						<?php
						if ( ! empty( $link ) && is_array( $link ) ) :
							$link_target = $link['target'] ?: '_blank';
							?>
							<a class="intro-top__link btn-outline" href="<?php echo $link['url']; ?>"
							   target="<?php echo esc_attr( $link_target ); ?>">
								<span><?php echo $link['title']; ?></span>
								<?php get_template_part( 'template-parts/arrow-hover' ); ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php if ( $title || ( $rows && is_array( $rows ) ) ) : ?>
			<div class="intro-data">
				<?php if ( $title ) : ?>
					<h2><?php echo $title; ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $rows ) && is_array( $rows ) ) : ?>
					<div class="intro-data__rows">
						<?php foreach ( $rows as $row ) : ?>
							<?php
							$title  = is_array( $row ) ? $row['title'] : '';
							$top    = is_array( $row ) ? $row['top_text'] : '';
							$bottom = is_array( $row ) ? $row['bottom_text'] : '';
							?>
							<div class="intro-data__row">
								<?php if ( $top ) : ?>
									<p class="top"><?php echo $top; ?></p>
								<?php endif; ?>
								<?php if ( $title ) : ?>
									<p class="title"><?php echo $title; ?></p>
								<?php endif; ?>
								<?php if ( $bottom ) : ?>
									<p class="bottom"><?php echo $bottom; ?></p>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	<?php if ( !$disable_bg ): ?>
		<div class="intro__bg"></div>
	<?php endif; ?>
</section>

<?php
/**
 * Block Name: Our Board
 * Description: Our Board Section with Info, Names, Positions.
 * Category: common
 * Icon: admin-users
 * Keywords: our board acf block
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
$right_col		   = is_array( $content ) ? $content['right_col'] : '';
$data              = get_field( 'data' );
$title             = is_array( $data ) ? $data['title'] : '';
$rows              = is_array( $data ) ? $data['rows'] : '';
$note              = is_array( $data ) ? $data['note'] : '';
?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?> ob">
	<div class="ob__container">
		<?php if ( $left_col || $right_col ) : ?>
			<div class="ob-top">
			<?php if ( $left_col ): ?>
			<div class="intro-top__bold">
				<h4><?php echo $left_col; ?></h4>
			</div>
			<?php endif; ?>
				<?php if ( $right_col ) : ?>
			<div class="intro-top__content ob-top__content">
				<p><?php echo $right_col; ?></p>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php if ( $title || ( $rows && is_array( $rows ) ) ) : ?>
			<div class="ob-data">
				<?php if ( $title ) : ?>
					<h3 class="ob-title"><?php echo $title; ?></h3>
				<?php endif; ?>
				<?php if ( ! empty( $rows ) && is_array( $rows ) ) : ?>
					<div class="ob-data__rows">
						<?php foreach ( $rows as $row ) : ?>
							<?php
							$name     = is_array( $row ) ? $row['name'] : '';
							$url      = is_array( $row ) ? $row['url'] : '';
							$position = is_array( $row ) ? $row['position'] : '';
							?>
							<div class="ob-data__row">
								<?php if ( $name ) : ?>
									<?php if ( $url ) : ?>
										<a class="ob-link" href="<?php echo $url; ?>" target="_blank"><?php echo $name; ?></a>
									<?php else : ?>
										<p class="ob-name"><?php echo $name; ?></p>
									<?php endif; ?>
								<?php endif; ?>
								<?php if ( $position ) : ?>
									<p class="ob-pos"><?php echo $position; ?></p>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
						<?php if ( $note ) : ?>
							<h5 class="ob-note"><?php echo $note; ?></h5>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

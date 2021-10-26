<?php
/**
 * Block Name: Resources List
 * Description: Resources List Section with Titles, Text, Links.
 * Category: common
 * Icon: editor-ul
 * Keywords: resources list acf block
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
$block_title       = get_field( 'list_title' );
$list              = get_field( 'list' );
?>
<?php if ( $block_title || ( $list && is_array( $list ) ) ) : ?>
<section
	id="<?php echo $block_id; ?>"
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?> rl-block">
	<div class="rl-block__container">
		<?php if ( $block_title ) : ?>
			<h5 class="rl-block__title"><?php echo $block_title; ?></h5>
		<?php endif; ?>
		<?php if ( ! empty( $list ) && is_array( $list ) ) : ?>
			<div class="rl-block__rows">
				<?php foreach ( $list as $row ) : ?>
					<?php
						$title = is_array( $row ) ? $row['title'] : '';
						$text  = is_array( $row ) ? $row['text'] : '';
						$link  = is_array( $row ) ? $row['link'] : '';
						?>
					<div class="rl-block__row">
						<?php if ( $title ) : ?>
							<h4><?php echo $title; ?></h4>
						<?php endif; ?>
						<?php if ( $text || ( $link && is_array( $link ) ) ) : ?>
							<div class="rl-block__content">
								<?php if ( $text ) : ?>
									<p><?php echo $text; ?></p>
								<?php endif; ?>
								<?php if ( $link && is_array( $link ) ) : ?>
									<a class="btn-outline" href="<?php echo $link['url']; ?>"
									   target="<?php echo $link['target']; ?>">
										<span><?php echo $link['title']; ?></span>
										<?php get_template_part( 'template-parts/arrow-hover' ); ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>

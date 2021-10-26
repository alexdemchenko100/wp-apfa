<?php
/**
 * Block Name: Resources List FAQ
 * Description: Resources List FAQ Section with Titles, Text, Links.
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
	class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?> rlfaq-block">
	<div class="rlfaq-block__container">
		<?php if ( $block_title ) : ?>
			<h5 class="rlfaq-block__title"><?php echo $block_title; ?></h5>
		<?php endif; ?>
		<?php if ( ! empty( $list ) && is_array( $list ) ) : ?>
			<div class="rlfaq-block__rows faq-block">
				<?php foreach ( $list as $row ) : ?>
					<?php
						$title = is_array( $row ) ? $row['title'] : '';
						$sublist  = is_array( $row ) ? $row['list'] : '';
						?>
					<div class="rlfaq-block__row faq-item">
						<?php if ( $row['title'] ) : ?>
							<div class="faq-item__shown"><h4 class="shown-title"><?php echo $row['title']; ?></h4>
								<span class="shown-icon"><?php get_template_part( 'template-parts/faq' ); ?></span>
							</div>

						<?php endif; ?>

						<?php if ( ! empty( $sublist ) && is_array( $sublist ) ) : ?>
							<div class="faq-item__hidden">
								<?php foreach ( $sublist as $item ) : ?>
									<?php
									$title = is_array( $item ) ? $item['title'] : '';
									$links_list  = is_array( $item ) ? $item['links'] : '';
									?>
									<div class="rlfaq-block__subrow">
										<?php if ( $title ) : ?>
											<p class="subtitle"><?php echo $title; ?></p>
										<?php endif; ?>

										<?php if ( ! empty( $links_list ) && is_array( $links_list ) ) : ?>
											<div class="links-block">
												<?php foreach ( $links_list as $link_item ) : ?>

													<div class="links-block__items">
														<?php if ( $link_item['select_type'] == 'pdf' && $link_item['file'] ) : ?>
															<a href="<?php echo $link_item['file']['url']; ?>" class="type-pdf">
																<?php esc_html_e( 'Download PDF', 'afpa' ); ?>
															</a>
														<?php endif; ?>
														<?php if ( $link_item['select_type'] == 'video' && $link_item['video'] ) : ?>
															<a href="<?php echo $link_item['video']; ?>" target="_blank" class="type-video">
																<?php esc_html_e( 'Watch Video', 'afpa' ); ?>
															</a>
														<?php endif; ?>
														<?php if ( $link_item['select_type'] == 'link' && $link_item['link'] ) : ?>
															<a href="<?php echo $link_item['link']['url']; ?>"
															   target="<?php echo $link_item['link']['target'] ?: '_self' ?>" class="type-link">
																<?php echo $link_item['link']['title']; ?>
															</a>
														<?php endif; ?>
													</div>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>

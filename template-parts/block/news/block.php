<?php
/**
 * Block Name: News
 * Description: Display News for last three month.
 * Category: common
 * Icon: exerpt-view
 * Keywords: news acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package Afpa
 *
 * @var array $block
 */

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
endif;

$slug           = str_replace( 'acf/', '', $block['name'] );
$block_id       = $slug . '-' . $block['id'];
$align_class    = $block['align'] ? 'align' . $block['align'] : '';
$custom_class   = isset( $block['className'] ) ? $block['className'] : '';
$title          = get_field( 'title' );
$posts_count    = get_field( 'posts_count' );
$link           = get_field( 'link' );
?>
<section id="<?php echo $block_id; ?>" class="news">
	<div class="news__container">
		<div class="news__header">
			<?php if ( $title ) : ?>
				<h2 class="news__title"><?php echo $title ?></h2>
			<?php endif; ?>

			<?php if ( ! empty( $link ) && is_array( $link) ) :
				$link_target = $link['target'] ? $link['target'] : '_self'; ?>
				<a class="news__btn btn-fill-yellow" href="<?php echo $link['url']; ?>"
				   target="<?php echo $link_target; ?>">
					<span><?php echo $link['title']; ?></span>
					<?php get_template_part( 'template-parts/arrow-hover' ); ?>
				</a>
			<?php endif; ?>
		</div>
		<div class="news__wrap">
			<?php
			$today = date( 'Y-m-d' );
			$from = date('Y-m-d', strtotime(date('Y-m-d')." -3 month"));
			$count_stickies = count( get_option( 'sticky_posts' ) );
			$ppp = ( $count_stickies < $posts_count ) ? ( $posts_count - $count_stickies ) : $count_stickies;
			$args  = array(
				'post_type'      => 'post',
				'posts_per_page' => $ppp,
				'posts_status'   => 'publish',
				'orderby' 		 => 'date',
				'order'          => 'DESC',
				'date_query'    => array(
					'column'  => 'post_date',
					'after'   => $from,
					'compare' => '>=',
				)
			);

			$posts = new WP_Query( $args );

			if ( $posts->have_posts() ) : ?>
				<?php
				while ( $posts->have_posts() ) :
					$posts->the_post();
					get_template_part( 'template-parts/post-template', '' );
				endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>

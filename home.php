<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Afpa
 */

global $post;
$breadcrumb_class = (is_page() && $post->post_parent) ? 'child' : 'index';
$title       	= get_field( 'info_title', 'options' );
$text       	= get_field( 'info_text', 'options' );
$link       	= get_field( 'info_link', 'options' );
$select_view  	= get_field('select_view');
$ctas         	= get_field('ctas', 'option');
get_header(); ?>

	<div id="primary" class="content-area">
		<section id="main" class="site-main" role="main">
			<section  class="industry-hero">

				<div class="industry-hero__container">
					<?php yoast_breadcrumb( '<div data-aos="fade-up" data-aos-duration="500" data-aos-delay="300" data-aos-easing="ease-out" class="page-breadcrumbs ' . $breadcrumb_class .'" ><p id="breadcrumbs">','</p></div>' ); ?>

					<h2 data-aos="fade-up" data-aos-duration="500" data-aos-delay="300" data-aos-easing="ease-out">
						<?php echo __('News', 'domains'); ?>
					</h2>

					<div class="hero__scroll">
						<a class="js-scroll-down" href="#">
							<?php get_template_part( 'template-parts/scroll-down' ); ?>
						</a>
					</div>
				</div>
			</section>

			<div class="news-archive__container">
				<div class="news-archive__header">
					<div class="news-select">
						<select onchange="document.location.href=this.options[this.selectedIndex].value;">
							<option class="h5" value="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">ALL ARCHIVES </option>
							<?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
						</select>
					</div>
				</div>
				<div class="news-archive__wrap">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/post-template', '' );

						endwhile;

						the_posts_pagination( array(
								'mid_size' => 2,
						) );

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</div>
			</div>

			<section class="afpa-info">

				<div class="afpa-info__container">
					<?php if ( $title ) : ?>
						<h5>
							<?php echo $title; ?>
						</h5>
					<?php endif; ?>

					<?php if ( $text ) : ?>
						<h3>
							<?php echo $text; ?>
						</h3>
					<?php endif; ?>

					<?php if ($link):
						$link_target = $link['target'] ?: '_self'; ?>
						<a class="btn-arrow btn-fill-yellow" href="<?php echo $link['url'] ?>"
						   target="<?php echo esc_attr($link_target); ?>">
							<span><?php echo $link['title']; ?></span>
							<?php get_template_part( 'template-parts/arrow-hover' ); ?></a>
					<?php endif; ?>
				</div>
			</section>

			<section class="cta">
				<div class="cta__rows <?php echo $select_view; ?>">
					<?php foreach ( $ctas as $cta ) : ?>
						<?php
						$icon        = is_array($cta) ? $cta['icon'] : '';
						$tag         = is_array($cta) ? $cta['tag'] : '';
						$info        = is_array($cta) ? $cta['info'] : '';
						$sub_info    = is_array($cta) ? $cta['sub_info'] : '';
						$link        = is_array($cta) ? $cta['link'] : '';
						$add_bg      = is_array($cta) ? $cta['add_bg'] : '';
						$bg_class    = $add_bg ? 'bg' : '';
						$bg_img      = is_array($cta) ? $cta['bg_img'] : '';
						$bg_pos      = is_array($cta) ? $cta['bg_position'] : '';
						$bg_pos_item = !empty($bg_pos) ? $bg_pos : '50% 50%';
						$bg_url      = ( ! empty( $bg_img ) && is_array( $bg_img ) ) ? $bg_img['url'] : '';
						?>
						<div class="cta-item <?php echo $bg_class; ?> <?php echo $select_view; ?>"  style="background-image: url(<?php echo $bg_url; ?>); background-position: <?php echo $bg_pos_item; ?>; ">
							<div class="cta-item__container <?php echo $select_view; ?>">
								<?php if ( $icon && is_array( $icon ) ) : ?>
									<?php echo wp_get_attachment_image($icon['ID'], 'full'); ?>
								<?php endif; ?>
								<?php if ( $tag ) : ?>
									<p class="tag"><?php echo $tag; ?></p>
								<?php endif; ?>
								<?php if ( $info ) : ?>
									<div class="cta-item__info"><?php echo $info; ?></div>
								<?php endif; ?>
								<?php if ( $sub_info ) : ?>
									<p class="sub <?php echo $select_view; ?>"><?php echo $sub_info; ?></p>
								<?php endif; ?>
								<?php if ( ! empty( $link ) && is_array( $link ) ) :
									$link_target = $link['target'] ?: '_self'; ?>
									<a class="btn-arrow btn-fill-yellow" href="<?php echo $link['url']; ?>"
									   target="<?php echo esc_attr( $link_target ); ?>">
										<span><?php echo $link['title']; ?></span>
										<?php get_template_part( 'template-parts/arrow-hover' ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</section>

		</section><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

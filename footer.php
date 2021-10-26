<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Afpa
 */
$footer_company    = get_field('company', 'option');
$footer_logo       = is_array($footer_company) ? $footer_company['logo'] : '';
$footer_logo_hover = is_array($footer_company) ? $footer_company['logo_hover'] : '';
$footer_heart      = is_array($footer_company) ? $footer_company['logo_heart'] : '';
$footer_heart_link = is_array($footer_company) ? $footer_company['logo_heart_link'] : '';
$footer_copy_title = is_array($footer_company) ? $footer_company['copyright_title'] : '';
$site_name         = $footer_copy_title ?: get_bloginfo('name');
$footer_copy_text  = is_array($footer_company) ? $footer_company['copyright_text'] : '';
$footer_contact    = get_field('contact', 'option');
$footer_title      = is_array($footer_contact) ? $footer_contact['title'] : '';
$footer_address    = is_array($footer_contact) ? $footer_contact['address'] : '';
$footer_info       = is_array($footer_contact) ? $footer_contact['contact_info'] : '';
$socials 		   = get_field('socials', 'option');
$footer_img        = get_field('footer_bg', 'option');
$footer_bg         = ( ! empty( $footer_img ) && is_array( $footer_img ) ) ? 'style="background-image: url(' . $footer_img['url'] . ')"' : '';
?>

</main><!-- #content -->

<footer class="site-footer" role="contentinfo" <?php echo $footer_bg; ?>>
	<div class="site-footer__container">
		<div class="site-footer__group">
			<?php if ( $footer_logo && is_array( $footer_logo ) ) : ?>
				<a class="site-footer__logo" href="<?php echo esc_url(home_url()); ?>">
					<?php echo wp_get_attachment_image( $footer_logo['id'], 'full', "", ["class" => "state"]); ?>
					<?php if ( $footer_logo_hover && is_array( $footer_logo_hover ) ) : ?>
						<?php echo wp_get_attachment_image( $footer_logo_hover['id'], 'full', "", ["class" => "hover"]); ?>
					<?php endif; ?>
				</a>
			<?php endif; ?>
			<div class="site-footer-copyright copyright copyright--desktop">
				<span><?php echo sprintf('&#169;&nbsp;%04d&nbsp;%s&nbsp;', date('Y'), $site_name); ?></span>
				<?php if ( $footer_copy_text ) : ?>
					<span><?php echo $footer_copy_text; ?></span>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( $footer_title || $footer_address || $footer_info || $socials ) : ?>
			<div class="site-footer__group site-footer__group--row">
				<?php if ( $footer_title ) : ?>
					<h6><?php echo $footer_title; ?></h6>
				<?php endif; ?>
				<?php if ( $footer_address ) : ?>
					<div class="site-footer__info"><?php echo $footer_address; ?></div>
				<?php endif; ?>
				<?php if ( $footer_info || $socials ) : ?>
					<div class="site-footer__info">
						<?php echo $footer_info; ?>
						<?php get_template_part( 'template-parts/socials' ); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<nav class="nav-footer">
			<?php
			if ( has_nav_menu( 'footer_menu' ) ) :
				wp_nav_menu(
					[
						'theme_location' => 'footer_menu',
						'menu_id'        => 'footer-menu',
						'menu_class'     => 'footer-nav',
						'container'      => false,
						'walker'         => new afpa_navwalker(),
					]
				);
			endif;
			?>
		</nav>
		<?php if ( ( $footer_heart && is_array( $footer_heart ) ) && ( $footer_heart_link && is_array( $footer_heart_link ) ) ) : ?>
			<div class="site-footer__group">
				<?php
				$item_url    = $footer_heart_link['url'];
				$item_target = $footer_heart_link['target'];
				?>
				<?php if ( $item_url ) : ?>
					<a class="site-footer__heart" href="<?php echo $item_url; ?>" href="<?php echo $item_target; ?>">
						<?php
						$url = $footer_heart['url'];
						$ext = pathinfo( $url, PATHINFO_EXTENSION );

						if ( $ext == 'svg' ) :
							$xmlString = file_get_contents( $url );
							$svg       = str_replace( '<?xml version="1.0" encoding="UTF-8"?>', '', $xmlString );
							echo $svg;
						else :
							echo wp_get_attachment_image( $footer_heart['id'] );
						endif;
						?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="site-footer-copyright copyright copyright--mobile">
			<span><?php echo sprintf('&#169;&nbsp;%04d&nbsp;%s&nbsp;', date('Y'), $site_name); ?></span>
			<?php if ( $footer_copy_text ) : ?>
				<span><?php echo $footer_copy_text; ?></span>
			<?php endif; ?>
		</div>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>

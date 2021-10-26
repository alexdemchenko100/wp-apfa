<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Afpa
 */
$socials			= get_field( 'socials', 'option' );
$hero_logo 			= get_field( 'hero_logo', 'option' );
$hero_logo_hover	= get_field( 'hero_logo_hover', 'option' );
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="header">
	<?php get_template_part( 'template-parts/notice-bar' ); ?>
	<div class="header__top">
		<div class="header__container header__container--mobile">
			<a class="header__brand" href="<?php echo esc_url( home_url() ); ?>">
				<?php if ( $hero_logo && is_array( $hero_logo ) ) : ?>
					<?php echo wp_get_attachment_image( $hero_logo['id'], 'full', "", ["class" => "state"]); ?>
				<?php endif; ?>
				<?php if ( $hero_logo_hover && is_array( $hero_logo_hover ) ) : ?>
					<?php echo wp_get_attachment_image( $hero_logo_hover['id'], 'full', "", ["class" => "hover"]); ?>
				<?php endif; ?>
			</a>
			<nav class="nav-primary header__nav navbar navbar-expand-lg">
				<?php
				if ( has_nav_menu( 'primary' ) ) :
					wp_nav_menu(
						[
							'theme_location'  => 'primary',
							'menu_id'         => 'primary-menu',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'primaryNavBar',
							'menu_class'      => 'navbar-nav',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'walker'          => new Afpa_Navwalker(),
						]
					);
				endif;
				?>
				<?php if ( $socials && is_array( $socials ) ) : ?>
					<div class="header__bottom">
						<?php get_template_part( 'template-parts/socials' ); ?>
					</div>
				<?php endif; ?>
			</nav>
			<div class="header__btns">
				<div class="navbar-toggler-wrap">
					<button class="navbar-toggler" type="button" data-name="menu" data-toggle="collapse"
							data-target="#primaryNavBar"
							aria-controls="primaryNavBar" aria-expanded="false" aria-label="Toggle navigation">
						<span class="line"></span>
						<span class="line"></span>
						<span class="line"></span>
						<span class="line"></span>
					</button>
				</div>
			</div>
		</div>
	</div>
</header>
<main id="content" class="site-content <?php echo ! is_front_page() ? 'interior-page' : ''; ?>">

<?php
$disable_bar = get_field('disable_noticebar', 'option');
$bar_content = get_field('notice_banner', 'option');
?>

<?php if ( !$disable_bar && $bar_content ) : ?>
<div class="noticebar" id="noticebar">
	<div class="noticebar__close js-close-bar">
		<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M1 15.0175L15.0175 1" stroke="white" stroke-linecap="square"/>
			<path d="M15.0175 15.0175L1 1" stroke="white" stroke-linecap="square"/>
		</svg>
	</div>
	<div class="noticebar__content">
		<?php echo $bar_content; ?>
	</div>
</div>
<?php endif; ?>

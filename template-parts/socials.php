<?php
$socials = get_field('socials', 'option');
?>
<?php if ($socials && is_array($socials)) : ?>
	<div class="socials">
		<?php foreach ($socials as $social): ?>
			<?php if (!empty($social['url'] && !empty($social['select_type']))) : ?>
				<a class="socials__link" href="<?php echo $social['url']; ?>" target="_blank">
					<?php echo $social['select_type']; ?>
				</a>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

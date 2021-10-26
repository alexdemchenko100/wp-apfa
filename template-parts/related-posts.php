<?php
$post_id  = get_the_ID();

$related = new WP_Query(array(
	'post_type' => 'post',
	'category__in' => wp_get_post_categories($post_id),
	'post__not_in' => array($post_id),
	'posts_per_page' => 2,
	'orderby' => 'date',
)); ?>

<?php if ($related->have_posts()) : ?>

    <div class="news__wrap news__wrap--related">
		<h3 class="news-title"><?php echo __( 'related news', 'afpa' ); ?></h3>

        <?php while ($related->have_posts()) : ?>

            <?php $related->the_post();

            get_template_part(
            	'template-parts/post-template',
				'',
				array(
					'class' => 'post-block--related',
				)
			);

            ?>

        <?php endwhile; ?>

    </div>

    <?php wp_reset_postdata(); ?>

<?php endif; ?>

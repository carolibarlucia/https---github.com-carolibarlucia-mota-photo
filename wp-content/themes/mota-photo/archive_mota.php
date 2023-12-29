<?php $loop = new WP_Query(array('post_type' => 'photos', 'posts_per_page' => 8, 'paged' => $paged)); ?>

<?php while ($loop->have_posts()) : $loop->the_post(); ?>


	<div class="entry-content">
		<?php the_content(); ?>
	</div>

<?php endwhile; ?>
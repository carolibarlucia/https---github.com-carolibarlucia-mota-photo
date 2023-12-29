<div>
<?php $loop = new WP_Query(array('post_type' => 'photo' , 'post_per_page' => 10 , 'paged' => $paged)); ?>
		<?php while ($loop->have_posts()) : $loop->the_post(); ?>
		<?php the_title('<h2 class="title"><a href="#" ' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '" rel=bookmark">' , '</a></h2>'); ?>
		<?php the_post_thumbnail(); ?>
		<?php the_terms($post->ID, 'catégorie'); ?>
		<?php the_terms($post->ID, 'format'); ?>
</div>



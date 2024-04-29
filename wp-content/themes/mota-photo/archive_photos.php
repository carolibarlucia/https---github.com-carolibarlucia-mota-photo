<!-- Affichage photos -->
<div class="cptcontent-photo">
	<?php
	// $args = array(
	// 	'post_type' => 'photos',
	// 	'posts_per_page' => 12,
	// 	'orderby' => 'date',
	// 	'order' => 'DESC',
	// 	'paged' => 1,
	// );
	// $loop = new WP_Query($args);
	// while ($loop->have_posts()) : $loop->the_post();
	the_content();
	// endwhile; 
	// // wp_reset_postdata();
	
$post_id = get_the_ID();
$url = get_template_directory_uri() . "/single_photo.php?id=" . $post_id;

echo '<a id="eye" class="eye-btn eye-btn-1" href="'.esc_url($url). '">';
echo '<img class="eyes" src="' . get_template_directory_uri() . '/images/Icon_eye.png" />';
echo '</a>';
?>

</div>


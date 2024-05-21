<!-- Affichage photos -->
<div class="cptcontent-photo">
	<?php

	the_content();


	$post_id = get_the_ID();

	$url = get_template_directory_uri() . "/single.php?id=" . $post_id; ?>

	<a class="ct-lightbox">
		<img class="eyes" src="<?php echo get_template_directory_uri() ?>/images/Icon_fullscreen.png" />
	</a>

	<a id="eye" class="eye-btn eye-btn-1" href="<?php echo home_url() . "/?photo=" . get_post_field('post_name', $post_id); ?>">
		<img class="eyes" src="<?php echo get_template_directory_uri() ?>/images/Icon_eye.png" />
	</a>

</div>
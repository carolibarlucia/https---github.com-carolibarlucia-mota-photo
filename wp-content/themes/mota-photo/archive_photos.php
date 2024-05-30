<!-- Affichage photos -->
<?php
$post_id = get_the_ID();
$categories = get_the_terms($post_id, 'categorie');
$reference = get_post_meta($post_id, 'reference', true);
?>

<div class="cptcontent-photo">
	<?php

	the_content();


	// $post_id = get_the_ID();

	$url = get_template_directory_uri() . "/single.php?id=" . $post_id; ?>

	<a class="ct-lightbox">
		<img class="eyes" src="<?php echo get_template_directory_uri() ?>/images/Icon_fullscreen.png" />
	</a>

	<a id="eye" class="eye-btn eye-btn-1" href="<?php echo home_url() . "/?photo=" . get_post_field('post_name', $post_id); ?>">
		<img class="eyes" src="<?php echo get_template_directory_uri() ?>/images/Icon_eye.png" />
	</a>
	<div class="photo-info">
		<?php echo $reference; ?>
		<p> </p>
		<?php
		// Remplacez 'categorie' par le slug de votre taxonomie
		if (!empty($categories)) {
			foreach ($categories as $category) {
				echo $category->name;
			}
		}
		?>
		
	</div>
</div>
<section class="menu-taxonomy">
	<div class="taxonomy">

		<select id="categorie" class=".select2">
			<option value="0"  class="select2">CATEGORIE</option>
			<?php $terms = get_terms(array(
				'taxonomy' => 'categorie',
				'hide_empty' => false,
			));

			if ($terms && !is_wp_error($terms)) {
				foreach ($terms as $term) {
					echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
				}
			}
			?>

		</select>

		<select name="format" id="format" class="select2">
			<option value="0"  class="select2">FORMAT</option>
			<?php $terms = get_terms(array(
				'taxonomy' => 'format',
				'hide_empty' => false,
			));
			if ($terms && !is_wp_error($terms)) {
				foreach ($terms as $term) {
					echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
				}
			}
			?>

		</select>

	</div>
	<div class="taxonomy">

		<select name="date" id="date" class="select2">
			<option value="DESC">TRIER PAR</option>
			<option value="DESC" class="select2">des plus récentes aux plus anciennes</option>
			<option value="ASC" class="select2">des plus anciennes aux plus récentes</option>
		</select>

	</div>
</section>
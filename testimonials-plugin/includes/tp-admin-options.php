<?php

function ST4_columns_head_only_testimonials($defaults) {
	$defaults['description'] = 'Testimonial';
	$defaults['thumbnail'] = 'Thumbnail';
	$defaults['post_status'] = 'Post Status';
	return $defaults;
}
function ST4_columns_content_only_testimonials($column_name, $post_ID) {
	if ($column_name == 'description') {
		global $post;
		$description = $post->post_content;
		echo $description;
	}
	if ($column_name == 'thumbnail') {
		global $post;
		if (has_post_thumbnail()) {
			the_post_thumbnail(array(60, 60));
		}
	}
	if ($column_name == 'post_status') {
		global $post;
		$status = $post->post_status;
		?>
		<form method="POST">
            <input type="submit" class="button button-primary" name="submit" value="<?php echo $status; ?>">
            <input type="hidden" name="id" value="<?php echo get_the_ID(); ?>">
        </form>

 <?php
}
}
?>
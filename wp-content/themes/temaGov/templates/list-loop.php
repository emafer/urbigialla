<ul class="su-posts su-posts-list-loop">
<?php
// Posts are found
if ( $posts->have_posts() ) {
	while ( $posts->have_posts() ) {
		$posts->the_post();
		global $post;
?>
<li id="su-post-<?php the_ID(); ?>" class="su-post"><?php
        echo madisoft_scuola_scrivi_titolo(true, '3', true, $post ); ?></li>
<?php
	}
	echo '</ul>';
}
// Posts not found
else {
    get_template_part('include/templates/not_found_template_part');
}

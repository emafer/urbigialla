<div class="su-posts su-posts-default-loop">
	<?php
		// Posts are found
		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) {
                $posts->the_post();
                global $post;
               echo  madisoft_scuola_Post(2, true, true, $post, false, 4);
            }
		}
		// Posts not found
		else {
            get_template_part( 'include/templates/not_found_template_part' );
		}
	?>
</div>
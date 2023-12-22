<div class="su-posts su-posts-single-post">
	<?php
		// Prepare marker to show only one post
		$first = true;
		// Posts are found
		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) :
				$posts->the_post();
				global $post;

				// Show oly first post
				if ( $first ) {
					$first = false;
                    if (possoVisualizzareQuestoContenuto()){
                        ?>
                        <article>
                            <div class="post" id="post-<?php the_ID(); ?>">
                                <?php
                                madisoft_scuola_scrivi_titolo( '', '2', false, $post );
                                madisoft_scuola_mostra_meta ($post);
                                echo '<div class="postentry">' ."\n";
                                madisoft_theme_mostra_excerpt();
                                mostraPulsanteStampaSePossibile();
                                the_content( madisoft_scuola_get_testo_per_continua_a_leggere() );
                                wp_link_pages();
                                echo '</div>';
                                ?>
                            </div>
                        </article>
                    <?php }
				}
			endwhile;
		}
		// Posts not found
		else {
            get_template_part( 'include/templates/not_found_template_part' );
		}
	?>
</div>
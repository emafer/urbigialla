<?php
/** @var $post WP_Post */
madisoft_scuola_crea_struttura_superiore();
$post = WP_Post::get_instance(get_the_ID());
if ( $post ) {
        the_post();
        if (possoVisualizzareQuestoContenuto()) {
        ?>
        <article>
            <div class="post" id="post-<?php the_ID(); ?>">
                <?php
		if (madisoftThemePluginOpzioniPost::getValueOfOption('post_show_titolo', 1) != 2)
		{
                echo scriviTitoloEImmagineInEvidenza(
                        false,
                        $post, madisoft_scuola_protect_title($post),
                        2,
                        false,
                        true
                );
		}
                madisoft_scuola_mostra_meta ($post);
                echo '<div class="postentry">' ."\n";
                madisoft_theme_mostra_excerpt();
                mostraPulsanteStampaSePossibile();
                echo madisoft_get_the_content();
                    wp_link_pages();
                echo '</div>';
                    ?>
            </div>
        </article>
    <?php }

	} else {
	    ?>
        <h2><?php _e( 'Non trovato' ); ?></h2>
        <p><?php _e( 'Spiacenti, ma la pagina richiesta non &egrave; stata trovata.' ); ?></p>
    <?php }
madisoft_scuola_crea_struttura_inferiore();

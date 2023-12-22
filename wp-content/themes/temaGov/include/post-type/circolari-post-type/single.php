<?php
madisoft_scuola_crea_struttura_superiore();
?>
    <!-- Prendi gli articoli... -->
<?php
$post = WP_Post::get_instance(get_the_ID());
//if ( have_posts() ) {
//    while ( have_posts() ){
//        the_post();
        ?>
    <div class="post" id="post-<?php the_ID(); ?>">
        <?php
        if ( !possoVisualizzareQuestoContenuto($post->ID) ){
            ?>
            <div class="postentry">
                Spiacente, il contenuto &egrave; riservato.<br/>
                Puoi accedere con le credenziali in tuo possesso per leggerne il contenuto.
            </div>
            </div>
            <?php
        }
        else {
            if (post_password_required()){
                echo get_the_password_form();
            } else
                {
            $data = new DateTime( get_post_meta( $post->ID, 'circolare_data', true ) );	$ed   = $data->format( 'd/m/Y' );
			
            ?>
            <h2 class="postTitle"><?php echo get_the_title( $post->ID  ); ?> - N.  <?php echo get_post_meta( $post->ID, 'circolare_numero', true ); ?> del <?php echo $ed; ?></h2>
            <div class="postentry">
                <?php if (!empty($post->post_content)) {
                    echo '<div class="riassuntoCircolare">';
                    the_content();
                    echo '</div>';
                }
                mostraPulsanteStampaSePossibile();
                wp_link_pages(); ?>
            </div>
            <div>
                <?php
                if ( madisoft_get_theme_option( 'madisoft_scuola_circolari_destinatari', '1' ) == '1' ) {
                    ?>
                    <p><strong>Destinari: </strong><br/>
                        <?php echo madisoft_scuola_print_categorie($post->ID, 'destinatari_circolari'); ?>
                    </p><br/>
                <?php } ?>
                <?php
                if ( madisoft_get_theme_option( 'madisoft_scuola_circolari_tipologia', '1' ) == '1' ) {
                    ?>
                    <p><strong><?php echo madisoft_get_theme_option('madisoft_scuola_circolari_tipologia_nome', 'Tipologia'); ?>: </strong><br/>
                        <?php echo madisoft_scuola_print_categorie($post->ID, 'tipologia_circolari'); ?>
                    </p><br/>
                <?php } ?>
                <?php if (get_post_meta($post->ID, 'circolare_allegato', true)) { ?>
                    <br>
                    <p>
                        <strong>Allegati: </strong>
                        <br/>
                        <a target="_blank" href="<?php echo get_post_meta($post->ID, 'circolare_allegato', true); ?>">Scarica <?php echo basename( get_post_meta($post->ID, 'circolare_allegato', true)); ?></a>
                        <?php if ( get_post_meta($post->ID, 'circolare_allegato2', true) ) { ?><br/><a target="_blank" href="<?php echo get_post_meta($post->ID, 'circolare_allegato2', true); ?>">Scarica <?php echo basename( get_post_meta($post->ID, 'circolare_allegato2', true)); ?></a> <?php } ?>
                        <?php if ( get_post_meta($post->ID, 'circolare_allegato3', true) ) { ?><br/><a target="_blank" href="<?php echo get_post_meta($post->ID, 'circolare_allegato3', true); ?>">Scarica <?php echo basename( get_post_meta($post->ID, 'circolare_allegato3', true)); ?></a> <?php } ?>
                        <?php if ( get_post_meta($post->ID, 'circolare_allegato4', true) ) { ?><br/><a target="_blank" href="<?php echo get_post_meta($post->ID, 'circolare_allegato4', true); ?>">Scarica <?php echo basename( get_post_meta($post->ID, 'circolare_allegato4', true)); ?></a> <?php } ?>
                        <?php if ( get_post_meta($post->ID, 'circolare_allegato5', true) ) { ?><br/><a target="_blank" href="<?php echo get_post_meta($post->ID, 'circolare_allegato5', true); ?>">Scarica <?php echo basename( get_post_meta($post->ID, 'circolare_allegato5', true)); ?></a> <?php } ?>
                        <?php if ( get_post_meta($post->ID, 'circolare_allegato6', true) ) { ?><br/><a target="_blank" href="<?php echo get_post_meta($post->ID, 'circolare_allegato6', true); ?>">Scarica <?php echo basename( get_post_meta($post->ID, 'circolare_allegato6', true)); ?></a> <?php } ?>
                        <?php if ( get_post_meta($post->ID, 'circolare_allegato7', true) ) { ?><br/><a target="_blank" href="<?php echo get_post_meta($post->ID, 'circolare_allegato7', true); ?>">Scarica <?php echo basename( get_post_meta($post->ID, 'circolare_allegato7', true)); ?></a> <?php } ?>
                    </p>
                <?php } ?>
            </div>
            <?php
        }
        echo '</div>';
        }
//    }
//}

 madisoft_scuola_crea_struttura_inferiore();
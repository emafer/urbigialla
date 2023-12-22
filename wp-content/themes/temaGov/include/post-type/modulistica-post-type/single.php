<?php
madisoft_scuola_crea_struttura_superiore();

$post = WP_Post::get_instance(get_the_ID());
//if ( have_posts() ) {
//    while (have_posts()) {
//        the_post();
        if ( possoVisualizzareQuestoContenuto($post->ID) ) {
            ?>
            <div class="post" id="post-<?php the_ID(); ?>">
                <h2 class="postTitle"><?php the_title(); ?></h2>
            </div>
            <div>
                <p><strong>Destinari: </strong>
                    <?php echo madisoft_scuola_print_categorie($post->ID, 'destinatari_modulistica'); ?>
                </p>

                <?php
                if (madisoft_get_theme_option('madisoft_scuola_modulistica_tipologia', '1') == '1') {
                    ?>
                    <p>
                        <strong><?php echo madisoft_get_theme_option('madisoft_scuola_modulistica_tipologia_nome', 'Tipologia'); ?>: </strong><br/>
                        <?php echo madisoft_scuola_print_categorie($post->ID, 'tipologia_modulistica'); ?>
                    </p><br/>
                <?php } ?>
                <?php
                $link_file = get_post_meta($post->ID, 'modulistica_allegato', true);
                if ($link_file) { ?>
                    <br>
                    <p><strong>Allegato: </strong>
                        <a target="_blank" href="<?php echo $link_file; ?>">Scarica l'allegato</a>
                    </p>
                    <?php
                } ?>
            </div>
            <?php
        } else {
            ?>
            <div class="postentry">
                Spiacente, il contenuto &egrave; riservato.<br/>
                Puoi accedere con le credenziali in tuo possesso per leggerne il contenuto.
            </div>
            <?php
        }
//
//    }
//} else { ?>
<!--    <h2>--><?php //_e( 'Non trovato' ); ?><!--</h2>-->
<!--    <p>--><?php //_e( 'Spiacenti, ma la pagina richiesta non &egrave; stata trovata.' ); ?><!--</p>-->
<?php //} ?>

<?php
madisoft_scuola_crea_struttura_inferiore();
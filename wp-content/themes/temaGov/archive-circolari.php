<?php
if (madisoft_get_theme_option('madisoft_scuola_usa_layout_madisoft_per_plugin_circolari', 'off') == 'on') {
    madisoft_scuola_crea_struttura_superiore();

    wp_register_style('circolari-css', madisoft_scuola_get_assets_directory( 'css' ) . 'circolari.css', array() );
    wp_enqueue_style( 'circolari-css' );
    if (have_posts()) {
        echo '<div class="risultatiCircolari">';
        while ( have_posts() ) {
            the_post();
            $numero = get_post_meta($post->ID, '_numero', true);
            $anno = get_post_meta($post->ID, '_anno', true);
            ?>
            <div class="circolare row<?php echo getLastAccessClass(get_post_timestamp($post));?>" id="circolare_<?php echo $post->ID;?>">
                <div class="text-center numero_circolare_container col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_2; ?>  col-md-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_12; ?>"><span class="numero_circolare">N. <?php echo $numero . " " . $anno; ?></span></div>
                <div class="data_circolare_container col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_2; ?>  col-md-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_12; ?>">
                    <span class="data_circolare"><?php the_time('d/m/Y');?></span>
                </div>
                <div class="align-self-center dati-circolare col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL; ?>  col-md-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_5_6; ?> row">
                    <div class="titolo_circolare col-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL; ?>  col-md-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL; ?>">
                        <a href="<?php echo get_permalink( $post->ID); ?>"><?php echo $post->post_title; ?></a>
                    </div>
                </div>
            </div>
            <div class="nav">
                <hr/>
                <div
                    class="alignleft"><?php next_posts_link( '&laquo; ' . single_cat_title( '', false ) . ' precedenti' ) ?></div>
                <div
                    class="alignright"><?php previous_posts_link( single_cat_title( '', false ) . ' successive &raquo;' ) ?></div>
            </div>
            <div style="clear:both"></div>
                            <?php
        }
        echo '</div>';
    }
    madisoft_scuola_crea_struttura_inferiore();
} else {
    get_template_part('archive');
}
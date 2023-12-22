<?php

madisoft_scuola_crea_struttura_superiore();

	if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>
            <div class="scuola_preview" style="margin-bottom: 30px">
                <div style="text-align: center"><?php echo madisoft_scuola_scrivi_titolo(1, '4', false, $post); ?>
                    <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail('medium'); ?></a><br/></div>
                <?php the_content(madisoft_scuola_get_testo_per_continua_a_leggere(madisoft_scuola_protect_title())) ?>
            </div>
        <?php } ?>

        <div class="nav">
            <div class="alignleft"><?php next_posts_link('&laquo; Scuole precedenti') ?></div>
            <div class="alignright"><?php previous_posts_link('Scuole successive &raquo;') ?></div>
        </div>
        <div style="clear:both"></div>
        <?php
    }

madisoft_scuola_crea_struttura_inferiore();

<?php

madisoft_scuola_crea_struttura_superiore();
$post = WP_Post::get_instance(get_the_ID());

      $scuola    = new ScuolaPost( $post->ID );
      $indirizzo = $scuola->getIndirizzoPerMappa();
      ?>
      <div class="post" id="post-<?php the_ID(); ?>">
        <?php 
		$mostroIlTitolo = get_post_meta($post->ID, 'post_show_titolo', true);
		if ($mostroIlTitolo != 2) {
			?>
		<h2 class="postTitle"><?php the_title(); ?></h2>
		<div class="postentry">
		 <div id="scuola_descrizione">
            <?php if ( get_post_thumbnail_id( $post->ID ) ) { ?>
              <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>" width="300" style="float: left; margin-right: 15px" />
            <?php } ?>
            <div id="contatti">
              <div id="indirizzo">
                <?php
                if ( get_post_meta( $post->ID, 'scuola_via', true ) ) {
                  echo '<i>' . $scuola->getIndirizzo() . '</i>';
                  ?>
                  <br />
                  <br />
                <?php }
                if ( get_post_meta( $post->ID, 'scuola_codice_meccanografico', true ) ) {
                  echo 'Cod. Meccanografico: ' . get_post_meta( $post->ID, 'scuola_codice_meccanografico', true ); ?>
                  <br />
                  <br />
                <?php
                }
                $scuola->printContatti();
                ?>
                <?php
                $scuola->printResponsabile();
                ?>
              </div>
            </div>
            <div style="clear: both"></div>
          </div>
		<?php } else {
			?>
			<div class="postentry">
			
			<?php
		}
	?>
        
         

            <?php
            $scuola->printContenutiScuola();
            ?>
        </div>
      </div>




    <?php

madisoft_scuola_crea_struttura_inferiore();
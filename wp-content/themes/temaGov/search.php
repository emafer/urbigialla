<?php
madisoft_scuola_crea_struttura_superiore();
if ( have_posts() ) { ?>

		<h2 class="pageTitle">Risultati della ricerca</h2>

		<p>Di seguito sono elencati i risultati della ricerca. Speriamo che ci sia anche quello che stavi cercando.</p>
		<p>Se non hai trovato quello che cercavi, prova a fare una ricerca pi&ugrave; generale.</p>


		<?php while ( have_posts() ) {
		    the_post();
		    ?>
			<div class="post search_post">
				<h3 id="post-<?php the_ID(); ?>">
					<small><?php the_time( 'j F Y' ) ?></small>
					-
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
				</h3>
				<p>
					<?php the_excerpt(); ?>
				</p>

				<p class="postmetadata">
                    <?php   if (get_post_type() !== 'page'){ ?>Pubblicato in <?php the_category( ', ' ) ?> | <?php } edit_post_link( 'Edit', '', ' | ' ); ?> </p>
			</div>
		<?php } ?>
	<?php } else { ?>
		<h2 class="center">Nessun articolo trovato</h2>
		<p><strong>Siamo spiacenti, ma la tua ricerca non ha dato risultati!</strong><br/>
            Prova ad allargare la ricerca, inserirendo nel modulo di ricerca termini pi&ugrave; generali.</p>
		<?php get_template_part( 'searchform' ); ?>
	<?php }
madisoft_scuola_crea_struttura_inferiore();
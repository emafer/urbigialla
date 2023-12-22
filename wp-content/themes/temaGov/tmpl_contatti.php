<?php
/*
Template Name: Contatti
*/
/** @var $post WP_Post */
madisoft_scuola_crea_struttura_superiore();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
        madisoft_scuola_Pagina($post);
	}
}
madisoft_scuola_crea_struttura_inferiore();
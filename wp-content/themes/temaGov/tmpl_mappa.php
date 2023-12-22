<?php
/*
Template Name: Mappa
*/
madisoft_scuola_crea_struttura_superiore();
?>
<div class="row">
	<div id="left"  class="col-xs-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL;?> col-sm-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_2;?>">
		<h3>Pagine</h3>
		<ul>
			<?php
			wp_list_pages( "sort_column=menu_order&title_li=" );
			?>
		</ul>
	</div>
	<div id="right"  class="col-xs-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_ALL;?> col-sm-<?php echo MadisoftScuolaWidth::MADISOFT_WIDTH_1_2;?>">
		<h3>Categorie</h3>
		<ul>
			<?php
			wp_list_categories( "hide_empty=0&sort_column=menu_order&title_li=" );
			?>
		</ul>
		<?php

        if(usaPostStyleScuole()){
		    echo madisoft_get_terms_list( 'scuola_ordine', true, 'scuola_ordine_order', 'ASC', 'Scuole', 'le_scuole' );
        }

        if (usaPostTypeCircolari()){
		    echo madisoft_get_terms_list( 'destinatari_circolari', false, 'destinatari_circolari_order', 'ASC', 'Circolari' );
        }
        if (usaPostTypeModulistica()){
            echo madisoft_get_terms_list( 'destinatari_modulistica', false, 'destinatari_modulistica_order', 'ASC', 'Modulistica' );
        }
		?>
	</div>
</div>
<?php
madisoft_scuola_crea_struttura_inferiore();


/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function usaPostTypeModulistica()
{
    return madisoft_get_theme_option('madisoft_scuola_modulistica_uso', 'on') == 'on';
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function usaPostTypeCircolari()
{
    return madisoft_get_theme_option('madisoft_scuola_circolari_uso', 'on') == 'on';
}

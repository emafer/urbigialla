<?php

$category = get_queried_object();
global $madisoftTheme;
$destinari_tax = $madisoftTheme->getGlobalVar( 'modulistica_destinatari_taxonomy' );
/**@var $modulisticaPostTypeClass ModulisticaPostType */
$modulisticaPostTypeClass = $madisoftTheme->getGlobalVar( 'modulistica_post_type' );
$wp_query                 = showModulistica::getAll();

madisoft_scuola_crea_struttura_superiore();
wp_enqueue_script(
                'tablesorter', // name your script so that you can attach other scripts and de-register, etc.
                madisoft_scuola_get_assets_directory( 'js' ) . 'tablesorter/jquery.tablesort.js', // this is the location of your script file
                array( 'jquery' ), // this array lists the scripts upon which your script depends,
                2
            );
?>
	<form method="post">
			<?php
			$titolo = isset( $_POST['titolo'] ) ? filter_var ( $_POST['titolo'], FILTER_SANITIZE_STRING) : '';

			?>
			<input type="text" name="titolo" value="<?php echo $titolo; ?>" class="form-control"/>
			Destinatario:
			<?php

			wp_dropdown_categories( array(
				'show_option_all' => 'Tutti',
				'orderby'         => 'name',
				'taxonomy'        => $destinari_tax::TAXONOMIA,
				'name'            => 'dest',
				'id'              => 'dest',
				'selected'        => filter_var ( $_POST['dest'], FILTER_SANITIZE_STRING),
			) );
			?>
			<input type="submit" value="Cerca">
		</form>
		<?php
		$linkDiretto = (madisoft_get_theme_option('madisoft_scuola_modulistica_download_diretto', 'off') == 'on');
            showModulistica::createTable($wp_query, true, $linkDiretto);
            wp_register_script( 'dataTables', '//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js', array( 'jquery' ) );
            wp_enqueue_script('dataTables');
?>

		<div style="clear:both"></div>
	<link href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<script>
	
	jQuery(document).ready(function() {
    $('#modulisticaTable').DataTable({
        language: {
            processing:     "In corso.",
            search:         "Ricerca sugli elementi mostrati:",
            lengthMenu:    "Motra _MENU_ elementi",
            info:           "Da _START_ a _END_ elementi mostrati su un totale di  _TOTAL_",
            infoEmpty:      "Nessun elemento trovato",
            infoFiltered:   "(filtrati su un totale di _MAX_ elementi)",
            infoPostFix:    "",
            loadingRecords: "Caricamento in croso...",
            zeroRecords:    "Nessun elemento trovato",
            emptyTable:     "Nessun elemento disponibile",
            paginate: {
                first:      "prima",
                previous:   "Precedente",
                next:       "Successiva",
                last:       "Ultima"
            },
            aria: {
                sortAscending:  ": Cliccare per ordinare la colonna in modo crescente",
                sortDescending: ": Cliccare per ordinare la colonna in modo decrescente"
            }
        }});
}) ;
		</script>
<?php madisoft_scuola_crea_struttura_inferiore();

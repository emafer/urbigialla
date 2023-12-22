<?php
function madisoft_gestione_url_aggiungi_pagina_datiScuole(){
    add_management_page(
        "Dati Scuole",
        "Dati Scuole",
        "administrator",
        basename(__FILE__),
        "datiScuole");
}

add_action('admin_menu', 'madisoft_gestione_url_aggiungi_pagina_datiScuole');

function datiScuole()
{
    global $wpdb;
    wp_enqueue_script(
        'tablesorter', // name your script so that you can attach other scripts and de-register, etc.
        madisoft_scuola_get_assets_directory( 'js' ) . 'tablesorter/jquery.tablesort.js', // this is the location of your script file
        array( 'jquery' ), // this array lists the scripts upon which your script depends,
        2
    );
    wp_register_script( 'dataTables', '//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js', array( 'jquery' ) );
    wp_enqueue_script('dataTables');
    wp_register_script( 'dataTables3', '//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js', array( 'jquery' ) );
    wp_register_script( 'dataTables2', '//cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js', array( 'jquery' ) );
    wp_register_script( 'dataTables4', '//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js', array( 'jquery' ) );
    wp_register_script( 'dataTables5', '//cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js', array( 'jquery' ) );
    wp_enqueue_script('dataTables3');
    wp_enqueue_script('dataTables2');
    wp_enqueue_script('dataTables4');
    wp_enqueue_script('dataTables5');
    $sql = 'SELECT * FROM ' . $wpdb->base_prefix . 'blogs';
    $results = $wpdb->get_results($sql);
    echo '<link href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />';
    echo '<link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />';
    ?>
    <script>
        jQuery(document).ready(function() {
            jQuery('#datiSitiTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                'copyHtml5',
                {
                    text: 'TSV',
                    extend: 'csvHtml5',
                    fieldSeparator: '\t',
                    extension: '.tsv'
                }
            ],
                language: {
                    processing:     "In corso.",
                    search:         "Ricerca sugli elementi mostrati:",
                    lengthMenu:    "Mostra _MENU_ elementi",
                    info:           "Da _START_ a _END_ elementi mostrati su un totale di  _TOTAL_",
                    infoEmpty:      "Nessun elemento trovato",
                    infoFiltered:   "(filtrati su un totale di _MAX_ elementi)",
                    infoPostFix:    "",
                    loadingRecords: "Caricamento in corso...",
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
                }
            });
        }) ;
    </script>
<?php
    echo '<table class="table-bordered table table-hover " id="datiSitiTable">
    <thead>
	    <tr>
	    	<th>#</th>
	    	<th>ID</th>
	    	<th>Dominio</th>
	    	<th>Scuola</th>
	    	<th>Meccanografico</th>
	    	<th>ITEMID</th>
	    	<th>STATO DOMINIO</th>
	    </tr>
    </thead>
    <tbody>';
    $siti = [];
    foreach ($results as $sitoWeb)
    {
        $newSito = [
            'id' => $sitoWeb->blog_id,
            'domain' => $sitoWeb->domain,
            'nome' => '',
            'mecc' => '',
            'itemId'=> '',
			'tema' =>'',
            'stato' => ''
        ];
        if ($sitoWeb->deleted) {
            $newSito['stato'] .= 'CANCELLATO';
        }

        if ($sitoWeb->public) {
            $newSito['stato'] .= ' PUBBLICO';
        }

        if ($sitoWeb->archived) {
            $newSito['stato'] .= ' ARCHIVIATO';
        }

        if ($sitoWeb->blog_id != 1) {
            $nomeTabella = $wpdb->base_prefix . $sitoWeb->blog_id . '_options';
        } else {
            $nomeTabella = $wpdb->base_prefix . 'options';
        }
        $sq1 = 'SELECT option_name, option_value FROM ' . $nomeTabella . ' where option_name="_madisoft_scuola_istituto_dati" OR option_name="cookie_script_item_id" OR option_name="cookie_script_item_src"';
        $res = $wpdb->get_results($sq1);
        if (count($res)){
            foreach($res as $risultato) {
                    if ($risultato->option_name == '_madisoft_scuola_istituto_dati') {
                        $option = unserialize($risultato->option_value);
                        if (isset($option['madisoft_scuola_istituto_nome'])) {
                            $newSito['nome'] = $option['madisoft_scuola_istituto_nome'];
                        }
                        if (isset($option['madisoft_scuola_istituto_codice_meccanografico'])) {
                            $newSito['mecc'] = $option['madisoft_scuola_istituto_codice_meccanografico'];
                        }
                    }
                    if ($risultato->option_name == 'cookie_script_item_id') {
                        $newSito['itemId'] .= $risultato->option_value;
                    }

                    if ($risultato->option_name == 'cookie_script_item_src') {
                        $newSito['itemId'] .= str_replace('//cdn.cookie-script.com/s/', '', $risultato->option_value);
                    }

            }
        }
        $siti[] = $newSito;
    }
	$counter = 0;
    foreach ($siti as $sito) {
		$counter++;
        echo '<tr>
                <td>' . $counter .'</td>
                <td>' . $sito['id'] .'</td>
                <td>' . $sito['domain'] .'</td>
                <td>' . $sito['nome'] .'</td>
                <td>' . $sito['mecc'] .'</td>
                <td>' . $sito['itemId'] .'</td>
                <td>' . $sito['stato'] .'</td>';
    }
    echo '</tbody></table>';
}

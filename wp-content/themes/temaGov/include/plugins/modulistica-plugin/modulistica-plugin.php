<?php

class MadisoftScuolaModulisticaPlugin extends madisoftThemePluginClass implements madisoftThemePluginInterface
{
    protected $content;
    protected $nomeTaxonomia;
    protected $madisoftTheme;

    function initFunction()
    {
        global $madisoftTheme;
        $this->madisoftTheme = $madisoftTheme;
        $this->setNomeTaxonomia( 'destinatari_modulistica' );
        add_shortcode('modulistica', array($this, 'insertModulistica'));
    }

    function insertModulistica($atts){
		wp_enqueue_script(
                'tablesorter', // name your script so that you can attach other scripts and de-register, etc.
                madisoft_scuola_get_assets_directory( 'js' ) . 'tablesorter/jquery.tablesort.js', // this is the location of your script file
                array( 'jquery' ), // this array lists the scripts upon which your script depends,
                2
            );
        $html = '';
        $titolo = '';
        $destinatari = '';
        $tipologia = '';
        $linkDiretto = (madisoft_get_theme_option('madisoft_scuola_modulistica_download_diretto', 'off') == 'on');
        $mostraDestinatari = true;
        extract( shortcode_atts( array(
            'src'      		=> '',
            'titolo'    	=> 'Modulistica collegata',
            'tipologia'     => '',
            'destinatari' 	=> '',
            'mostradestinatari' => 'si',
            'linkdiretto'   => 'no'
        ), $atts ) );
        //retrocompatibilità
        if (is_array($atts)){
            if ( isset($atts[0]) && !$destinatari ){
                $destinatari = $atts[0];
            }
        }
        if (is_array($atts) && isset($atts['mostradestinatari']) && $atts['mostradestinatari'] == 'no'){
            $mostraDestinatari = false;
        }

        if (is_array($atts) && isset($atts['linkdiretto']) && $atts['linkdiretto'] == 'si'){
            $linkDiretto = true;
        }

        if ($titolo){
            $html .= '<h3>' . $titolo .'</h3>';
        }
		wp_register_script( 'dataTables', '//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js', array( 'jquery' ) );
            wp_enqueue_script('dataTables');
			$id_tabella = "modu_table_" . rand(500, 9999);
        $html .= showModulistica::cercaEMostra(false, $destinatari, $tipologia, $mostraDestinatari,$linkDiretto, $id_tabella);
		$html .= '<link href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<script>
	
	jQuery(document).ready(function() {
    $("#' . $id_tabella . '").DataTable({
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
		</script>';
        return $html;
    }


    /**
     * @return mixed
     */
    public function getNomeTaxonomia() {
        return $this->nomeTaxonomia;
    }

    /**
     * @param mixed $nomeTaxonomia
     */
    public function setNomeTaxonomia( $nomeTaxonomia ) {
        $this->nomeTaxonomia = $nomeTaxonomia;
    }


}
if (madisoft_get_theme_option('madisoft_scuola_modulistica_uso', 'on') == 'on'){
    $MadisoftScuolaModulisticaPlugin = new MadisoftScuolaModulisticaPlugin();
}
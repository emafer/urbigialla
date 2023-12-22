<?php
//TODO GESTIRE OPZIONI PER BARRA RAPIDA CONTATTI
?><div id="rapid-contact" class="rapidContact container-fluid">
    <div class="row">
        <div class="col-2 col-sm-1"></div>
        <div class="col-16 col-sm-16">
        <?php
        if (madisoft_get_theme_option('madisoft_scuola_contatti-show', 'on') == 'on' ) {
            $opzione1 = madisoft_get_theme_option('madisoft_scuola_contatti_posto_1', 'mail');
            $opzione2 = madisoft_get_theme_option('madisoft_scuola_contatti_posto_2', 'telefono');
            $opzione3 = madisoft_get_theme_option('madisoft_scuola_contatti_posto_3', 'fax');
            $opzione4 = madisoft_get_theme_option('madisoft_scuola_contatti_posto_4', 'off');

            $function1 = 'stampa' . ucfirst($opzione1);
            $function2 = 'stampa' . ucfirst($opzione2);
            $function3 = 'stampa' . ucfirst($opzione3);
           $function4 = 'stampa' . ucfirst($opzione4);
            $function1();
            $function2();
            $function3();
            $function4();
			stampaTextLink();
        }
        ?>
        </div>
        <div class="col-2 col-sm-5 text-right"><a class="arearis-header-link" href="/accesso-admin/" target="_self"><span class="mobileHidden">Area riservata </span><span class="fa fa-user-circle" aria-hidden="true"></span></a></div>
        <div class="col-2 col-sm-1">
            <button style="padding: 0" type="button" class="btn btn-secondary"  data-toggle="modal" data-target="#ricercami">
                <span class="fa fa-search" aria-hidden="true"></span>
            </button></div>
			
        <div class="col-2 col-sm-1"></div>
    </div>
</div>

<?php
function stampaMail()
{
	stampaIconaRapidContactConTesto(
		'envelope', 
		madisoft_get_theme_option('madisoft_scuola_istituto_email', ''),
		'mailto:' . madisoft_get_theme_option('madisoft_scuola_istituto_email', '')
	);
 }
function stampaTelefono()
{
	$tel = madisoft_get_theme_option('madisoft_scuola_istituto_telefono','');
	if (strpos($tel, ";")) {
		list ($tel1, $tel2) = explode(";", $tel);
		$tel = $tel1 . " - " . $tel2;
	} 	else {
		$tel1 = $tel;
	}
	stampaIconaRapidContactConTesto(
		'phone', 
		$tel,
		'tel:' . $tel1
	);
}
function stampaFax()
{
	stampaIconaRapidContactConTesto(
		'fax', 
		madisoft_get_theme_option('madisoft_scuola_istituto_fax', '')
	);
}
function stampaPec()
{
	stampaIconaRapidContactConTesto(
		'envelope', 
		madisoft_get_theme_option('madisoft_scuola_istituto_pec', ''),
		'mailto:' . madisoft_get_theme_option('madisoft_scuola_istituto_pec', '')
	);
}
function stampaCmec()
{
    if (madisoft_get_theme_option('madisoft_scuola_istituto_codice_meccanografico', '123456')) {
        echo ' <strong><abbr title="codice Meccanografico">Cod. Mecc.</abbr> ' . madisoft_get_theme_option('madisoft_scuola_istituto_codice_meccanografico', '') . '</strong> ';
    }
}
function stampaOff()
{

}

function stampaCuniv() {
	 if (madisoft_get_theme_option('madisoft_scuola_istituto_codice_fatturazione', '')) {
        echo ' <strong><abbr title="codice Univoco di fatturazione">Cod. Fatt.</abbr> ' . madisoft_get_theme_option('madisoft_scuola_istituto_codice_fatturazione', '') . '</strong> ';
    }
}

function stampaIconaRapidContactConTesto($icona, $testo, $link='#')
{
	if (!$testo) {
		return '';
	}

	echo ' <strong>';
	if ($link) {
		echo  '<a href="' . $link . '"><i class="fa fa-' . $icona . '"></i></a> ';
	} else {
		echo '<i class="fa fa-' . $icona . '"></i> ';
	}
	if ($link) {
		echo '<a href="' . $link . '">';
	}
	echo '<span class="mobileHidden">' . $testo . '</span>';
	if ($link) {
		echo  '</a>&nbsp;';
	}
	echo '</strong>';
}

function stampaTextLink()
{
	stampaIconaRapidContactConTesto('bell',
	madisoft_get_theme_option('madisoft_scuola_link_barra_text', ''),
	madisoft_get_theme_option('madisoft_scuola_link_barra_link', ''),	
	);   
}
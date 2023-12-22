jQuery().ready(function(){

    jQuery(".sceltaFont").each(function(){
        cambiaFontFamily(jQuery(this));
    }).change(function(){
        cambiaFontFamily(jQuery(this));
    });


    jQuery(".cssChange").change(function () {
        let valore = jQuery("#madisoft_scuola_aggiornaCss").val()*1;
        let nuovoValore = valore+1;
        // console.log(nuovoValore, valore);
        // jQuery("#madisoft_scuola_aggiornaCss").val(nuovoValore);
    });

    jQuery("#madisoft_scuola_istituto_codice_fiscale").change(function(){
        jQuery.ajax({
            method: "POST",
            dataType: "json",
            url: "https://indicepa.registroelettronico.info/codicescuola.php",
            data: { cf_scuola: jQuery("#madisoft_scuola_istituto_codice_fiscale").val() }
        })
            .done(function( msg ) {
                jQuery("#madisoft_scuola_istituto_codice_ipa").val(msg.cod_amm);
                jQuery("#madisoft_scuola_istituto_codice_fatturazione").val(msg.cod_uni_ou);
                jQuery("#madisoft_scuola_istituto_indirizzo").val(msg.Indirizzo);
                jQuery("#madisoft_scuola_istituto_pec").val(msg.pec);
                jQuery("#madisoft_scuola_istituto_email").val(msg.mail);
                jQuery("#madisoft_scuola_istituto_comune").val(msg.Comune);
                jQuery("#madisoft_scuola_istituto_cap").val(msg.Cap);
                jQuery("#madisoft_scuola_istituto_provincia").val(msg.Provincia);
                jQuery("#madisoft_scuola_istituto_nome").val(msg.des_amm);
                jQuery("#madisoft_scuola_istituto_dirigente").val(msg.cogn_resp + " " + msg.nome_resp);
                jQuery("#madisoft_scuola_istituto_telefono").val(msg.Tel + msg.tel_resp);
                jQuery("#madisoft_scuola_istituto_fax").val(msg.Fax);
            });
    });
});

function cambiaFontFamily($elemento){
    var $val = $elemento.val();
    var presenzaVirgola = $val.indexOf(",");
    var $description = $elemento.parents(".format-setting-wrap").children(".has-desc").children(".description");

    if (presenzaVirgola > 0 ){
        var $arrayValori = $val.split(",");
        var $FontFamily = "\'" + $arrayValori[0] + "\', " + $arrayValori[1];
        $description.css("font-family", $FontFamily);
    } else {
        $description.css("font-family", $val);
    }

}
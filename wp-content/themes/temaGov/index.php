<?php
madisoft_scuola_crea_struttura_superiore('home');
?>
<div id="accordion" <?php
if (PADDINGCLASS && !isFasciaTuttaLarghezza()) {
    echo ' style="padding-left: 15px"';
}
?>>
    <?php
    echo madisoft_stampa_fasce();
    ?>
</div>
<?php
madisoft_scuola_crea_struttura_inferiore('home');

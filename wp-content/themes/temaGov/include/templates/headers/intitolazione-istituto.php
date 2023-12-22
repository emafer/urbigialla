<?php
if (!isset($args)) {
    $args = [];
}
if (!isset($args['larghezzaIstituto'])) {
    $args['larghezzaIstituto'] = MadisoftScuolaWidth::MADISOFT_WIDTH_ALL;
}
    $mostraCerca = false;
    $larghezzaIstituto = $args['larghezzaIstituto'];
    if (madisoft_get_theme_option('madisoft_scuola_testata_cerca', 'off') == 'on') {
    $larghezzaIstituto = $larghezzaIstituto - 4;
    $mostraCerca = true;
    }
?>
<div class="logo_text col-sm-<?php echo $larghezzaIstituto; ?> centermobile">
            <h1><?php echo madisoft_get_theme_option('madisoft_scuola_istituto_nome', ''); ?></h1>
            <?php
            if (madisoft_get_theme_option('madisoft_scuola_testata_mostra_testata_comune', 'on') == 'on') {
                echo '<h2><span id="comuneIstituto">' . madisoft_get_theme_option('madisoft_scuola_istituto_comune', '') . '</span>'
                    . ' <span id="provinciaIstituto">(' .  madisoft_get_theme_option('madisoft_scuola_istituto_provincia', '') .')</span></h2>';
            }
            ?>
</div>
<?php
if ($mostraCerca) {
    echo '<div class="cercaHeader col-sm-4">';
    ?>
    <style>
        .menu-cerca-social_text {
            float: left;
            display: block;
            color #ffffff;
        }
        .menu-cerca-social_text p {
            color: #ffffff;
            margin-right: 5px;
        }
        .menu-cerca-social_icon {
            float: left;
        }
        .menu-cerca-social_icon img{
            width: 20px;
            margin-left: 5px;
        }
    </style>
    <?php
    get_template_part ( 'include/templates/menu-social', null, [
            'class' => 'menu-cerca-social'
    ]);
    ?>
    <div style="clear: both"></div>
    <?php
    get_template_part('searchform', null, ['id' => 'cercaInHeader']);
    echo '</div>';
}
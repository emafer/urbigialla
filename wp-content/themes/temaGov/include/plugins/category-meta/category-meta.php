<?php
/**************************************
 * STILE CATEGORIA
 **************************************/

/**
 * @param $tag
 */
function aggiungi_stile_categoria( $tag ) {
    $num_col = recuperaMetaCategoria($tag->term_id, 'numcol');
    $stile = recuperaMetaCategoria($tag->term_id, 'stile');
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="cat_meta_stile">Stile</label></th>
        <td>
            <table width="100%" border="0">
                <tr>
                    <td width="20%"><img src="<?php echo madisoft_scuola_get_assets_directory('img', true, 'stile1.png'); ?>" style="width: 100%"/></td>
                    <td width="20%"><img src="<?php echo madisoft_scuola_get_assets_directory('img', true, 'stile2.png'); ?>" style="width: 100%"/></td>
                    <td width="20%"><img src="<?php echo madisoft_scuola_get_assets_directory('img', true, 'stile3.png'); ?>" style="width: 100%"/></td>
                    <td width="20%"><img src="<?php echo madisoft_scuola_get_assets_directory('img', true, 'stile4.png'); ?>" style="width: 100%"/></td>
                    <td width="20%"><img src="<?php echo madisoft_scuola_get_assets_directory('img', true, 'stile99.png'); ?>" style="width: 100%"/></td>
                </tr>
                <tr>
                    <td width="20%"><input type="radio" name="Cat_meta[stile]"<?php if ($stile['stile'] == 1) {echo ' checked="checked"';} ?> value="1"/></td>
                    <td width="20%"><input type="radio" name="Cat_meta[stile]"<?php if ($stile['stile'] == 2) {echo ' checked="checked"';} ?> value="2"/></td>
                    <td width="20%"><input type="radio" name="Cat_meta[stile]"<?php if ($stile['stile'] == 3) {echo ' checked="checked"';} ?> value="3"/></td>
                    <td width="20%"><input type="radio" name="Cat_meta[stile]"<?php if ($stile['stile'] == 4) {echo ' checked="checked"';} ?> value="4"/></td>
                    <td width="20%"><input type="radio" name="Cat_meta[stile]"<?php if ($stile['stile'] == 99) {echo ' checked="checked"';} ?> value="99"/></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="cat_meta_stile2">Usa stile predefinito</label></th>
        <td>
            <input type="radio" id="cat_meta_stile2" name="Cat_meta[stile]"<?php if ($stile['stile'] == 'default') {echo ' checked="checked"';} ?> value="default"/>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="cat_meta_numcol">Numero colonne</label></th>
        <td>
            <input type="number" id="cat_meta_numcol" name="Cat_meta[numcol]" value="<?php echo $num_col['numcol']; ?>"/>
        </td>
    </tr>
    <?php
}
add_action ( 'category_edit_form_fields', 'aggiungi_stile_categoria');

/**************************************
 * IMMAGINE CATEGORIA
 **************************************/

/**
 * @param $tag
 */
function aggiungi_immagine_base_categoria( $tag ) {
    $cat_meta = recuperaMetaCategoria($tag->term_id);
    wp_enqueue_media();
    wp_register_script( 'jqueryUpload', madisoft_scuola_get_assets_directory( 'js', true ) . 'jqueryUpload.js', array( 'jquery' ) );
    wp_enqueue_script( 'jqueryUpload' );

    if ($cat_meta['img']) {
    ?>
    <tr class="form-field">
        <th><label>Immagine attuale</label></th>
        <td id="immagineAttuale">
                <img src="<?php echo $cat_meta['img']; ?>" width="150"/>
        </td>
    </tr>
        <?php
    }
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="Cat_meta_img">Immagine di base della categoria</label></th>
        <td>
            <input class="inputMedia" id="Cat_meta_img" type="hidden" name="Cat_meta[img]" value="<?php echo $cat_meta['img'];?>" />
            <input id="upload_media_button_Cat_meta_img" class="addMediaMadiButton" type="button" data-target="Cat_meta_img" value="Scegli immagine" />
        </td>
    </tr>
    <?php
        if ($cat_meta['img']) {
    ?>
        <tr class="form-field">
        <th scope="row" valign="top"><label for="killme_img">Rimuovi immagine</label></th>
        <td>
            <input type="checkbox" name="killme_img" id="killme_img"/>
        </td>
    </tr>
    <?php
    }
}

add_action ( 'category_edit_form_fields', 'aggiungi_immagine_base_categoria');

/**************************************
 * IMMAGINE CATEGORIA
 **************************************/

/**
 * @param $tag
 */
function aggiungi_colore_categoria( $tag ) {
    $cat_meta = recuperaMetaCategoria($tag->term_id, 'color');
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_style( 'wp-color-picker' );
    ?>
    <tr class="form-field term-colorpicker-wrap">
        <th scope="row"><label for="term-colorpicker">Severity Color</label></th>
        <td><script>
                jQuery( document ).ready( function( ) {

                    jQuery( '.colorpicker' ).wpColorPicker();

                } );
        </script>
            <input name="Cat_meta[color]" value="<?php echo $cat_meta['color']; ?>" class="colorpicker" id="term-colorpicker" />
        </td>
    </tr>
    <?php
}

add_action ( 'category_edit_form_fields', 'aggiungi_colore_categoria');


add_filter('manage_edit-category_columns', 'aggiungi_colonna_immagine');

function aggiungi_colonna_immagine($colonne)
{
    $colonne['immagineBase'] = 'Immagine';
    return $colonne;
}
add_filter('manage_category_custom_column', 'mostra_immagine_categoria', 10, 3);
function mostra_immagine_categoria($deprecated, $colonna, $id_categoria)
{
    switch ($colonna) {
        case 'immagineBase':
            $cat_meta = recuperaMetaCategoria($id_categoria);
            if ($cat_meta['img']) {
                echo '<img src="' . $cat_meta['img'] .'" width="150"/>';
            }
            break;
        default:
            break;
    }
}

add_action ( 'edited_category', 'save_extra_category_fileds');
// save extra category extra fields callback function
function save_extra_category_fileds( $term_id ) {
    if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
        foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key]) && $_POST['Cat_meta'][$key]) {
                $cat_meta[$key] = filter_var ( $_POST['Cat_meta'][$key], FILTER_SANITIZE_STRING);
            }
        }
        if (isset($_POST['killme_img'])) {
            $cat_meta['img'] = '';
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}

/**
 * @param $id_categoria
 * @return array
 */
function recuperaMetaCategoria($id_categoria, $meta = 'img'): array
{
    $cat_meta = get_option("category_$id_categoria");
    if (!$cat_meta) {
        $cat_meta = [];
    }
    if (!isset($cat_meta[$meta])) {
        $cat_meta[$meta] = '';
    }
    return $cat_meta;
}
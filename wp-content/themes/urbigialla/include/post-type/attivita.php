<?php
/********************
 * CREAZIONE POSTTYPE ATTIVITA
 **********************/
function add_attivita_post_type() {

// Set UI labels for Custom Post Type
    $labels = [
        'name'                => _x( 'Attivita\'', 'Post Type General Name', 'urbigialla' ),
        'singular_name'       => _x( 'Attivita\'', 'Post Type Singular Name', 'urbigialla' ),
        'menu_name'           => __( 'Attivit&agrave;', 'urbigialla' ),
        'all_items'           => __( 'Tutte le Attivit&agrave;', 'urbigialla' ),
        'view_item'           => __( 'Vedi Attivita\'', 'urbigialla' ),
        'add_new_item'        => __( 'Crea', 'urbigialla' ),
        'add_new'             => __( 'Crea', 'urbigialla' ),
        'edit_item'           => __( 'Modifica', 'urbigialla' ),
        'update_item'         => __( 'Aggiorna', 'urbigialla' ),
        'search_items'        => __( 'Cerca', 'urbigialla' ),
        'not_found'           => __( 'Non trovata', 'urbigialla' ),
        'not_found_in_trash'  => __( 'Non trovata nel cestino', 'urbigialla' ),
    ];

    $args = [
        'label'               => __( 'Attitiva\'', 'urbigialla' ),
        'description'         => __( 'le attivit&agrave;', 'urbigialla' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => ['title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields',],
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => ['att_categorie', 'att_luoghi'],
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    ];

    // Registering your Custom Post Type
    register_post_type( 'attivita', $args );

}
add_action( 'cmb2_init', 'cmb2_sample_metaboxes' );
add_action( 'init', 'add_attivita_post_type', 0 );
add_action( 'init', 'crea_term_attivita', 0 );
function cmb2_sample_metaboxes() {
    $prefix = '_attivita_meta_data_';
    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'dati_attivita',
        'title'         => 'Dati dell\'attivit&agrave;',
        'object_types'  => array( 'attivita', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
    $cmb->add_field( array(
        'name'             => 'Tipologia',
        'desc'             => '',
        'id'               => $prefix . 'tipologia',
        'type'             => 'select',
        'show_option_none' => true,
        'default'          => '',
        'options'          => array(
            'attcomm' => __( 'Att. commerciale', 'cmb2' ),
            'ass'   => __( 'Associazione', 'cmb2' ),
            'libero'     => __( 'Libero professionista', 'cmb2' ),
        ),
    ) );
    $cmb->add_field( array(
        'id'         => $prefix . 'descrizione_breve',
        'name'       => __( 'Descrizione breve *', 'design_scuole_italia' ),
        'desc'       => __( 'Sintetica descrizione del luogo (inferiore 160 caratteri)', 'design_scuole_italia' ),
        'type'       => 'textarea',
        'attributes'    => array(
            'maxlength'  => '160',
            'required'    => 'required'
        ),
    ) );
    $cmb->add_field( array(
        'id'         => $prefix . 'indirizzo',
        'name'       => __( 'Indirizzo  ', 'design_scuole_italia' ),
        'desc'       => __( 'Indirizzo del luogo.', 'design_scuole_italia' ),
        'type'       => 'text',
        'attributes' => array(
            'data-conditional-id'    => $prefix . 'childof',
            'data-conditional-value' => '0',
        ),
    ) );


    $cmb->add_field( array(
        'id'         => $prefix . 'posizione_gps',
        'name'       => __( 'Posizione GPS <br><small>NB: clicca sulla lente d\'ingrandimento e cerca l\'indirizzo, anche se lo hai già inserito nel campo precedente.<br>Questo permetterà una corretta georeferenziazione del luogo</small>', 'design_scuole_italia' ),
        'desc'       => __( 'Georeferenziazione del luogo e link a posizione in mappa.  .', 'design_scuole_italia' ),
        'type'       => 'leaflet_map',
        'attributes' => array(
            'searchbox_position'  => 'bottomright', // topright, bottomright, topleft, bottomleft,
            'search'              => __( 'Digita l\'indirizzo' , 'design_scuole_italia' ),
            'not_found'           => __( 'Indirizzo non trovato' , 'design_scuole_italia' ),
            'initial_coordinates' => [
                'lat' => 43.1966085,
                'lng' => 13.3765707 // Go Italy!
            ],
            'initial_zoom'        => 4, // Zoomlevel when there's no coordinates set,
            'default_zoom'        => 12, // Zoomlevel after the coordinates have been set & page saved
        )
    ) );

    $cmb->add_field( array(
        'id'         => $prefix . 'cap',
        'name'       => __( 'CAP ', 'design_scuole_italia' ),
        'desc'       => __( 'Codice di avviamento postale del luogo', 'design_scuole_italia' ),
        'type'       => 'text_small',
        'attributes' => array(
            'data-conditional-id'    => $prefix . 'childof',
            'data-conditional-value' => '0',
        ),
    ) );
//
//

    $cmb->add_field( array(
        'id'         => $prefix . 'email',
        'name'       => __( 'Riferimento mail', 'design_scuole_italia' ),
        'desc'       => __( 'Indirizzo di posta elettronica del luogo. ', 'design_scuole_italia' ),
        'type'       => 'text_email',
        /*'attributes' => array(
            'data-conditional-id'    => $prefix . 'childof',
            'data-conditional-value' => '0',
        ),*/
    ) );

    $cmb->add_field( array(
        'id'         => $prefix . 'cellulare',
        'name'       => __( 'Cellulare', 'design_scuole_italia' ),
        'desc'       => '' ,
        'type'       => 'text',
    ) );


    $cmb->add_field( array(
        'id'         => $prefix . 'telefono',
        'name'       => __( 'Riferimento telefonico ', 'design_scuole_italia' ),
        'desc'       => '',
        'type'       => 'text',
        /*
        'attributes' => array(
            'data-conditional-id'    => $prefix . 'childof',
            'data-conditional-value' => '0',
        ),
        */
    ) );


    $cmb->add_field( array(
        'id'         => $prefix . 'orario_pubblico',
        'name'       => __('Orario per il pubblico ', 'design_scuole_italia' ),
        'desc'       => __( 'Orario di apertura al pubblico del luogo.  ' ),
        'type'       => 'textarea_small'
    ) );

    $cmb->add_field( array(
        'id'         => $prefix . 'gallery',
        'name'       => __( 'Galleria', 'design_scuole_italia' ),
        'desc'       => __( 'Galleria di immagini', 'design_scuole_italia' ),
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array( 'type' => 'image' ), // Only images attachment
    ) );

    $cmb->add_field( array(
        'id'         => $prefix . 'video',
        'name'       => __( 'Video', 'design_scuole_italia' ),
        'desc'       => __( 'Inserisci la url di un servizio di streaming video (es: youtube, vimeo) - Qui la lista: <a href="https://codex.wordpress.org/Embeds">https://codex.wordpress.org/Embeds</a>', 'design_scuole_italia' ),
        'type' => 'oembed',

    ) );

    $cmb->add_field( array(
        'id'         => $prefix . 'info',
        'name'       => __( 'Ulteriori informazioni', 'design_scuole_italia' ),
        'desc'       => __( 'Ulteriori informazioni sul Servizio, FAQ ed eventuali riferimenti normativi.<br>Se si desidera inserire un video di YouTube è necessaria l\'opzione "Enable privacy-enhanced mode" che permette di pubblicare il video in modalità youtube-nocookie.', 'design_scuole_italia' ),
        'type'       => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
    ) );

}

function crea_term_attivita() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

    $labels = array(
        'name' => _x( 'Luoghi', 'taxonomy general name' ),
        'singular_name' => _x( 'Luoho', 'taxonomy singular name' ),
        'search_items' =>  __( 'Cerca' ),
        'all_items' => __( 'Tutti i Luoghi' ),
        'edit_item' => __( 'Modifica' ),
        'update_item' => __( 'Aggiorna' ),
        'add_new_item' => __( 'Crea' ),
        'new_item_name' => __( 'Nome' ),
        'menu_name' => __( 'Luoghi' ),
    );

    $labelsCat = array(
        'name' => _x( 'Categorie', 'taxonomy general name' ),
        'singular_name' => _x( 'Categoria', 'taxonomy singular name' ),
        'search_items' =>  __( 'Cerca' ),
        'all_items' => __( 'Tutte' ),
        'edit_item' => __( 'Modifica' ),
        'update_item' => __( 'Aggiorna' ),
        'add_new_item' => __( 'Crea' ),
        'new_item_name' => __( 'Nome' ),
        'menu_name' => __( 'Categorie' ),
    );
// Now register the taxonomy

    register_taxonomy('att_categorie',
        ['attivita'],
        [
            'hierarchical' => true,
            'labels' => $labelsCat,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => ['slug' => 'att_luoghi'],
        ]
    );
}

function aggiungi_immagine_base_categoria( $tag ) {
    $cat_meta = recuperaMetaCategoria($tag);

    wp_enqueue_media();
    wp_register_script( 'jqueryUpload', getAssetUri( 'js' ) . 'jqueryUpload.js', array( 'jquery' ) );
    wp_enqueue_script( 'jqueryUpload' );

    if ($cat_meta['img']) {
        ?>
        <tr class="form-field">
            <th><label>Immagine attuale</label></th>
            <td id="immagineAttuale">
                <img src="<?php echo $cat_meta['img']; ?>" style="width: 150px; max-width: 100%; height: auto"/>
            </td>
        </tr>
        <?php
    }
    ?>
    <tr class="form-field">
        <th scope="row"><label for="Cat_meta_img">Immagine di base della categoria</label></th>
        <td>
            <input class="inputMedia" id="Cat_meta_img" type="hidden" name="Cat_meta[img]" value="<?php echo $cat_meta['img'];?>" />
            <input id="upload_media_button_Cat_meta_img" class="addMediaMadiButton" type="button" data-target="Cat_meta_img" value="Scegli immagine" />
        </td>
    </tr>
    <?php
    if ($cat_meta['head_img']) {
        ?>
        <tr class="form-field">
            <th><label>Immagine attuale</label></th>
            <td id="immagineAttuale">
                <img src="<?php echo $cat_meta['head_img']; ?>" style="width: 150px; max-width: 100%; height: auto"/>
            </td>
        </tr>
        <?php
    }
    ?>
    <tr class="form-field">
        <th scope="row"><label for="Cat_meta_head_img">Immagine intestazione della categoria</label></th>
        <td>
            <input class="inputMedia" id="Cat_meta_head_img" type="hidden" name="Cat_meta[head_img]" value="<?php echo $cat_meta['head_img'];?>" />
            <input id="upload_media_button_Cat_meta_head_img" class="addMediaMadiButton" type="button" data-target="Cat_meta_head_img" value="Scegli immagine" />
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
    if ($cat_meta['head_img']) {
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="killme_head_img">Rimuovi immagine</label></th>
            <td>
                <input type="checkbox" name="killme_head_img" id="killme_head_img"/>
            </td>
        </tr>
        <?php
    }
}

add_action ( 'att_categorie_add_form_fields', 'aggiungi_immagine_base_categoria');
add_action ( 'att_categorie_edit_form_fields', 'aggiungi_immagine_base_categoria');
add_action ( 'edited_att_categorie', 'save_extra_category_fileds');

add_action ( 'att_luoghi_add_form_fields', 'aggiungi_immagine_base_categoria');
add_action ( 'att_luoghi_edit_form_fields', 'aggiungi_immagine_base_categoria');
add_action ( 'edited_att_luoghi', 'save_extra_category_fileds');

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
        if (isset($_POST['killme_head_img'])) {
            $cat_meta['head_img'] = '';
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}

/**
 * @param $tag
 */
function aggiungi_colore_categoria( $tag ) {
    $cat_meta = recuperaMetaCategoria($tag, 'color');
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_style( 'wp-color-picker' );
    ?>
    <tr class="form-field term-colorpicker-wrap">
        <th scope="row"><label for="term-colorpicker">Colore</label></th>
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

add_action ( 'att_categorie_add_form_fields', 'aggiungi_colore_categoria');
add_action ( 'att_categorie_edit_form_fields', 'aggiungi_colore_categoria');
add_filter('manage_edit-att_categorie_columns', 'aggiungi_colonna_immagine');
add_filter('manage_edit-att_luoghi_columns', 'aggiungi_colonna_immagine');
add_filter('manage_att_categorie_custom_column', 'mostra_immagine_categoria', 10, 3);
add_filter('manage_att_luoghi_custom_column', 'mostra_immagine_categoria', 10, 3);

function aggiungi_colonna_immagine($colonne)
{
    $colonne['immagineBase'] = 'Immagine';
    $colonne['coloreBase'] = 'Colore';
    return $colonne;
}
function mostra_immagine_categoria($deprecated, $colonna, $id_categoria)
{
    switch ($colonna) {
        case 'immagineBase':
            $cat_meta = recuperaMetaCategoriaDaId($id_categoria);
            if ($cat_meta['img']) {
                echo '<img src="' . $cat_meta['img'] .'"  style="width: 80px; max-width: 100%; height: auto"/>';
            }
            break;
        case 'coloreBase':
            $cat_meta = recuperaMetaCategoriaDaId($id_categoria);
            if ($cat_meta['color']) {
                echo '<div style="height: 20px; width: 20px; background-color: ' .$cat_meta['color'] . '">';
            }
            break;
        default:
            echo $colonna;
            break;
    }
}
function recuperaMetaCategoriaDaId(int $idCat) {
    $base =  getbaseCatMeta();
    $cat = get_option("category_" . $idCat);
    if ($cat) {
        $base ['img'] = (isset($cat['img']))? $cat['img'] : '';
        $base ['head_img'] = (isset($cat['head_img']))? $cat['head_img'] : '';
        $base ['color'] = (isset($cat['color']))? $cat['color'] : '';

    }
    return $base;
}

function getbaseCatMeta() :array
{
    return [
        'img' => '',
        'head_img' => '',
        'color' => ''
    ];
}
/**
 * @param WP_Term | string $tag
 * @param string $meta
 * @return array
 */
function recuperaMetaCategoria($tag, string $meta = 'img'): array
{
    $cat_meta = false;
    if ($tag instanceof WP_Term) {
        $cat_meta = recuperaMetaCategoriaDaId($tag->term_id);
    }

    if (!$cat_meta) {
        $cat_meta = getbaseCatMeta();
    }
    if (!isset($cat_meta[$meta])) {
        $cat_meta[$meta] = '';
    }
    return $cat_meta;
}


function crea_meta_box_attivita($post)
{
    $dati = get_post_meta( $post->ID, '_attivita_meta_data', true);
    $value = [];
    $value['tipologia'] = '';
    if (is_array($dati) && count($dati)) {
        $value = $dati;
        if (!isset($value['tipologia'])) {
            $value['tipologia'] = '';
        }
    }
    ?>
    <?php
}
function attivita_save_data( $post_id ) {
    if ( array_key_exists( 'attivita_meta_data', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_attivita_meta_data',
            $_POST['attivita_meta_data']
        );
    }
}
add_action( 'save_post', 'attivita_save_data' );



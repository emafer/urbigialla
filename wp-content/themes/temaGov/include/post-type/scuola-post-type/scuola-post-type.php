<?php
if (  madisoft_get_theme_option('madisoft_scuola_scuole_uso', 'on') == 'on'){
	add_action( 'init', 'scuola_init' );
}

function scuola_init() {
    $scuolaPostType = new ScuolaPostTypeGenerator( new MadisoftPostTypeClass(), new MadisoftThemeFieldCreateClass() );
    $scuolaOrdineTaxonomy = new ScuolaOrdineTaxonomie( $scuolaPostType );

    madisoft_get_theme_class()->addGlobalVar( 'scuola_post_type', $scuolaPostType );
    madisoft_get_theme_class()->addGlobalVar( 'scuola_ordine_taxonomy', $scuolaOrdineTaxonomy );
}

class ScuolaPostTypeGenerator extends MadisoftThemeCustomPostTypeExtendClass implements MadisoftPostTypeInterface
{

    function  __construct( \MadisoftPostTypeClass $PostTypeCLass, \MadisoftThemeFieldCreateClass $madisoftThemeFieldCreate ) {
        $this->setPosition( dirname( __FILE__ ) );
        $this->setPostTypeCLass( $PostTypeCLass );
        $this->setCreateFieldClass( $madisoftThemeFieldCreate );
        $this->setSlug( 'tutte_le_scuole' );
        $this->setPostTypeName( 'le_scuole' );
        $this->setPostTitle( 'Nome' );
        $this->getPostTypeCLass()->setShowInRest(true);
        $this->getPostTypeCLass()->setMenuPosition( 0 );
        $this->getPostTypeCLass()->setSlug( 'tutte_le_scuole' );
        $this->getPostTypeCLass()->setPostTypeName( 'le_scuole' );
        $this->getPostTypeCLass()->setSupportAuthor( true );
        $this->getPostTypeCLass()->setSupportPageAttributes( true);
        $this->setTemplatePages();
        $labels = [
            'name'=>_x('Scuole','madisoft_tema_scuola'),
            'singular_name'=>_x('Scuola','madisoft_tema_scuola'),
            'name_admin_bar'=>_x('Scuola','madisoft_tema_scuola'),
            'menu_name'=>_x('Scuole','madisoft_tema_scuola'),
            'all_items'=>_x('Tutte le Scuole','madisoft_tema_scuola'),
            'add_new'=>_x('Aggiungi una scuola','madisoft_tema_scuola'),
            'add_new_item'=>_x('Aggiungi una scuola','madisoft_tema_scuola'),
            'edit_item'=>_x('Modifica Scuola','madisoft_tema_scuola'),
            'new_item'=>_x('Nuova Scuola','madisoft_tema_scuola'),
            'view_item'=>_x('Visualizza Scuola','madisoft_tema_scuola'),
            'search_items'=>_x('Cerca Scuole','madisoft_tema_scuola'),
            'not_found'=>_x('nessun risultato :(','madisoft_tema_scuola'),
            'not_found_in_trash'=>_x('nessun risultato :(','madisoft_tema_scuola'),
            'parent_item_colon'=>_x('Parent page','madisoft_tema_scuola'),
        ];

        $this->getPostTypeCLass()->setLabels($labels);
        $this->getPostTypeCLass()->register_post_type();
        add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_styles' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_scuola_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_scuola_dati_aggiuntivi_meta_data' ) );

        add_filter( 'post_updated_messages', array( $this, 'scuola_tipologia_updated_messages' ) );
        add_action( 'do_meta_boxes', array( $this, 'change_image_box' ) );
        add_action( 'add_meta_boxes', array( $this, 'st_add_room_settings_box' ) );
        add_action( 'save_post', array( $this, 'st_room_save_postdata' ) );
        add_filter( "single_template", array( $this, "get_scuola_post_type_template" ) );

        add_action('manage_edit-le_scuole_sortable_columns', array( $this,'aggiungi_colonna_ordinamento_alle_sortable_columns'));
        add_action('manage_edit-le_scuole_columns', array( $this,'aggiungi_colonna_ordinamento'));
        add_action('manage_posts_custom_column', array( $this,'valore_colonna_ordinamento'));

    }
    function aggiungi_colonna_ordinamento_alle_sortable_columns( $columns ) {
        $columns['menu_order'] = 'Ordinamento';
        return $columns;
    }

    public function aggiungi_colonna_ordinamento($columns)
    {
        $columns['menu_order'] = "Ordinamento";
        return $columns;
    }

    public function valore_colonna_ordinamento($column)
    {
        global $post;
        switch ($column) {
            case 'menu_order':
                $ordinamento = $post->menu_order;
                echo $ordinamento;
                break;
        }
    }

    public function get_scuola_post_type_template( $single_template ) {
        global $post;

        if ( $post->post_type == 'le_scuole' ) {
            $single_template = dirname( __FILE__ ) . '/single.php';
        }

        return $single_template;
    }

    public function change_image_box() {
        remove_meta_box( 'postimagediv', 'le_scuole', 'side' );
        add_meta_box( 'postimagediv', 'Foto della scuola', 'post_thumbnail_meta_box', 'le_scuole', 'side', 'high' );
    }

    public function load_admin_styles() {
        wp_enqueue_style( 'admin_css_scuola', madisoft_scuola_get_assets_directory( 'post-type' ) . 'scuola-post-type/assets/admin/scuola.css', false, '1.0.0' );
    }

    public function scuola_dati_aggiuntivi_form() {
        global $post;
        $this->getCreateFieldClass()->addNoncefield( 'scuola_dati_aggiuntivi' );
        $form = [ ];
        $form = $this->settaIlForm( $post, $form );

        $this->getCreateFieldClass()->setListOfField( $form );
        $this->getCreateFieldClass()->scriviIlForm();
    }

    public function add_scuola_meta_boxes() {
        add_meta_box(
            'scuola_dati_aggiuntivi',
            'Dati scolastici',
            array( $this, 'scuola_dati_aggiuntivi_form' ),
            'le_scuole',
            'normal',
            'high'
        );

    }

    public function save_scuola_dati_aggiuntivi_meta_data( $id ) {
        global $post;
        $this->getCreateFieldClass()->addNoncefield( 'scuola_dati_aggiuntivi' );
        $form = [ ];
        $form = $this->settaIlForm( $post, $form );

        $this->getCreateFieldClass()->setListOfField( $form );
        $this->getCreateFieldClass()->salvaIlForm( $id );
    }

    public function scuola_tipologia_updated_messages( $messages ) {
        $post             = get_post();
        $post_type        = get_post_type( $post );
        $post_type_object = get_post_type_object( $post_type );

        $messages['le_scuole'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => __( 'Scuola modificata.', 'madisoft_scuola' ),
            2  => __( 'Campo modificato.', 'madisoft_scuola' ),
            3  => __( 'Campo eliminato.', 'madisoft_scuola' ),
            4  => __( 'Scuola modificata.', 'madisoft_scuola' ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Scuola ripristinata alla revisione del %s', 'madisoft_scuola' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Scuola pubblicata.', 'madisoft_scuola' ),
            7  => __( 'Scuola salvata.', 'madisoft_scuola' ),
            8  => __( 'Scuola inviata.', 'madisoft_scuola' ),
            9  => sprintf(
                __( 'La scuola sar&agrave; pubblicata il: <strong>%1$s</strong>.', 'madisoft_scuola' ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', 'madisoft_scuola' ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Bozza modificata.', 'madisoft_scuola' ),
        );
        if ( isset( $post->scuola_tipologia ) ) {
            if ( $post_type_object->publicly_queryable ) {
                $permalink = get_permalink( $post->ID );

                $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'Guarda scuola', 'madisoft_scuola' ) );
                $messages[ $post_type ][1] .= $view_link;
                $messages[ $post_type ][6] .= $view_link;
                $messages[ $post_type ][9] .= $view_link;

                $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
                $preview_link      = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Anteprima della scuola', 'madisoft_scuola' ) );
                $messages[ $post_type ][8] .= $preview_link;
                $messages[ $post_type ][10] .= $preview_link;
            }
        }

        return $messages;
    }

    /**
     * @param $post
     * @param $form
     *
     * @return array
     */
    protected function settaIlForm( $post, $form ) {
        $form[0]= [
            'dati_scolastici' => [
                0 => [
                    'id'             => 'scuola_codice_meccanografico',
                    'title'          => 'Codice Meccanografico',
                    'value'          => $this->getValueOfOption( $post, 'scuola_codice_meccanografico', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'htmlAttributes' => [
                        'maxlength' => 10,
                        'class'     => 'scuola_form',
                    ],
                ],
                1 => [
                    'id'             => 'scuola_responsabile',
                    'title'          => 'Responsabile di plesso',
                    'value'          => $this->getValueOfOption( $post, 'scuola_responsabile', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'htmlAttributes' => [
                        'class' => 'scuola_form',
                    ]
                ],
                2 => [
                    'id'             => 'scuola_responsabile_text',
                    'title'          => 'Descr. Responsabile',
                    'value'          => $this->getValueOfOption( $post, 'scuola_responsabile_text', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'htmlAttributes' => [
                        'placeholder' => 'Responsabile di plesso',
                        'class'       => 'scuola_form'
                    ]
                ],
            ]
        ];
        $form[1] = [
            'dati_di_contatto' => [
                0 => [
                    'id'             => 'scuola_telefono',
                    'title'          => 'Telefono',
                    'value'          => $this->getValueOfOption( $post, 'scuola_telefono', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'supertype'      => 'tel',
                    'htmlAttributes' => [
                        'class' => 'scuola_form',
                    ]
                ],
                1 => [
                    'id'             => 'scuola_fax',
                    'title'          => 'Fax',
                    'value'          => $this->getValueOfOption( $post, 'scuola_fax', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'supertype'      => 'tel',
                    'htmlAttributes' => [
                        'class' => 'scuola_form',
                    ]
                ],
                2 => [
                    'id'             => 'scuola_email',
                    'title'          => 'Email',
                    'value'          => $this->getValueOfOption( $post, 'scuola_email', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'supertype'      => 'email',
                    'htmlAttributes' => [
                        'class' => 'scuola_form',
                    ]
                ],
                3 => [
                    'id'             => 'scuola_via',
                    'title'          => 'Via',
                    'value'          => $this->getValueOfOption( $post, 'scuola_via', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'htmlAttributes' => [
                        'class' => 'scuola_form',
                    ]
                ],
                4 => [
                    'id'             => 'scuola_cap',
                    'title'          => 'CAP',
                    'value'          => $this->getValueOfOption( $post, 'scuola_cap', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'supertype'      => 'number',
                    'htmlAttributes' => [
                        'maxlength' => 6,
                        'class'     => 'scuola_form',
                    ],
                ],
                5 => [
                    'id'             => 'scuola_comune',
                    'title'          => 'Comune',
                    'value'          => $this->getValueOfOption( $post, 'scuola_comune', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'htmlAttributes' => [
                        'class' => 'scuola_form',
                    ]
                ],
                6 => [
                    'id'             => 'scuola_prov',
                    'title'          => '(PROV)',
                    'value'          => $this->getValueOfOption( $post, 'scuola_prov', true ),
                    'type'           => 'text',
                    'separator'      => '<br/>',
                    'htmlAttributes' => [
                        'maxlength' => 2,
                        'class'     => 'scuola_form',
                    ],
                ]
            ]
        ];
        if (possoMostrareLeNote() || possoMostrareGliOrari() || possoMostrareLeStrutture()){
            $datiDescrittivi =[];

            if (possoMostrareLeStrutture()) {
                $datiDescrittivi[] = [
                    'id' => 'scuola_strutture',
                    'title' => 'Strutture',
                    'value' => $this->getValueOfOption($post, 'scuola_strutture', true),
                    'type' => 'editor',
                    'separator' => '<br/>',
                    'htmlAttributes' => [
                        'class' => 'scuola_form',
                    ],
                ];
            }
            if (possoMostrareGliOrari()) {
                $datiDescrittivi[] = [
                    'id'             => 'scuola_orari',
                    'title'          => 'Orari',
                    'value'          => $this->getValueOfOption( $post, 'scuola_orari', true ),
                    'type'           => 'editor',
                    'separator'      => '<br/>',
                    'htmlAttributes' => [
                        'class' => 'scuola_form',
                    ],
                ];
            }

            if (possoMostrareLeNote()) {
                $datiDescrittivi[] = [
                    'id'             => 'scuola_note',
                    'title'          => 'Annotazioni',
                    'value'          => $this->getValueOfOption( $post, 'scuola_note', true ),
                    'type'           => 'editor',
                    'separator'      => '<br/>',
                    'htmlAttributes' => [
                        'class' => 'scuola_form',
                    ],
                ];
            }

            $form[] = ['dati_descrittivi' => $datiDescrittivi];
        }

        return $form;
    }

    /**
     * @param      $post
     *
     * @param      $id_of_option
     * @param bool $single
     *
     * @return mixed
     */
    protected function getValueOfOption( $post, $id_of_option, $single = false ) {
        if ( ! $post ) {
            return '';
        }

        return get_post_meta( $post->ID, $id_of_option, $single );
    }

    public function st_add_room_settings_box() {
        $screens = array( 'le_scuole' );
        foreach ( $screens as $screen ) {
            add_meta_box(
                'st_room_box_id',
                __( 'Servizi', 'madisoft_tema_scuola' ),
                array( $this, 'st_room_settings_box_content' ),
                $screen,
                'normal',
                'high'
            );
        }
    }

    public function st_room_settings_box_content( $post ) {


        // Use nonce for verification
        wp_nonce_field( plugin_basename( __FILE__ ), 'st_room_noncename' );

        $remove_txt = "Elimina";


        $args                = array( 'posts_per_page' => '-1' );
        $args['post_type']   = 'scuola_service';
        $args['orderby']     = 'post_title';
        $args['order']       = 'ASC';
        $args['post_status'] = 'publish';


        $new_query     = new WP_Query( $args );
        $room_services = $new_query->posts;

//         $room_services = get_posts($args);


        $meta_name = 'scuola_service';

        $services_included = get_post_meta( $post->ID, $meta_name, true );
        if ( empty( $services_included ) ) {
            $services_included = array();
        }

        ?>
        <style type="text/css">
            .services-available, .services-included {
                width: 45%;
            }

            .services-available {
                float: left;
            }

            .services-included {
                float: right;
            }

            .st-room-services .services-item li img {
                max-width:    36px;
                max-height:   36px;
                margin-right: 5px;
                float:        left;
            }

            .st-room-services .services-item li {
                background:    none repeat scroll 0 0 #F9F9F9;
                border:        1px solid #DFDFDF;
                border-radius: 3px 3px 3px 3px;
                box-shadow:    0 1px 0 #FFFFFF inset;
                display:       block;
                padding:       7px;
                margin:        5px 0px;
            }

            .st-room-services .services-item li .action {
                float: right;
            }

        </style>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                var s_meta_name =<?php echo json_encode($meta_name); ?>;
                var s_remove_txt =<?php echo json_encode($remove_txt); ?>;
                jQuery('.services-included-items').sortable();
                // for add new
                jQuery('.services-available-items li a').click(function () {
                    var li = jQuery(this).parents('li');
                    var sID = li.attr('service-id');
                    var html = li.html();
                    html = '<li id="svincid-' + sID + '" service-id="' + sID + '">' + html + '<input type="hidden" name="' + s_meta_name + '[' + sID + ']" value="' + sID + '"/></li>';

                    var c = jQuery('.services-included-items').append(html);
                    jQuery('.action', c).html(s_remove_txt);

                    li.hide();
                    return false;
                });

                // for remove
                jQuery('.services-included-items li a').on('click', function () {
                    var li = jQuery(this).parents('li');
                    var sID = li.attr('service-id');
                    jQuery('.services-available-items li#svaid-' + sID).show();
                    li.remove();
                    return false;
                });

            });

        </script>

        <div class="stpb_pd_w st-room-services">
            <div class="services-available">
                <h4>Servizi disponibili</h4>
                <ul class="services-item services-available-items">
                    <?php

                    foreach ( $room_services as $s ):
                        $thumb_url = '';
                        if ( has_post_thumbnail( $s->ID ) ) {
                            $thumb     = wp_get_attachment_image_src( get_post_thumbnail_id( $s->ID ), 'thumbnail_size' );
                            $thumb_url = $thumb['0'];
                        }
                        $style = '';
                        if ( isset( $services_included[ $s->ID ] ) && $services_included[ $s->ID ] != '' ) {
                            $style = ' style="display: none;"';
                        }
                        ?>
                        <li id="svaid-<?php echo $s->ID; ?>" service-id="<?php echo $s->ID; ?>"<?php echo $style; ?>>
                        <span class="room-service">
                        <?php if($thumb_url): ?>
                            <img src="<?php echo $thumb_url; ?>" alt="icon" />
                        <?php endif; ?>
                            <?php  echo   esc_html($s->post_title); ?></span>

                            <a href="#" class="action">Aggiungi</a>

                            <div style="clear:both"></div>
                        </li>
                    <?php endforeach; ?>

                </ul>
                <p>
                    <a href="<?php echo admin_url( 'post-new.php?post_type=scuola_service ' ); ?>" target="_blank">Crea Altri servizi</a>
                </p>
            </div>

            <div class="services-included">
                <h4>Servizi della scuola</h4>
                <ul class="services-item services-included-items">
                    <?php

                    foreach ( $room_services as $s ):
                        $thumb_url = '';
                        if ( has_post_thumbnail( $s->ID ) ) {
                            $thumb     = wp_get_attachment_image_src( get_post_thumbnail_id( $s->ID ), 'thumbnail_size' );
                            $thumb_url = $thumb['0'];
                        }
                        $style = '';
                        if ( isset( $services_included[ $s->ID ] ) && $services_included[ $s->ID ] != '' ) {

                            ?>
                            <li id="svincid-<?php echo $s->ID; ?>" service-id="<?php echo $s->ID; ?>"<?php echo $style; ?>>
                        <span class="room-service">
                        <?php if($thumb_url): ?>
                            <img src="<?php echo $thumb_url; ?>" alt="icon" />
                        <?php endif; ?>
                            <?php echo esc_html($s->post_title); ?></span>

                                <a href="#" class="action"><?php echo $remove_txt; ?></a>

                                <div style="clear:both"></div>
                                <input type="hidden" name="<?php echo $meta_name . '[' . $s->ID . ']'; ?>" value="<?php echo $s->ID; ?>" />
                            </li>
                        <?php
                        }

                    endforeach; ?>
                </ul>

            </div>


            <div style="clear: both;"></div>
        </div>

    <?php
    }

    public function st_room_save_postdata( $post_id ) {
        if ( isset( $_POST['post_type'] ) && 'le_scuole' != cleanGetPost($_POST['post_type']) ) {
            return;
    }
        // Secondly we need to check if the user intended to change this value.
        if ( ! isset( $_POST['st_room_noncename'] ) || ! wp_verify_nonce( $_POST['st_room_noncename'], plugin_basename( __FILE__ ) ) ) {
            return;
        }


        $scuola_service = isset( $_POST['scuola_service'] ) ? cleanGetPost($_POST['scuola_service']) : array();
        // for event meta
        update_post_meta( $post_id, 'scuola_service', $scuola_service );
}
}

class ScuolaOrdineTaxonomie extends MadisoftTaxonomyClass implements MadisoftTaxonomyInterface {
    public function __construct( $parentClass ) {
        $this->crea_scuola_ordine_taxonomies();
        $this->setPosition( dirname( __FILE__ ) );
        $this->setParentCustomPostTypeClass( $parentClass );
        $this->setTaxonomyName( 'scuola_ordine' );
        $this->getParentCustomPostTypeClass()->addTaxonomyChilds( 'scuola_ordine' );
        add_filter( "taxonomy_template", array( $this, "get_post_type_archive_template" ) );
        new MadisoftCustomTaxonomyFieldClass( 'scuola_ordine', 'scuola_ordine_order' );
    }

    public function crea_scuola_ordine_taxonomies() {
        $etichette = array(
            'name'                  => _x( 'Tipologie', 'taxonomy general name' ),
            'singular_name'         => _x( 'Tipologie   ', 'taxonomy singular name' ),
            'search_items'          => __( 'Cerca tipologie' ),
            'popular_items'         => __( 'tiplogie pi&ugrave; usati' ),
            'all_items'             => __( 'Tutti le tipologie' ),
            'parent_item'           => __( 'Macro tipologie' ),
            'parent_item_colon'     => __( 'Tipologie' ),
            'edit_item'             => __( 'Modifica tipologia' ),
            'update_item'           => __( 'Aggiorna tipologia' ),
            'add_new_item'          => __( 'Aggiungi una nuova tipologia' ),
            'new_item_name'         => __( 'Nuovo tipologia' ),
//        'separate_items_with_commas' => __( 'Separa i destinatri con le virgole' ),
            'add_or_remove_items'   => __( 'Aggiungi o rimuovi tipologie' ),
            'choose_from_most_used' => __( 'Scegli una delle tipologie pi&ugrave; usate' ),
            'not_found'             => __( 'Nessuna tipologia trovato.' ),
            'menu_name'             => __( 'Tipologie' ),
        );

        $args_scuola_ordine = array(
            'hierarchical'      => true,
            'labels'            => $etichette,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'          => true,
            'support'           => array( 'title' ),
            'query_var'         => true,
            'rewrite'           => array(
                'slug'       => 'ordine_scuola',
                'with_front' => true
            ),
            'public'            => true,
            'show_in_nav_menus' => true
        );

        register_taxonomy( 'scuola_ordine', array( 'le_scuole' ), $args_scuola_ordine );
    }
}

function getScuolaServiziPerScuola( $scuola_id, $display = false, $number_show = 'all' ) {

    $cache_key = 'scuola_servizi_' . $scuola_id . '_' . $number_show;

    $html = wp_cache_get( $cache_key );
    if ( $html == false ) {
        $html              = array();
        $services_included = get_post_meta( $scuola_id, 'scuola_service', true );
        $scuola_servizi    = false;
        if ( $services_included ) {

            $new_query = new WP_Query( array(
                'orderby'        => 'post__in',
                'order'          => '',
                'post__in'       => $services_included,
                'post_type'      => 'scuola_service',
                'post_status'    => 'publish',
                'posts_per_page' => '-1'
            ) );

            $scuola_servizi = $new_query->posts;
            if ( $scuola_servizi ) {
                foreach ( $scuola_servizi as $s ) {
                    $thumb_url = '';
                    if ( has_post_thumbnail( $s->ID ) ) {
                        $thumb     = wp_get_attachment_image_src( get_post_thumbnail_id( $s->ID ), 'thumbnail_size' );
                        $thumb_url = $thumb['0'];
                    }

                    $img   = ( $thumb_url != '' ) ? '<img src="' . $thumb_url . '" alt="icon" />  ' : '';
                    $title = get_the_title( $s->ID );
                    if ( $img ) {
                        $html[] = ' <li><a href="' . get_permalink( $s->ID ) . '" target="_blank"><span class="tooltip_1" href="#" title="' . esc_attr( $title ) . '">' . $img . '</span></a></li>';
                    }

                }

            }
        }

        if ( ! is_numeric( $number_show ) || $number_show == 'all' ) {

        } else {
            $number_show = intval( $number_show );
            if ( $number_show >= count( $html ) ) {

            } else {
                $html = array_slice( $html, 0, $number_show );
            }
        }

        $html = join( '', $html );
        if ( $html != '' ) {

            $html = ' <ul class="servizi"> ' . $html . '</ul>';

            wp_cache_set( $cache_key, $html );
        }

    }

    if ( $display ) {
        echo $html;

        return false;
    }

    return $html;
}

class ScuolaPost {
    protected $scuola;
    protected $email;
    protected $indirizzo;
    protected $responsabile;
    protected $descrizioneResponsabile;
    protected $telefono;
    protected $fax;
    protected $comune;
    protected $via;
    protected $cap;
    protected $orari;
    protected $servizi;
    protected $strutture;
    protected $annotazioni;

    /**
     * @return mixed
     */
    public function getOrari() {
        if ( ! $this->orari ) {
            $this->setOrari();
        }

        return $this->orari;
    }

    /**
     * @param mixed $orari
     */
    public function setOrari() {
        $this->orari = get_post_meta( $this->getScuola()->ID, 'scuola_orari', true );
    }

    /**
     * @return mixed
     */
    public function getServizi() {
        return $this->servizi;
    }

    /**
     * @param mixed $servizi
     */
    public function setServizi( $servizi ) {
        $this->servizi = $servizi;
    }

    /**
     * @return mixed
     */
    public function getStrutture() {
        if ( ! $this->strutture ) {
            $this->setStrutture();
        }

        return $this->strutture;
    }

    /**
     * @param mixed $strutture
     */
    public function setStrutture() {
        $this->strutture = get_post_meta( $this->getScuola()->ID, 'scuola_strutture', true );
    }

    /**
     * @return mixed
     */
    public function getAnnotazioni() {
        if ( ! $this->annotazioni ) {
            $this->setAnnotazioni();
        }

        return $this->annotazioni;
    }

    /**
     * @param mixed $annotazioni
     */
    public function setAnnotazioni() {
        $this->annotazioni = get_post_meta( $this->getScuola()->ID, 'scuola_note', true );
    }


    protected $provincia;

    function __construct( $postId = false ) {
        if ( ! $postId ) {
            throw new ParametroNonSettatoException( 'manca l\id del post' );
        }
        $this->setScuola( get_post( $postId ) );

    }

    /**
     * @return array
     * @throws MadisoftAssetRichiestaNonEsistenteException
     */
    public function getPrintOrder(){
        $posizione = [];
        $posizione_contenuto = (int) madisoft_get_theme_option('madisoft_scuola_scuole_ordine_contenuto', '1');
        $posizione_orari = (int) madisoft_get_theme_option('madisoft_scuola_scuole_ordine_orari', '2');
        $posizione_strutture = (int) madisoft_get_theme_option('madisoft_scuola_scuole_ordine_strutture', '3');
        $posizione_annotazioni = (int) madisoft_get_theme_option('madisoft_scuola_scuole_ordine_note', '4');
        $posizione_servizi = (int) madisoft_get_theme_option('madisoft_scuola_scuole_ordine_servizi', '5');
        $posizione_mappa = (int) madisoft_get_theme_option('madisoft_scuola_scuole_ordine_mappa', '6');

        $posizione[$posizione_contenuto][] = 'Contenuto';
        $posizione[$posizione_orari][] = 'Orari';
        $posizione[$posizione_strutture][] = 'Strutture';
        $posizione[$posizione_annotazioni][] = 'Annotazioni';
        $posizione[$posizione_servizi][] = 'Servizi';
        $posizione[$posizione_mappa][] = 'Mappa';
         ksort($posizione);

         return $posizione;
    }

    public function printContenutiScuola(){
        foreach ($this->getPrintOrder() as $contenutiDaProdurre){
            foreach ($contenutiDaProdurre as $contenuto){
                $methodName = 'Print' . $contenuto;
                $this->$methodName();
            }
        }
    }

    /**
     * @return null|WP_Post
     */
    public function getScuola() {
        return $this->scuola;
    }

    /**
     * @param null|WP_Post $scuola
     */
    public function setScuola( $scuola ) {
        $this->scuola = $scuola;
    }

    /**
     * @return mixed
     */
    public function getComune() {
        if ( ! $this->comune ) {
            $this->setComune();
        }

        return $this->comune;
    }

    /**
     * @param mixed $comune
     */
    public function setComune() {
        $this->comune = get_post_meta( $this->getScuola()->ID, 'scuola_comune', true );
    }

    /**
     * @return mixed
     */
    public function getVia() {
        if ( ! $this->via ) {
            $this->setVia();
        }

        return $this->via;
    }

    /**
     * @param mixed $via
     */
    public function setVia() {
        $this->via = get_post_meta( $this->getScuola()->ID, 'scuola_via', true );
    }

    /**
     * @return mixed
     */
    public function getCap() {
        if ( ! $this->cap ) {
            $this->setCap();
        }

        return $this->cap;
    }

    /**
     * @param mixed $cap
     */
    public function setCap() {
        $this->cap = get_post_meta( $this->getScuola()->ID, 'scuola_cap', true );;
    }

    /**
     * @return mixed
     */
    public function getProvincia() {
        return $this->provincia;
    }

    /**
     * @param mixed $provincia
     */
    public function setProvincia( $provincia ) {
        $this->provincia = $provincia;
    }

    /**
     * @return mixed
     */
    public function getIndirizzo() {
        if ( ! $this->indirizzo ) {
            $this->setIndirizzo();
        }

        return $this->indirizzo;
    }

    public function getIndirizzoPerMappa() {
        $indirizzo = $this->getVia() . ", " . $this->getComune() . ' ' . get_post_meta( $this->getScuola()->ID, 'scuola_prov', true );
        $indirizzo = str_replace( "\n", ' ', $indirizzo );
        $indirizzo = str_replace( "\r", ' ', $indirizzo );
        $indirizzo = str_replace( "\"", '', $indirizzo );

        return addslashes( $indirizzo );
    }

    /**
     * @param mixed $indirizzo
     */
    public function setIndirizzo() {
        $this->indirizzo = $this->getVia() . ", <br/>" . $this->getCap() . ' ' . $this->getComune() . ' ' . get_post_meta( $this->getScuola()->ID, 'scuola_prov', true );
    }

    /**
     * @return mixed
     */
    public function getResponsabile() {
        if ( ! $this->responsabile ) {
            $this->setResponsabile();
        }

        return $this->responsabile;
    }

    /**
     * @param mixed $responsabile
     */
    public function setResponsabile() {
		$responsabile = get_post_meta( $this->getScuola()->ID, 'scuola_responsabile', true );
        $this->responsabile = $responsabile;
    }

    /**
     * @return mixed
     */
    public function getDescrizioneResponsabile() {
        if ( ! $this->descrizioneResponsabile ) {
            $this->setDescrizioneResponsabile();
        }

        return $this->descrizioneResponsabile;
    }

    /**
     * @param mixed $descrizioneResponsabile
     */
    public function setDescrizioneResponsabile() {
		$responsabile = get_post_meta( $this->getScuola()->ID, 'scuola_responsabile_text', true );
		if (!$responsabile) {
			$responsabile = "Responsabile di plesso";
		}
        $this->descrizioneResponsabile = $responsabile;
    }

    /**
     * @return mixed
     */
    public function getTelefono() {
        if ( ! $this->telefono ) {
            $this->setTelefono();
        }

        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono() {
        $this->telefono = get_post_meta( $this->getScuola()->ID, 'scuola_telefono', true );
    }

    /**
     * @return mixed
     */
    public function getFax() {
        if ( ! $this->fax ) {
            $this->setFax();
        }

        return $this->fax;
    }

    /**
     * @param mixed $fax
     */
    public function setFax() {
        $this->fax = get_post_meta( $this->getScuola()->ID, 'scuola_fax', true );
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        if ( ! $this->email ) {
            $this->setEmail();
        }

        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail() {
        $this->email = get_post_meta( $this->getScuola()->ID, 'scuola_email', true );
    }

    public function printContatti() {
        $contatti = 0;
        if ( $this->getTelefono() ) {
            echo 'Telefono: ' . $this->getTelefono() . '<br/>';
            $contatti ++;
        }
        if ( $this->getFax() ) {
            echo 'Fax: ' . $this->getFax() . '<br/>';
            $contatti ++;
        }
        if ( $this->getEmail() ) {
            echo 'Email: ' . $this->getEmail() . '<br/>';
            $contatti ++;
        }

        if ( $contatti > 1 ) {
            echo '<br/>';
        }
    }

    /**
     *
     */
    public function printResponsabile() {
        if ( $this->getResponsabile() ) {
            echo $this->getDescrizioneResponsabile() . ": " . $this->getResponsabile();
        }
    }

    /**
     *
     */
    public function printContenuto(){
       echo madisoft_the_content();
    }

    /**
     * @throws ParametroNonSettatoException
     */
    public function printOrari() {
        if ( $this->getOrari() ) {
            echo $this->printSpecifiche( 'Gli Orari', 'orari', $this->getOrari() );
        }
    }

    /**
     * @throws ParametroNonSettatoException
     */
    public function printAnnotazioni() {
        if ( $this->getAnnotazioni() ) {
            echo $this->printSpecifiche( 'Note', 'note', $this->getAnnotazioni() );
        }
    }

    /**
     * @throws ParametroNonSettatoException
     */
    public function printStrutture() {
        if ( $this->getStrutture() && possoMostrareLeStrutture() ) {
            echo $this->printSpecifiche( 'Le strutture', 'strutture', $this->getStrutture() );
        }
    }

    /**
     * @return string
     */
    public function PrintServizi(){
	        if ( !possoMostrareIServizi() ) {
                return '';
            }
                ?>
                <div class="scuola_specifiche" id="i-nostri-servizi"><h5>I Nostri servizi:</h5>
                    <?php getScuolaServiziPerScuola( $this->getScuola()->ID, true, 'all' ); ?>
                    <div style="clear: both"></div>
                </div><!-- chiudo i servizi -->
            <?php
    }

    /**
     * @param $title
     * @param $id
     * @param $content
     * @return string
     * @throws ParametroNonSettatoException
     */
    protected function printSpecifiche( $title, $id, $content ) {
        if ( ! $title || ! $id || ! $content ) {
            throw new ParametroNonSettatoException( 'titolo' );
        }
        $content = apply_filters( 'the_content', $content );
        $content = str_replace( ']]>', ']]&gt;', $content );
        $html = '<div class="scuola_specifiche" id="' . $id . '"><h5>' . $title . '</h5>' . "\n"
                . $content
                . '</div>';

        return $html;
    }

    /**
     * @return string
     * @throws MadisoftAssetRichiestaNonEsistenteException
     */
    public function printMappa() {return '';
        if( madisoft_get_theme_option('madisoft_scuola_visualizza_mappa', 'on') == 'off' ){
            return '';
        }

        if ( $this->getVia() ) { ?>
            <div id="dove-siamo"><h5>Dove siamo:</h5>
			<iframe style="border: none;" src="//maps.google.com/maps?q=<?php echo stripslashes($this->getIndirizzoPerMappa()); ?>&output=embed" width="100%" height="400"></iframe>
	</div><!-- chiudi mappa -->
        <?php
        }

    }
}

function possoMostrareIServizi(){
    return ( madisoft_get_theme_option( 'madisoft_scuola_visualizza_servizi', 'on' ) == 'on' );
}

function possoMostrareLeNote(){
    return ( madisoft_get_theme_option( 'madisoft_scuola_visualizza_note', 'on' ) == 'on' );
}

function possoMostrareLeStrutture(){
    return ( madisoft_get_theme_option( 'madisoft_scuola_visualizza_Strutture', 'on' ) == 'on' );
}

function possoMostrareGliOrari(){
    return ( madisoft_get_theme_option( 'madisoft_scuola_visualizza_orari', 'on' ) == 'on' );
}

/**
 * @return bool
 * @throws MadisoftAssetRichiestaNonEsistenteException
 */
function usaPostStyleScuole()
{
    return madisoft_get_theme_option('madisoft_scuola_scuole_uso', 'on') == 'on';
}

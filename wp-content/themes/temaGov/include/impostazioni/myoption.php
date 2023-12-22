<?php
function myPlugin_admin_scripts() {
    if ( is_admin() ){ // for Admin Dashboard Only
        // Embed the Script on our Plugin's Option Page Only
        if ( isset($_GET['page']) && $_GET['page'] == 'madisoft_caratteri' ) {
            wp_enqueue_script('jquery');
            wp_enqueue_script( 'jquery-form' );
            wp_enqueue_script( 'admin-js-theme', madisoft_scuola_get_assets_directory( 'css' ) . 'admin-theme/js/bootstrap.min.js', array( 'jquery' )  );
            wp_enqueue_script( 'admin-js-theme' );
        }
    }
}
//add_action( 'admin_init', 'myPlugin_admin_scripts' );
//
//add_action( 'admin_menu', 'caratteri_menu_page');
function caratteri_menu_page() {

    add_menu_page(
        'Caratteri', // page <title>Title</title>
        'Caratteri', // menu link text
        'madisoft_manage_options', // capability to access the page
        'madisoft_caratteri', // page URL slug
        'gestioneCaratteri', // callback function /w content
        'dashicons-star-half', // menu icon
        5 // priority
    );
}
function gestioneCaratteri(){
   global $opzioneCaratteri;
   if (!current_user_can('madisoft_manage_options')) {
        wp_die('Unauthorized user');
    }

    $opzioneCaratteri = get_option('madisoft_caratteri');

    if (isset($_POST['caratteri'])) {
        $array = [
                'categoria-dimensione_titolo' => filter_var ( $_POST['caratteri']['categoria-dimensione_titolo'], FILTER_SANITIZE_STRING),
                'categoria-colore_titolo' => filter_var( $_POST['caratteri']['categoria-colore_titolo'], FILTER_SANITIZE_STRING),
                'categoria-stile-immagine' => filter_var( $_POST['caratteri']['categoria-stile-immagine'], FILTER_SANITIZE_STRING),
                'categoria-bordo' => filter_var( $_POST['caratteri']['categoria-bordo'], FILTER_SANITIZE_STRING),
                'arc_categoria-dimensione_titolo' => filter_var ( $_POST['caratteri']['arc_categoria-dimensione_titolo'], FILTER_SANITIZE_STRING),
                'arc_categoria-colore_titolo' => filter_var( $_POST['caratteri']['arc_categoria-colore_titolo'], FILTER_SANITIZE_STRING),
                'arc_categoria-stile-immagine' => filter_var( $_POST['caratteri']['arc_categoria-stile-immagine'], FILTER_SANITIZE_STRING),
                'arc_categoria-bordo' => filter_var( $_POST['caratteri']['arc_categoria-bordo'], FILTER_SANITIZE_STRING),
        ];
        update_option('madisoft_caratteri', $array);
        return ;
    }

    ?>
    <script>
        jQuery( document ).ready( function( ) {
            jQuery( '.colorpicker' ).wpColorPicker();
        } );

    </script>
    <div class="wrap">
        <form method="post" class="form-inline" id="myOptionsForm">
            <div class="container-fluid">
                <div class="row">
                    <div class="list-group col-md-2" id="myList" role="tablist" >
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#home" role="tab">Home</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#profile" role="tab">Caratteri della fascia</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#messages" role="tab">Messages</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#settings" role="tab">Settings</a>
                    </div>
                    <div class="tab-content col-md-10">
                        <div class="tab-pane active" id="home" role="tabpanel">1</div>
                        <div class="tab-pane" id="profile" role="tabpanel"><?php getFormFascia(); ?></div>
                        <div class="tab-pane" id="messages" role="tabpanel">3</div>
                        <div class="tab-pane" id="settings" role="tabpanel">4.</div>
                    </div>
                </div>
                <div style="clear: both">&nbsp;</div>
                <?php wp_nonce_field( 'wpshout_option_page_example_action' ); ?>
                <div class="row">
                    <input type="submit" value="Save" class="button button-primary button-large">
                </div>
            </div>
        </form>
        <div id="saveResult"></div>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#myList a:last-child').tab('show');
                jQuery('#myOptionsForm').submit(function() {
                    jQuery(this).ajaxSubmit({
                        success: function(){
                            jQuery('#saveResult').html("<div id='saveMessage' class='successModal'></div>");
                            jQuery('#saveMessage').append("<p><?php echo htmlentities(__('Settings Saved Successfully','wp'),ENT_QUOTES); ?></p>").show();
                        },
                        timeout: 5000
                    });
                    setTimeout("jQuery('#saveMessage').hide('slow');", 1000);
                    return false;
                });
            });
        </script>
        <style>
            img {
                max-width: 100%;
                height: auto;
            }
            .successModal {
                display: block;
                position: fixed;
                top: 45%;
                left: 25%;
                width: 300px;
                height: auto;
                padding: 5px 20px;
                border: 3px solid green;
                background-color: #EFE;
                z-index:1002;
                overflow: auto;
                -moz-border-radius: 15px;
                -webkit-border-radius: 15px;
                -moz-box-shadow: 5px 5px 10px #cfcfcf;
                -webkit-box-shadow: 5px 5px 10px #cfcfcf;
            }
        </style>
    </div>
        <?php
    wp_enqueue_script( 'wp-color-picker' );
}

function madisoft_caratteri_getTextValue($id, $default= '')
{
    global $opzioneCaratteri;
    if (!isset($opzioneCaratteri[$id])) {
        return $default;
    }

    return $opzioneCaratteri[$id];
}

function getFormFascia() {
    ?>
    <div class="accordion" id="CategoriaAcc">
        <div class="card" style="padding: 0; margin-top: 0; max-width: 100%;">
            <div class="card-header" id="headCategoria">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseCategoria" aria-expanded="false" aria-controls="collapseCategoria">
                        Categoria
                    </button>
                </h2>
            </div>
            <div id="collapseCategoria" class="collapse" aria-labelledby="headCategoria" data-parent="#CategoriaAcc">
                <div class="card-body">
                    <div class="form-group  row">
                        <label for="categoria-dimensione_titolo" class="col-sm-2 col-form-label"><strong>Dimensione Titolo</strong></label>
                        <div class="col-sm-10">
                            <input value="<?php echo madisoft_caratteri_getTextValue('categoria-dimensione_titolo'); ?>" name="caratteri[categoria-dimensione_titolo]" type="text" class="form-control-plaintext" id="categoria-dimensione_titolo" aria-describedby="Dimensione Titolo">
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="categoria-colore_titolo" class="col-sm-2 col-form-label"><strong>Colore Titolo</strong></label>
                        <div class="col-sm-10">
                            <input value="<?php echo madisoft_caratteri_getTextValue('categoria-colore_titolo'); ?>" name="caratteri[categoria-colore_titolo]" type="text" id="categoria-colore_titolo" aria-describedby="Colore Titolo" class="colorpicker">
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="categoria-stile-immagine" class="col-sm-2 col-form-label"><strong>Stile Immagine</strong></label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="categoria-stile-immagine-1"><img src="https://picsum.photos/160/90" alt="16/9"/> 16/9</label>
                                    <input value="1" <?php if (madisoft_caratteri_getTextValue('categoria-stile-immagine', 1) == 1) { echo 'checked="checked" ';} ?> name="caratteri[categoria-stile-immagine]" type="radio" class="form-control" id="categoria-stile-immagine-1" aria-describedby="16/9">
                                </div>
                                <div class="col-md-12">
                                    <label for="categoria-stile-immagine-2"><img src="https://picsum.photos/120/90" alt="4/3"/><br/> 4:3</label>
                                    <input value="2" <?php if (madisoft_caratteri_getTextValue('categoria-stile-immagine', 1) == 2) { echo 'checked="checked" ';} ?> name="caratteri[categoria-stile-immagine]" type="radio" class="form-control" id="categoria-stile-immagine-2" aria-describedby="4:3">
                                </div>
                                <div class="col-md-12">
                                    <label for="categoria-stile-immagine-3"><img src="https://picsum.photos/90/90" alt="1:1"/> 1:1</label>
                                    <input value="3" <?php if (madisoft_caratteri_getTextValue('categoria-stile-immagine', 1) == 3) { echo 'checked="checked" ';} ?> name="caratteri[categoria-stile-immagine]" type="radio" class="form-control" id="categoria-stile-immagine-3" aria-describedby="1:1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="categoria-bordo" class="col-sm-2 col-form-label"><strong>Bordo?</strong></label>
                        <div class="col-sm-10">
                            <select name="caratteri[categoria-bordo]" class="form-control" id="categoria-bordo" aria-describedby="uso del bordo">
                                <option value="1"<?php if (madisoft_caratteri_getTextValue('categoria-bordo', 1) == 1) { echo ' selected="selected" ';} ?>>SI</option>
                                <option value="0"<?php if (madisoft_caratteri_getTextValue('categoria-bordo', 1) == 0) { echo ' selected="selected" ';} ?>>NO</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="padding: 0; margin-top: 0; max-width: 100%">
            <div class="card-header" id="headArcCategoria">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseArcCategoria" aria-expanded="false" aria-controls="collapseArcCategoria">
                        Archivio Categoria
                    </button>
                </h2>
            </div>
            <div id="collapseArcCategoria" class="collapse" aria-labelledby="headArcCategoria" data-parent="#CategoriaAcc">
                <div class="card-body">
                    <div class="form-group  row">
                        <label for="categoria-dimensione_titolo" class="col-sm-2 col-form-label"><strong>Dimensione Titolo</strong></label>
                        <div class="col-sm-10">
                            <input value="<?php echo madisoft_caratteri_getTextValue('arc_categoria-dimensione_titolo'); ?>" name="caratteri[arc_categoria-dimensione_titolo]" type="text" class="form-control-plaintext" id="arc_categoria-dimensione_titolo" aria-describedby="Dimensione Titolo">
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="arc_categoria-colore_titolo" class="col-sm-2 col-form-label"><strong>Colore Titolo</strong></label>
                        <div class="col-sm-10">
                            <input value="<?php echo madisoft_caratteri_getTextValue('arc_categoria-colore_titolo'); ?>" name="caratteri[arc_categoria-colore_titolo]" type="text" id="arc_categoria-colore_titolo" aria-describedby="Colore Titolo" class="colorpicker">
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="arc_categoria-stile-immagine" class="col-sm-2 col-form-label"><strong>Stile Immagine</strong></label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="arc_categoria-stile-immagine-1"><img src="https://picsum.photos/160/90" alt="16/9"/> 16/9</label>
                                    <input value="1" <?php if (madisoft_caratteri_getTextValue('arc_categoria-stile-immagine', 1) == 1) { echo 'checked="checked" ';} ?> name="caratteri[arc_categoria-stile-immagine]" type="radio" class="form-control" id="arc_categoria-stile-immagine-1" aria-describedby="16/9">
                                </div>
                                <div class="col-md-12">
                                    <label for="arc_categoria-stile-immagine-2"><img src="https://picsum.photos/120/90" alt="4/3"/><br/> 4:3</label>
                                    <input value="2" <?php if (madisoft_caratteri_getTextValue('arc_categoria-stile-immagine', 1) == 2) { echo 'checked="checked" ';} ?> name="caratteri[arc_categoria-stile-immagine]" type="radio" class="form-control" id="arc_categoria-stile-immagine-2" aria-describedby="4:3">
                                </div>
                                <div class="col-md-12">
                                    <label for="arc_categoria-stile-immagine-3"><img src="https://picsum.photos/90/90" alt="1:1"/> 1:1</label>
                                    <input value="3" <?php if (madisoft_caratteri_getTextValue('arc_categoria-stile-immagine', 1) == 3) { echo 'checked="checked" ';} ?> name="caratteri[arc_categoria-stile-immagine]" type="radio" class="form-control" id="arc_categoria-stile-immagine-3" aria-describedby="1:1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  row">
                        <label for="arc_categoria-bordo" class="col-sm-2 col-form-label"><strong>Bordo?</strong></label>
                        <div class="col-sm-10">
                            <select name="caratteri[arc_categoria-bordo]" class="form-control" id="arc_categoria-bordo" aria-describedby="uso del bordo">
                                <option value="1"<?php if (madisoft_caratteri_getTextValue('arc_categoria-bordo', 1) == 1) { echo ' selected="selected" ';} ?>>SI</option>
                                <option value="0"<?php if (madisoft_caratteri_getTextValue('arc_categoria-bordo', 1) == 0) { echo ' selected="selected" ';} ?>>NO</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
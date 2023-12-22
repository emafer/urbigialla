<?php
/*
Plugin Name: Madisoft Aggiorna Url
Description: mi pare chiaro
*/
if ( !function_exists( 'add_action' ) ) {
    exit;
}
function madisoft_gestione_url_aggiungi_pagina(){
    add_management_page("Aggiorna URLs", "Aggiorna url", "manage_options", basename(__FILE__), "madisoft_gestion_url_page");
}
function madisoft_gestion_url_page(){
    if ( !function_exists('madisoft_aggiorna_url') ) {
        function madisoft_aggiorna_url($options, $oldurl, $newurl, $eUnDominio){
            global $wpdb;
            global $table_prefix;
            $tabella_albo = $table_prefix .  'pa_albopretorio';
            $results = array();
            $queries = array(
                'content' =>		array("UPDATE $wpdb->posts SET post_content = replace(post_content, %s, %s)",  'Contenuti' ),
                'excerpts' =>		array("UPDATE $wpdb->posts SET post_excerpt = replace(post_excerpt, %s, %s)", 'Riassunti' ),
                'attachments' =>	array("UPDATE $wpdb->posts SET guid = replace(guid, %s, %s) WHERE post_type = 'attachment'",  'Allegati' ),
                'links' =>			array("UPDATE $wpdb->links SET link_url = replace(link_url, %s, %s)", 'Link' ),
                'custom' =>			array("UPDATE $wpdb->postmeta SET meta_value = replace(meta_value, %s, %s)",  'Campi personalizzati' ),
                'guids' =>			array("UPDATE $wpdb->posts SET guid = replace(guid, %s, %s)",  'Guid' ),
                'albo' =>			array("UPDATE $tabella_albo SET descrizione = replace(descrizione, %s, %s)",  'Abo pretorio' )
            );
            $results = [];
            foreach($options as $option){
                switch ($option){
                    case 'custom':
                        $results = modificaUrlCustom($oldurl, $newurl, $wpdb, $queries, $option, $results);
                        break;
                    case 'options':
                        $result = cambiaOpzioni($oldurl, $newurl, $wpdb->options, $eUnDominio, true);
                        $results['options'] = [$result, 'opzioni modificate'];
                        break;
                    default:
                        $wpdb->prepare( $queries[$option][0], $oldurl, $newurl);
                        $result = $wpdb->query( $wpdb->prepare( $queries[$option][0], $oldurl, $newurl) );
                        $results[$option] = array($result, $queries[$option][1]);
                        break;
                }
            }
            return $results;
        }

        /**
         * @param $oldurl
         * @param $newurl
         * @param $wpdb
         * @param $queries
         * @param $option
         * @param $results
         * @return mixed
         */
        function modificaUrlCustom($oldurl, $newurl, $wpdb, $queries, $option, $results)
        {
            $n = 0;
            $row_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->postmeta");
            $page_size = 10000;
            $pages = ceil($row_count / $page_size);

            for ($page = 0; $page < $pages; $page++) {
                $current_row = 0;
                $start = $page * $page_size;
                $end = $start + $page_size;
                $pmquery = "SELECT * FROM $wpdb->postmeta WHERE meta_value <> ''";
                $items = $wpdb->get_results($pmquery);
                foreach ($items as $item) {
                    $value = $item->meta_value;
                    if (trim($value) == '')
                        continue;

                    $edited = VB_unserialize_replace($oldurl, $newurl, $value);

                    if ($edited != $value) {
                        $fix = $wpdb->query("UPDATE $wpdb->postmeta SET meta_value = '" . $edited . "' WHERE meta_id = " . $item->meta_id);
                        if ($fix)
                            $n++;
                    }
                }
            }
            $results[$option] = array($n, $queries[$option][1]);
            return $results;
        }
    }
    if ( !function_exists( 'VB_unserialize_replace' ) ) {
        function VB_unserialize_replace( $from = '', $to = '', $data = '', $serialised = false ) {
            try {
                if ( false !== is_serialized( $data ) ) {
                    $unserialized = unserialize( $data );
                    $data = VB_unserialize_replace( $from, $to, $unserialized, true );
                }
                elseif ( is_array( $data ) ) {
                    $_tmp = array( );
                    foreach ( $data as $key => $value ) {
                        $_tmp[ $key ] = VB_unserialize_replace( $from, $to, $value, false );
                    }
                    $data = $_tmp;
                    unset( $_tmp );
                }
                else {
                    if ( is_string( $data ) )
                        $data = str_replace( $from, $to, $data );
                }
                if ( $serialised )
                    return serialize( $data );
            } catch( Exception $error ) {
            }
            return $data;
        }
    }
    if ( isset( $_POST['VBUU_settings_submit'] ) && !check_admin_referer('VBUU_submit','VBUU_nonce')){
        if(isset($_POST['VBUU_oldurl']) && isset($_POST['VBUU_newurl'])){
            if(function_exists('esc_attr')){
                $vbuu_oldurl = esc_attr(trim($_POST['VBUU_oldurl']));
                $vbuu_newurl = esc_attr(trim($_POST['VBUU_newurl']));
            }else{
                $vbuu_oldurl = attribute_escape(trim($_POST['VBUU_oldurl']));
                $vbuu_newurl = attribute_escape(trim($_POST['VBUU_newurl']));
            }
        }
        echo '<div id="message" class="error fade"><p><strong>'.__('ERROR','velvet-blues-update-urls').' - '.__('Please try again.','velvet-blues-update-urls').'</strong></p></div>';
    }
    elseif( isset( $_POST['VBUU_settings_submit'] ) && !isset( $_POST['VBUU_update_links'] ) ){
        if(isset($_POST['VBUU_oldurl']) && isset($_POST['VBUU_newurl'])){
            if(function_exists('esc_attr')){
                $vbuu_oldurl = esc_attr(trim($_POST['VBUU_oldurl']));
                $vbuu_newurl = esc_attr(trim($_POST['VBUU_newurl']));
            }else{
                $vbuu_oldurl = attribute_escape(trim($_POST['VBUU_oldurl']));
                $vbuu_newurl = attribute_escape(trim($_POST['VBUU_newurl']));
            }
        }
        echo '<div id="message" class="error fade"><p><strong>'.__('ERROR','velvet-blues-update-urls').' - '.__('Your URLs have not been updated.','velvet-blues-update-urls').'</p></strong><p>'.__('Please select at least one checkbox.','velvet-blues-update-urls').'</p></div>';
    }
    elseif( isset( $_POST['VBUU_settings_submit'] ) ){
        $vbuu_update_links = $_POST['VBUU_update_links'];
        if(isset($_POST['VBUU_oldurl']) && isset($_POST['VBUU_newurl'])){
            if(function_exists('esc_attr')){
                $vbuu_oldurl = esc_attr(trim($_POST['VBUU_oldurl']));
                $vbuu_newurl = esc_attr(trim($_POST['VBUU_newurl']));
            }else{
                $vbuu_oldurl = esc_attr(trim($_POST['VBUU_oldurl']));
                $vbuu_newurl = esc_attr(trim($_POST['VBUU_newurl']));
            }
        }
        $eUnDominio = esc_attr(trim($_POST['dominio']));
        if(($vbuu_oldurl && $vbuu_oldurl != 'http://www.oldurl.com' && trim($vbuu_oldurl) != '') && ($vbuu_newurl && $vbuu_newurl != 'http://www.newurl.com' && trim($vbuu_newurl) != '')){
            $results = madisoft_aggiorna_url($vbuu_update_links,$vbuu_oldurl,$vbuu_newurl, $eUnDominio);
            $empty = true;
            $emptystring = '<strong>'.__('Why do the results show 0 URLs updated?','velvet-blues-update-urls').'</strong><br/>'.__('This happens if a URL is incorrect OR if it is not found in the content. Check your URLs and try again.','velvet-blues-update-urls').'<br/><br/><strong>'.__('Want us to do it for you?','velvet-blues-update-urls').'</strong><br/>'.__('Contact us at','velvet-blues-update-urls').' <a href="mailto:info@velvetblues.com?subject=Move%20My%20WP%20Site">info@velvetblues.com</a>. '.__('We will backup your website and move it for $65 OR simply update your URLs for only $29.','velvet-blues-update-urls');

            $resultstring = '';
            foreach($results as $result){
                $empty = ($result[0] != 0 || $empty == false)? false : true;
                $resultstring .= '<br/><strong>'.$result[0].'</strong> '.$result[1];
            }

            if( $empty ):
                ?>
                <div id="message" class="error fade">
                <table>
                <tr>
                <td><p><strong>
                    <?php _e('ERROR: Something may have gone wrong.','velvet-blues-update-urls'); ?>
                </strong><br/>
                <?php _e('Your URLs have not been updated.','velvet-blues-update-urls'); ?>
            </p>
                <?php
            else:
                ?>
                <div id="message" class="updated fade">
                <table>
                <tr>
                <td><p><strong>
                    <?php _e('Success! Your URLs have been updated.','velvet-blues-update-urls'); ?>
                </strong></p>
                <?php
            endif;
            ?>
            <p><u>
                    <?php _e('Results','velvet-blues-update-urls'); ?>
                </u><?php echo $resultstring; ?></p>
            <?php echo ($empty)? '<p>'.$emptystring.'</p>' : ''; ?></td>
            <td width="60"></td>
            <td align="center"><?php if( !$empty ): ?>
                    <p>
                        <?php //You can now uninstall this plugin.<br/> ?>
                        <?php printf(__('If you found our plugin useful, %s please consider donating','velvet-blues-update-urls'),'<br/>'); ?>.</p>
                    <p><a style="outline:none;" href="http://www.velvetblues.com/go/updateurlsdonate/" target="_blank"><img src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" alt="PayPal -<?php _e('The safer, easier way to pay online!','velvet-blues-update-urls'); ?>"></a></p>
                <?php endif; ?></td>
            </tr>
            </table>
            </div>
            <?php
        }
        else{
            echo '<div id="message" class="error fade"><p><strong>'.__('ERROR','velvet-blues-update-urls').' - '.__('Your URLs have not been updated.','velvet-blues-update-urls').'</p></strong><p>'.__('Please enter values for both the old url and the new url.','velvet-blues-update-urls').'</p></div>';
        }
    }
    ?>
    <div class="wrap">
    <h2>Velvet Blues Update URLs</h2>
    <form method="post" action="tools.php?page=<?php echo basename(__FILE__); ?>">
        <?php wp_nonce_field('VBUU_submit','VBUU_nonce'); ?>
        <p><?php printf(__("After moving a website, %s lets you fix old URLs in content, excerpts, links, and custom fields.",'velvet-blues-update-urls'),'<strong>Update URLs</strong>'); ?></p>
        <p><strong>
                <?php _e('WE RECOMMEND THAT YOU BACKUP YOUR WEBSITE.','velvet-blues-update-urls'); ?>
            </strong><br/>
            <?php _e('You may need to restore it if incorrect URLs are entered in the fields below.','velvet-blues-update-urls'); ?>
        </p>
        <h3 style="margin-bottom:5px;">
            <?php _e('Step'); ?>
            1:
            <?php _e('Enter your URLs in the fields below','velvet-blues-update-urls'); ?>
        </h3>
        <?php
        $urlAttuale = str_replace('http://', '', get_bloginfo( 'url' ));
        $nuovoUrl = str_replace('scuoletest.madisoft', 'edu', $urlAttuale);

        ?>
        <table class="form-table">
            <tr valign="middle">
                <th scope="row" width="140" style="width:140px"><strong>
                        <?php _e('Old URL','velvet-blues-update-urls'); ?>
                    </strong><br/>
                    <span class="description">
						<?php _e('Old Site Address','velvet-blues-update-urls'); ?>
						</span></th>
                <td><input name="VBUU_oldurl" type="text" id="VBUU_oldurl" value="<?php echo (isset($vbuu_oldurl) && trim($vbuu_oldurl) != '')? $vbuu_oldurl : $urlAttuale; ?>" style="width:300px;font-size:20px;" onfocus="if(this.value=='http://www.oldurl.com') this.value='';" onblur="if(this.value=='') this.value='http://www.oldurl.com';" /></td>
            </tr>
            <tr valign="middle">
                <th scope="row" width="140" style="width:140px"><strong>
                        <?php _e('New URL','velvet-blues-update-urls'); ?>
                    </strong><br/>
                    <span class="description">
						<?php _e('New Site Address','velvet-blues-update-urls'); ?>
						</span></th>
                <td><input name="VBUU_newurl" type="text" id="VBUU_newurl" value="<?php echo (isset($vbuu_newurl) && trim($vbuu_newurl) != '')? $vbuu_newurl : $nuovoUrl; ?>" style="width:300px;font-size:20px;" onfocus="if(this.value=='http://www.newurl.com') this.value='';" onblur="if(this.value=='') this.value='http://www.newurl.com';" /></td>
            </tr>
        </table>
        <br/>
        <h3 style="margin-bottom:5px;">
            <?php _e('Step'); ?>
            2:
            <?php _e('Choose which URLs should be updated','velvet-blues-update-urls'); ?>
        </h3>
        <table class="form-table">
            <tr>
                <td><p style="line-height:20px;">
                        <input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true" value="content" checked="checked" />
                        <label for="VBUU_update_true"><strong>
                                <?php _e('URLs in page content','velvet-blues-update-urls'); ?>
                            </strong> (
                            <?php _e('posts, pages, custom post types, revisions','velvet-blues-update-urls'); ?>
                            )</label>
                        <br/>
                        <input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true1" value="excerpts" checked="checked"/>
                        <label for="VBUU_update_true1"><strong>
                                <?php _e('URLs in excerpts','velvet-blues-update-urls'); ?>
                            </strong></label>
                        <br/>
                        <input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true2" value="links" checked="checked"/>
                        <label for="VBUU_update_true2"><strong>
                                <?php _e('URLs in links','velvet-blues-update-urls'); ?>
                            </strong></label>
                        <br/>
                        <input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true3" value="attachments" checked="checked"/>
                        <label for="VBUU_update_true3"><strong>
                                <?php _e('URLs for attachments','velvet-blues-update-urls'); ?>
                            </strong> (
                            <?php _e('images, documents, general media','velvet-blues-update-urls'); ?>
                            )</label>
                        <br/>
                        <input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true4" value="custom" checked="checked"/>
                        <label for="VBUU_update_true4"><strong>
                                <?php _e('URLs in custom fields and meta boxes','velvet-blues-update-urls'); ?>
                            </strong></label>
                        <br/>
                        <input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true8" value="albo" checked="checked"/>
                        <label for="VBUU_update_true8"><strong>Albo pretorio</strong></label>
                        <br/>
                        <input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true5" value="guids" checked="checked"/>
                        <label for="VBUU_update_true5"><strong>
                                <?php _e('Update ALL GUIDs','velvet-blues-update-urls'); ?>
                            </strong> <span class="description" style="color:#f00;">
								<?php _e('GUIDs for posts should only be changed on development sites.','velvet-blues-update-urls'); ?>
								</span> <a href="http://codex.wordpress.org/Changing_The_Site_URL#Important_GUID_Note" target="_blank">
                                <?php _e('Learn More.','velvet-blues-update-urls'); ?>
                            </a></label>
                        <br/>
                        <input name="VBUU_update_links[]" type="checkbox" id="VBUU_update_true6" value="options" checked="checked"/>
                        <label for="VBUU_update_true6"><strong>Opzioni </strong> </label>
                        <br/>
                        <input name="dominio" type="checkbox" id="VBUU_update_true7" value="dominio"/>
                        <label for="VBUU_update_true7"><strong>E' il dominio? </strong> </label>
                    </p></td>
            </tr>
        </table>
        <p>
            <input class="button-primary" name="VBUU_settings_submit" value="<?php _e('Update URLs NOW','velvet-blues-update-urls'); ?>" type="submit" />
        </p>
    </form>
    <p>&nbsp;<br/>
        <strong>
            <?php _e('Need help?','velvet-blues-update-urls'); ?>
        </strong> <?php printf(__("Get support at the %s plugin page%s.",'velvet-blues-update-urls'),'<a href="http://www.velvetblues.com/web-development-blog/wordpress-plugin-update-urls/" target="_blank">Velvet Blues Update URLs','</a>'); ?>
        <?php if( !isset( $empty ) ): ?>
            <br/>
            <strong>
                <?php _e('Want us to do it for you?','velvet-blues-update-urls'); ?>
            </strong>
            <?php _e('Contact us at','velvet-blues-update-urls'); ?>
            <a href="mailto:info@velvetblues.com?subject=Move%20My%20WP%20Site">info@velvetblues.com</a>.
            <?php _e('We will backup your website and move it for $65 OR update your URLs for only $29.','velvet-blues-update-urls'); ?>
        <?php endif; ?>
    </p>
    <?php
}
add_action('admin_menu', 'madisoft_gestione_url_aggiungi_pagina');


/**
 * @param $oldurl
 * @param $newurl
 * @param $tabella_opzioni
 * @return mixed
 * @internal param $wpdb
 * @internal param $results
 */
function cambiaOpzioni($oldurl, $newurl, $tabella_opzioni, $eUnDominio, $updateCss = false)
{
    $array = sostituisciDato(get_option('option_tree', true), $oldurl, $newurl);
    update_option('option_tree', $array);
    global $wpdb;
    $query = 'SELECT option_name FROM ' . $tabella_opzioni. ' WHERE `option_value` LIKE "%' . $oldurl . '%";';
    $resultNumber = $wpdb->query($query);
    $count = 0;
    if ($resultNumber) {
        $r = $wpdb->get_results($query);
        foreach ($r as $line) {
            if ( empty($eUnDominio) && (($line->option_name == 'siteurl' ) || $line->option_name == 'home')){
                continue;
            }
            $array = sostituisciDato(get_option($line->option_name, true), $oldurl, $newurl);
            update_option($line->option_name, $array);
            $count++;
        }
        if ($updateCss && !empty($eUnDominio)){
            generaLessFile(999);
        }
        $results= $count;
    } else {
        $results = 0;
    }
    return $results;
}

function sostituisciDato($array, $cerca, $sostituisci)
{
    if (is_string($array)) {
        return str_replace($cerca, $sostituisci, $array);
    }
    foreach ($array as $k =>$value)
    {
        if (is_array($value)) {
            $array[$k] = sostituisciDato($value, $cerca, $sostituisci);
        } else {
            $array[$k] = str_replace($cerca, $sostituisci, $value);
        }

    }

    return $array;
}

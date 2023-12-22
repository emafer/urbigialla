<?php
class madisoftThemePluginAccessibilita extends madisoftThemePluginClass implements madisoftThemePluginInterface
{
    var $postConAccessKey;
    var $accessKeyImpostato;
    var $accessKeySalvati = [
        'ids' => [],
        'pagine' => [],
        'accessKeyControl' => []
    ];

    function initFunction()
    {
        if(!possoMostrareLaBarraDiAccessibilita()){
            return false;
        }
        add_action('wp_enqueue_scripts', [$this, 'addScriptAndStyle']);
        add_action('wp_footer', [$this, 'creaLaBarra']);
        if( gliAccessKeySonoAbilitati() ){
            add_action('add_meta_boxes', [$this, 'add_accessKey_meta_box']);
            add_action('save_post', [$this, 'save_accessKey_meta_data']);
            add_action( 'admin_notices', [$this, 'stampaErrori'] );
        }
    }

    function addScriptAndStyle()
    {
        wp_enqueue_script('js-cookie', madisoft_scuola_get_assets_directory('js') . 'js.cookie.js', array('jquery'), "1.0", true);
        wp_register_style('accessibilita-style', madisoft_scuola_get_assets_directory('plugins') . 'accessibilita/assets/accessibilita.css?V=2');
        wp_enqueue_script('accessibilita', madisoft_scuola_get_assets_directory('plugins') . 'accessibilita/assets/accessibilita.js?V=2', array('jquery'), "1.0", true);
        wp_enqueue_style('accessibilita-style');
    }

    function creaLaBarra(){

        echo '<div id="barraAccessibilita">
<div class="btn-group">
    <a href="#" id="mostraBarra" title="mostra la barra di accessibilit&agrave;" class="btn btn-success btn-xs"><span class="fontsize2"><span class="fa fa-universal-access" aria-hidden="true"></span></span></a>
    <a href="#" id="aumentaCarattere" title="aumenta il carattere" class="btn btn-success btn-xs hidden-btn"><span class="fontsize1"><span class="fa fa-text-height" aria-hidden="true"></span><span class="fa fa-plus" aria-hidden="true"></span></span></a>
    <a href="#" id="resettaCarattere" title="ripristina il carattere" class="btn btn-success btn-xs  hidden-btn"><span class="fontsize1"><span class="fa fa-text-height" aria-hidden="true"></span><span class="fa fa-refresh" aria-hidden="true"></span>   </span></a>
    <a href="#" id="diminuisciCarattere" title="diminuisci il carattere" class="btn btn-success btn-xs hidden-btn"><span class="fontsize1"><span class="fa fa-text-height" aria-hidden="true"></span><span class="fa fa-minus" aria-hidden="true"></span></span></a>
    <a href="#" id="settaIlCss" title="setta il css ad alto contrasto" class="btn btn-warning btn-xs hidden-btn"><span class="fa fa-adjust"></span></a>
    <a href="#" id="scalaDiGrigi" title="Scala di grigi" class="btn btn-warning btn-xs hidden-btn"><span class="fa fa-tint"></span></a>
    ' ."\n"
        ;
        if (gliAccessKeySonoAbilitati()){
          if ( $this->esistonoPostConAccessKey() ){
              echo '<a href="#" id="mostrapagineConAccessKey" accesskey="?" title="Mostra il men&ugrave; rapido" class="btn btn-info btn-xs" data-toggle="modal" data-target="#menuaccesskey"><span class="fa fa-heading" aria-hidden="true"></span></a>';
          }
        }
        if (madisoft_get_theme_option('madisoft_scuola_segnala_link_esterni', 'off') == 'on') {
          echo '<a href="#" id="mostraLinkEsterni" accesskey="*" title="Segnala i link esterni" class="btn btn-info btn-xs"><span class="fa fa-window-restore" aria-hidden="true"></span></a>';
          }
echo '</div>
</div>' ."\n";
        $this->creaIlMenuAccesskey();
    }

    function creaIlMenuAccesskey(){
        if (!gliAccessKeySonoAbilitati()){
            return '';
        }

        echo '<div class="modal fade" id="menuaccesskey" tabindex="-1" aria-labelledby="AccesskeyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="accesskeys" class="hidden">' ."\n\t";
        echo '<div><em>Per utilizzare la navigazione via tastiera &egrave; possibile utilizzare delle combinazioni di tasti che
 differiscono per ogni browser</em></div>' ."\n\t";
        echo '<div class="row">
                <div class="col-xs-12 col-sm-6"><strong>Chrome</strong>: <span class="label label-default">ALT</span> + <span class="label label-default">Shift</span> + Carattere</div>
                <div class="col-xs-12 col-sm-6"><strong>Chrome su Macintosh</strong>: <span class="label label-default">CTRL</span> + <span class="label label-default">⌥ Opt</span> + Carattere</div>
                <div class="col-xs-12 col-sm-6"><strong>Firefox</strong>: <span class="label label-default">ALT</span> + <span class="label label-default">Shift</span> + Carattere</div>
                <div class="col-xs-12 col-sm-6"><strong>Firefox su Macintosh</strong>: <span class="label label-default">CTRL</span> + <span class="label label-default">⌥ Opt</span> + Carattere</div>
                <div class="col-xs-12 col-sm-6"><strong>Explorer</strong>: <span class="label label-default">ALT</span> + Carattere</div>
            </div>' ."\n\t";
        echo '<div class="row">
                <div class="col-xs-12 col-sm-12 text-center"><em>In Alcuni casi &egrave; sufficiente l\'uso del tasto <span class="label label-default">ALT</span> e del Carattere</em></div>
                
            </div>' ."\n\t";
        echo '
<h2 class="text-center">AccessKey disponibili</h2>
<ul class="listaAccessKey">
<li><span class="label label-primary">?</span> - Questo messaggio</li>' ."\n\t";
        ksort($this->accessKeySalvati['accessKeyControl']);
        foreach ($this->accessKeySalvati['accessKeyControl'] as $accesskey => $pagina){
            echo '<li><span class="label label-primary">' . $accesskey . '</span> - ' . $pagina . '</li>' ."\n";
        }
        echo '</ul>
    </div></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>' ."\n";
    }

    function esistonoPostConAccessKey(){
        if (!is_array($this->getPostConAccessKey())) {
            return false;
        }
           if (count($this->getPostConAccessKey())){
               return true;
           } else {
               return false;
           }
        }

    /**
     * @return mixed
     */
    public function getPostConAccessKey()
    {if (!$this->postConAccessKey){
        $this->setPostConAccessKey();
    }
        return $this->postConAccessKey;
    }

    /**
     * @param mixed $postConAccessKey
     */
    public function setPostConAccessKey()
    {
        $args = array(
            'post_type' => 'page',
            'meta_query' => array(
                array(
                    'key' => 'madisoft_accesskey',
                    'value' => '',
                    'compare' => '!=',
                )
            )
        );
        $query = new WP_Query($args);
        if ($query->post_count){
            $this->postConAccessKey = $query->posts;
            $this->creaArrayAccess();
        }
    }

    protected function creaArrayAccess(){
        foreach ($this->getPostConAccessKey() as $item){

            $accessKey = get_post_meta($item->ID, 'madisoft_accesskey', true);
            $paginaTitle  = madisoft_scuola_protect_title($item);
            $this->accessKeySalvati['ids'][] = $item->ID;
            $this->accessKeySalvati['pagine'][$item->ID] = [
                'title' => $paginaTitle,
                'accessKey' => $accessKey
            ];
            $this->accessKeySalvati['accessKeyControl'][$accessKey]  = '<a accesskey="' . $accessKey. '" href="' . get_the_permalink($item->ID) . '">' .$paginaTitle . '</a>';
        }
    }

    function add_accessKey_meta_box()
    {

        // Define the custom attachment for posts
        add_meta_box(
            'accessKey-metabox',
            'Accesskey',
            [$this,'accesskey_metabox_callback'],
            ['page'],
            'side',
            'high'
        );
    }

    function accesskey_metabox_callback() {
        wp_nonce_field( plugin_basename( __FILE__ ), 'accessKey_nonce' );

        $html = '<p class="description">';
        $html .= 'Inserendo un codice accesskey alle pagine, si potr&agrave; navigare nel sito usando delle combinazioni di tasti.<br/>
Non &egrave; possibile usare il carattere <strong><em>?</em></strong>';
        $html .= '</p>';
        $html .= '<div class="accessKey_box" id="accessKey_box">';
        $html .= '<label for="accessKey">AccessKey:</label>';
        $html .= '<input name="madisoft_accesskey" id="madisoft_accesskey" type="text" value="' . $this->getValue('madisoft_accesskey', '' ) .'" size="2" maxlength="1"><br/>';
        $html .= '</div>';
        echo $html;
    }

    function saveValueAccessKey($idPage, $idOpzione, $value)
    {
        if (!$value){
            delete_post_meta($idPage, $idOpzione);
            return true;
        }
        $this->setAccessKeyImpostato($value);
        if (!$this->EsistonoPostConQuestaAccessKey() && $value!= '?' ){
            update_post_meta($idPage, $idOpzione, $value);
        } else {
            $this->messaggioDiErrore();
        }
    }


    function save_accessKey_meta_data( $id ) {

        if ( ! isset( $_POST['accessKey_nonce'] ) ) {
            return $id;
        }
        /* --- security verification --- */
        if ( ! wp_verify_nonce( $_POST['accessKey_nonce'], plugin_basename( __FILE__ ) ) ) {
            return $id;
        } // end if

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $id;
        }
        // Make sure the file array isn't empty
        $this->saveValueAccessKey($id, 'madisoft_accesskey', $_POST['madisoft_accesskey']);
    }

    function EsistonoPostConQuestaAccessKey(){
        global $post;
        $args = array(
            'post_type' => 'page',
            'meta_query' => array(
                array(
                    'key' => 'madisoft_accesskey',
                    'value' => ucfirst($this->getAccessKeyImpostato()),
                    'compare' => '=',
                )
            )
        );
        $query = new WP_Query($args);
        switch ($query->post_count){
            case 0:
                return false;
                break;
            case 1:
                $postConAccessKey = $query->posts[0];
                if ($postConAccessKey->ID == $post->ID){
                    return false;
                } else {
                    return true;
                }
                break;

        }

    }

    function messaggioDiErrore() {
        add_settings_error(
            'same-access-key',
                'same-access-key',
                'Attenzione: un\'altra pagina ha lo stesso codice accesskey ('. $this->getAccessKeyImpostato() .') 
                o &egrave; stato impostato il carattere "?"',
                'error'
        );
        set_transient( 'settings_errors', get_settings_errors(), 30 );

    }

    function getValue($idOpzione, $default)
    {
        global $post;
        $val = get_post_meta($post->ID, $idOpzione, true);
        return empty($val) ? $default : $val;
    }

    function stampaErrori() {
        if ( ! ( $errors = get_transient( 'settings_errors' ) ) ) {
            return true;
        }
        $message = '<div id="messaggiDiErrore" class="error below-h2"><p><ul>';
        foreach ( $errors as $error ) {
            $message .= '<li>' . $error['message'] . '</li>';
        }
        $message .= '</ul></p></div><!-- #error -->';
        echo $message;
        delete_transient( 'settings_errors' );
        remove_action( 'admin_notices', '_location_admin_notices' );
    }

    /**
     * @return mixed
     */
    public function getAccessKeyImpostato()
    {
        return $this->accessKeyImpostato;
    }

    /**
     * @param mixed $accessKeyImpostato
     */
    public function setAccessKeyImpostato($accessKeyImpostato)
    {
        $this->accessKeyImpostato = $accessKeyImpostato;
    }

    /**
     * @return array
     */
    public function getAccessKeySalvati()
    {
        return $this->accessKeySalvati;
    }

    /**
     * @param array $accessKeySalvati
     */
    public function setAccessKeySalvati($accessKeySalvati)
    {
        $this->accessKeySalvati = $accessKeySalvati;
    }



}
if (possoMostrareLaBarraDiAccessibilita()){
    new madisoftThemePluginAccessibilita();
}

function possoMostrareLaBarraDiAccessibilita(){
    return madisoft_get_theme_option('madisoft_scuola_usa_barra_di_accessibilita', 'on') == 'on';
}

function gliAccessKeySonoAbilitati(){
    return  ( madisoft_get_theme_option('madisoft_scuola_usa_accesskey', 'off') == 'on' && possoMostrareLaBarraDiAccessibilita());
}

function getAccessKeyPage($postId){
    return get_post_meta($postId, 'madisoft_accesskey', true);
}

function getAccessKeyAttribute($accesskey = ''){
    if ($accesskey){
        return ' accessKey="' . $accesskey . '"';
    }

    return $accesskey;
}
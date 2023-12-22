<!-- login.php -->
<div class="text-center" id="form-login-header">
    <h2 class="align-middle">Accesso sito web</h2>
    <br/>
    <img alt="Nuvola sito web edu" src="<?php echo madisoft_scuola_get_assets_directory('images'); ?>logo-nuvola.png" style="width: 75%"/>
    <br/>
    <br/>
<?php
$args = array(
    'echo' => false,
    'redirect' => site_url($_SERVER['REQUEST_URI']),
    'form_id' => 'loginformHeader',
    'label_username' => __('Username'),
    'label_password' => __('Password'),
    'label_remember' => __('Remember Me'),
    'label_log_in' => __('Log In'),
    'id_username' => 'user_login_ar',
    'id_password' => 'user_pass_ar',
    'id_remember' => 'rememberme_ar',
    'id_submit' => 'wp-submit_ar',
    'remember' => false,
    'value_username' => NULL,
    'value_remember' => false
);
$html = wp_login_form($args);
$html = str_replace('Security Code', 'Codice di sicurezza', $html);
$html = str_replace('Enter the security code', 'Inserisci il codice di sicurezza', $html);

echo $html;
?>
<a href="/accesso-admin/"><em>Accedi alla bacheca</em></a>
</div>
<!-- /login.php -->

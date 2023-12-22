<?php

class madisoftThemePluginAzioniDiMassaUtenti extends madisoftThemePluginClass implements madisoftThemePluginInterface
{
    var $inviata = false;
    function initFunction()
    {
        add_action('admin_footer', [$this, 'madisoft_scuola_azioni_di_massa_utenti_footer']);
        add_action('admin_init', [$this, 'madisoft_scuola_azioni_di_massa_utenti_procedura']);
    }


    function madisoft_scuola_azioni_di_massa_utenti_procedura()
    {
        if ( basename(wp_get_referer())) {
            if(strpos(basename(wp_get_referer()),'?'))  {
                list($file, $tuttoilresto) = explode('?', basename(wp_get_referer()));
            } else {
                $file = basename(wp_get_referer());
            }
            if ($file == 'users.php') {
                if (isset($_GET['action'])) {
                    if ($_GET['action'] == 'resetPassword') {
                        foreach ($_GET['users'] as $id_utente) {
                            /**@var $user WP_User */
                            $user = new WP_User($id_utente);
                            $nuovapassword = $this->calcoloNuovaPassword($user);
                            $text = 'Gent.mo/a,
La sua password per l\'accesso al sito scolastico
e\' stata ripristinata per motivi di sicurezza:
da oggi potra\' accedere usando le seguenti credenziali:' . "\n".
                                'utente: ' . $user->user_login ."\n".
                                'password: ' . $nuovapassword ;
                            reset_password($user, $nuovapassword);
                            wp_mail($user->user_email,
                                'Ripristino password',
                                $text
                            );
                        }
                        $_GET['users'] = '';
                        $_GET['action'] = '';
                    }
                }
            }
        }
    }

    /**
     * @param $user
     *
     * @return string
     */
    function calcoloNuovaPassword($user)
    {
        $lunghezza = strlen($user->user_login);
        if ($lunghezza % 2 == 1) {
            $lunghezza++;
        }
        $a = substr($user->user_login, 0, $lunghezza / 2);
        $nuovapassword = $a . '20#' . substr($user->user_login, $lunghezza / 2) . '19$';

        return $nuovapassword;
    }

    function madisoft_scuola_azioni_di_massa_utenti_footer()
    {
        global $post_type, $pagenow;
        if ($pagenow == 'users.php') {
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    jQuery('<option>').val('resetPassword').text('<?php _e('Reset Password')?>').appendTo("select[name='action']");
                    jQuery('<option>').val('resetPassword').text('<?php _e('Reset Password')?>').appendTo("select[name='action2']");
                });
            </script>
            <?php
        }
    }

}

$madisoftThemePluginAzioniDiMassaUtenti = new madisoftThemePluginAzioniDiMassaUtenti();
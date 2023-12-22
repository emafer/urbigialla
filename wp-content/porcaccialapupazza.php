<?php
require('../wp-blog-header.php');
require('../wp-includes/pluggable.php');
//define('xdebug.mode','develop');
session_start();
class MadisoftImpersonaUserClass {

    protected array $users = [];
    protected array $codici = [];
    public function __construct(){
        $this->setUsers();
        if (isset($_SESSION['abilitazioneUtente'])
            && isset($_POST['uffa']) && $_POST['user_id']
            && checkSecurityInput($_POST['user_id'] )) {

            $p = (int) $_POST['user_id'];
            wp_clear_auth_cookie();
            wp_set_current_user($p);
            wp_set_auth_cookie($p);
            $redirect = home_url();
            wp_safe_redirect($redirect);
            exit();
        } else {
            $this->mostraPagina();
        }
    }
    protected function checkCredentials($name, $password): bool
    {
        global $utenti;
        return (isset($utenti[$name]) && $utenti[$name]== $password);
    }

    protected function printRuoli(array $array): string
    {
        $txt = '';
        $i =0;
        foreach ($array as $key => $item) {
            if($i) {
                $txt .= ", ";
            }
            $i++;
            $txt .= $key;
        }

        return $txt;
    }

    protected function printUsers(): string
    {
        ?>
        <html>
        <head>

            <link rel='stylesheet' id='dsi-boostrap-italia-css' href='themes/design-scuole-wordpress-theme/assets/css/bootstrap-italia.css' type='text/css' media='all' />
        </head>
        <body>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>username</th>
                <th>Utente</th>
                <th>mail</th>
                <th>ruoli</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach (get_users() as $user) {
                $printRuoli = printRuoli($user->caps);
                if (strpos(' ' . $printRuoli, 'administrator')) {
                    continue;
                }
                echo '<tr>';
                echo '<td>' . $user->data->user_login . '</td>';
                echo '<td>' . $user->data->user_nicename . '</td>';
                echo '<td>' . $user->data->user_email . '</td>';
                echo '<td>' . $printRuoli . '</td>';
                echo '<td><form method="post">
'.  getSecurityInput($user->data->ID). '
<input type="hidden" value="' . $user->data->ID .'" name="user_id"/>
<button type="submit" name="uffa" class="btn btn-success">Impersona</button> </td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table></body>
        </html>
        <?php
    }


    protected function checkSecurityInput($user_id) : bool
    {
        if (
            !isset($_POST['security_input_clip'])
            || !isset($_POST['security_input_clop'])
        ) {
            return false;
        }

        $clip = sqrt($user_id/$_POST['security_input_clip']);

        $control = md5(($clip*$user_id).$_SESSION['abilitazioneUtente']);
        if ($_POST['security_input_clop'] == $control) {
            return true;
        }
        return false;
    }

    protected function generaCodiciUtenti() : void
    {
        foreach ($this->users as $user => $password) {
            $valore = 0;
            foreach(str_split($user.$password) as $lettera) {
                $valore+=(($lettera)? ord($lettera) : 0);
                $valore = '0.'.$valore;
                $this->codici[$user] =  1/(float) $valore;
            }

        }
    }
    protected function getSecurityInput($user_id): string
    {
        return '
        <input type="hidden" name="security_input_clip" value="'. ($user_id/pow(time(),2)) . '"/>
        <input type="hidden" name="security_input_clop" value="'. md5((time()*$user_id).$_SESSION['abilitazioneUtente']) . '"/>
        ';
    }

    protected function mostraPagina()
    {

        if (isset($_POST['name']) && isset($_POST['pwd']) && $this->checkCredentials(sanitize_text_field($_POST['name']),  sanitize_text_field($_POST['pwd']))) {
            $_SESSION['abilitazioneUtente'] = md5(sanitize_text_field($_POST['name']) . sanitize_text_field($_POST['pwd']));
            $_SESSION['user'] = sanitize_text_field($_POST['name']);
        }

        if (!isset($_SESSION['abilitazioneUtente'])) {
            $this->mostraFormAccesso();
            die;
        }

        if (isset($_SESSION['abilitazioneUtente'])) {
            $this->printUsers();
        } else {
            $this->mostraFormAccesso();
        }
    }

    protected function mostraFormAccesso(): void
    {
        echo '<form action="" method="post"><input type="text" name="name"/><br/>
    <input type="password" name="pwd"><button type="submit">Accedi</button></form>';
    }

    protected function setUsers(): void
    {
        $this->users = [
            'francesco' => 'francesco',
            'antonio' => 'antonio',
            'federico' => 'federico',
            'federica' => 'federica',
            'gianmarco' => 'gianmarco',
            'maurilio' => 'maurilio',
            'riccardo' => 'riccardo',
            'diego' => 'diego',
            '1' => '1',
        ];
        $this->generaCodiciUtenti();
    }
}

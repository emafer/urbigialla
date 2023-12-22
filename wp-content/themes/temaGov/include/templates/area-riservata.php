<?php
$queryPS = new WP_Query(array(
    'post_type' => 'servizio_online',
    'post_status' => 'publish',
    'numberposts' => -1
));
$servizi = [];
while ($queryPS->have_posts()) {
    $queryPS->the_post();
    $servizio = [];
    $servizio['id'] = get_the_ID();
    $servizio['nome'] = $post->post_title;
    $servizio['immagine'] = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
    $servizio['link'] = get_post_meta(get_the_ID(), 'servizio_link', true);
    $servizio['descrizione'] = get_post_meta(get_the_ID(), 'servizio_descrizione', true);
    $servizi[] = $servizio;
}
wp_reset_query();
?>

<div class="modal fade" id="servizi-modal" tabindex="-1" role="dialog" aria-labelledby="access-modal" aria-modal="true" style="padding-right: 15px; display: block;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content perfect-scrollbar ps-container ps-theme-default" data-ps-id="f0d71655-aba8-4fcc-9da9-168ba361f4dc">
            <div class="modal-body">
                    <div class="container">
                        <div class="row variable-gutters mb-0 mb-lg-8 mb-xl-10">
                            <div class="col">
                                <div class="h2">Accedi ai servizi                                    <button type="button" class="close dismiss" data-dismiss="modal" aria-label="Close">
                                        <svg class="svg-cancel-large"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-cancel-large"></use></svg></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-lg-4 access-mobile-bg">
                            <div class="access-login">

                                <h3>Personale scolastico</h3>
                                <p class="text-large">Entra nel sito della scuola con le tue credenziali per gestire contenuti, visualizzare circolari e altre funzionalità.</p>
                                <div class="access-login-form">
                                    <div class="form-group">
                                        <label for="user_login">Email address</label>
                                        <input type="text" name="log" id="user_login" class="input" value="" size="20" autocapitalize="off" aria-describedby="access-form" placeholder="Nome utente o indirizzo email" autocomplete="off" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;"></div>
                                    <div class="form-group mb-3">
                                        <label for="user_pass">Password</label>
                                        <input type="password" name="pwd" id="user_pass" class="form-control" value="" size="20" aria-describedby="access-form" placeholder="Password" autocomplete="off" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;"></div>

                                    <div class="row variable-gutters mb-4">
                                        <div class="col text-right">
                                            <p><a href="https://liceodalpiaz.edu.it/wp-login.php?action=lostpassword">Password dimenticata?</a></p>
                                        </div>
                                    </div>

                                    <div class="row variable-gutters">
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-check form-check-inline">
                                                <input name="rememberme" type="checkbox" id="rememberme" value="forever"><label for="rememberme">Ricordami</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <button type="submit" class="btn btn-white btn-block rounded" name="login" value="Accedi">Accedi</button>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="row variable-gutters">
                                        <div class="col text-center">
                                            <p>Non hai un account? <a href="#">Iscriviti</a></p>
                                        </div>
                                    </div>
                                    //-->
                                </div>
                            </div>
                        </div><div class="row variable-gutters justify-content-center pt-8 pt-xl-10">
                            <div class="col-lg-8">
                                <p class="text-intro">Da qui puoi accedere ai diversi servizi della scuola che richiedono una autenticazione personale.</p>
                                <div class="access-buttons">
                                    <?php
                                    foreach ($servizi as $servizio) {
                                        echo '
            <!-- <div id="' . $servizio['id'] . '" class="servizio-online">
            <h2>' . $servizio['nome']. '</h2> 
                <a href="' . $servizio['link'] . '">
                    <img src="' . $servizio['immagine'] . '" alt="' . $servizio['descrizione'] . '"/>
                </a>-->
                <a class="btn btn-petrol btn-block btn-lg rounded mb-36" href="' . $servizio['link']. '">' . $servizio['nome']. '</a>
            <!-- </div> -->';
                                    }
                                    ?>

                                </div>
                            </div>

                        </div>
                    </div>
            </div>
            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
    </div>
</div>
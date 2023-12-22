<?php
/* 
 * This file generates the default booking form fields. Events Manager Pro does not use this file.
 */
/* @var $EM_Event EM_Event */ 
//Here we have extra information required for the booking. 
?>
<?php if( !is_user_logged_in() && apply_filters('em_booking_form_show_register_form',true) ): ?>
<?php 
 if (function_exists('madisoft_get_theme_option')) {
	$mostraIndirizzo = madisoft_get_theme_option('madisoft_scuola_eventi_descrizione_annotazioni_mostra', 'on') == 'on';
	$testoIndirizzo = madisoft_get_theme_option('madisoft_scuola_eventi_descrizione_annotazioni', 'Indirizzo e annotazioni');
	$testoNomeCognome = madisoft_get_theme_option('madisoft_scuola_eventi_nomecognome', 'Nome e cognome');
	$mostraTelefono = madisoft_get_theme_option('madisoft_scuola_eventi_telefono_mostra', 'on') == 'on';
	$mostraConfermaEmail = madisoft_get_theme_option('madisoft_scuola_eventi_conferma_email_mostra', 'off') == 'on';
}  else {
     $mostraTelefono = true;
	$mostraIndirizzo = true;
     $mostraConfermaEmail = false;
	$testoIndirizzo = 'Indirizzo e annotazioni';
	$testoNomeCognome = 'Nome e cognome';
	}
?>
	<?php //User can book an event without registering, a username will be created for them based on their email and a random password will be created. ?>
	<input type="hidden" name="register_user" value="1" />
	<div class="form-group">
		<label for='user_name' style="width: 100%"><?php echo $testoNomeCognome; ?></label>
		<input type="text" name="user_name" id="user_name" class="input form-control" style="width: 100%" value="<?php if(!empty($_REQUEST['user_name'])) echo esc_attr($_REQUEST['user_name']); ?>" />
	</div>

    <?php
    if ($mostraTelefono == true) {
        ?>
        <div class="form-group">
		<label for='dbem_phone' style="width: 100%"><?php _e('Phone','events-manager') ?></label>
		<input type="text" name="dbem_phone" id="dbem_phone" class="input form-control" style="width: 100%" value="<?php if(!empty($_REQUEST['dbem_phone'])) echo esc_attr($_REQUEST['dbem_phone']); ?>" />
	</div>
        <?php
    }
    ?>
	<div class="form-group">
		<label for='user_email' style="width: 100%"><?php _e('E-mail','events-manager') ?></label>
		<input type="text" name="user_email" id="user_email" style="width: 100%" class="input form-control" value="<?php if(!empty($_REQUEST['user_email'])) echo esc_attr($_REQUEST['user_email']); ?>"  />
	</div>
<?php if ($mostraConfermaEmail) {?>
        <div class="form-group">
            <label for='user_confirm_email' style="width: 100%"><?php _e('Conferma E-mail','events-manager') ?>*</label>
            <input type="text" name="user_confirm_email" style="width: 100%" id="user_confirm_email" required="required" class="input form-control" value="<?php if(!empty($_REQUEST['user_confirm_email'])) echo esc_attr($_REQUEST['user_confirm_email']); ?>"  />
        </div>
        <script>
            jQuery('#user_confirm_email').change(function(){
                if (jQuery(this).val() !== jQuery('#user_email').val()) {
                    jQuery('#em-booking-submit').attr('disabled', 'disabled');
                    jQuery(this).attr('style', 'border-color: red; width:100%;')
                } else {
                    jQuery('#em-booking-submit').removeAttr('disabled', 'disabled');
                    jQuery(this).attr('style', 'border-color: green; width:100%;')
                }
            })
        </script>
        <?php } ?>
	<?php do_action('em_register_form'); //careful if making an add-on, this will only be used if you're not using custom booking forms ?>					
<?php endif; ?>	
<?php
if ($mostraIndirizzo == true) {
?>	
<div class="form-group">
	<label for='booking_comment' style="width: 100%"><?php echo $testoIndirizzo; ?></label>
	<textarea class="form-control" style="width: 100%" name='booking_comment' id='booking_comment' rows="2" cols="20"><?php echo !empty($_REQUEST['booking_comment']) ? esc_attr($_REQUEST['booking_comment']):'' ?></textarea>
</div>
<?php } ?>
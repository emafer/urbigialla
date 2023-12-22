<?php
function madisoft_login_logo() {
	?>
	<style type="text/css">
		body.login div#login h1 a {
			width: 100%;
			background-image: url(<?php echo madisoft_scuola_get_assets_directory('img') ?>logoNuvola.png);
			background-size: 320px 87px;
			padding-bottom: 10px;
		}
	</style>
<?php
}
add_action( 'login_enqueue_scripts', 'madisoft_login_logo' );

function madisoft_login_logo_url() {
	return 'http://scuoladigitale.info';
}
add_filter( 'login_headerurl', 'madisoft_login_logo_url' );

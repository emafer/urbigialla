<?php
madisoft_scuola_crea_struttura_superiore();
$category = get_queried_object();
global $madisoftTheme;
?>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
	<?php
	/** @var $circolariPostTypeClass CircolariPostType */
	$circolariPostTypeClass = $madisoftTheme->getGlobalVar( 'circolari_post_type' );
	$wp_query = $circolariPostTypeClass::getAll();
	$titolo                 = isset( $_POST['titolo'] ) ? filter_var ( $_POST['titolo'], FILTER_SANITIZE_STRING) : '';
	$data_da = new DateTime( filter_var ( $_POST['data_da'], FILTER_SANITIZE_STRING) );
	$data_a  = new DateTime( filter_var ( $_POST['data_a'], FILTER_SANITIZE_STRING) );
	?>
	<form method="post" class="form form-inline">
	<fieldset>
		<legend>Ricerca</legend>
		<label for="data_da">Dal:</label>
		<input type="text" class="datepicker form-control" id="data_da" name="data_da" value="<?php echo $data_da->format( 'd/m/Y' ); ?>">
		<label for="data_a">Al:</label>
		<input type="text" class="datepicker form-control" id="data_a" name="data_a" value="<?php echo $data_a->format( 'd/m/Y' ); ?>">
		<br>
		<?php
		if ( madisoft_get_theme_option( 'madisoft_scuola_circolari_tipologia', '1' ) == '1' ) {
			?>
		<label for="tipologia">Tipo:</label>
		<?php
		wp_dropdown_categories( array(
			'show_option_all' => 'Tutte',
			'orderby'         => 'name',
			'taxonomy'        => 'tipologia_circolari',
			'name'     => 'tipologia',
			'id'       => 'tipologia',
			'class'		=> 'form-control',
			'selected' => filter_var ( $_POST['tipologia'], FILTER_SANITIZE_STRING)
		) );
		}

		if ( madisoft_get_theme_option( 'madisoft_scuola_circolari_destinatari', '1' ) == '1' ) {
		?>
		<label for="destinatari">Destinatario:</label>
		<?php
		wp_dropdown_categories( array(
			'show_option_all' => 'Tutti',
			'orderby'         => 'name',
			'class'		  => 'form-control',
			'taxonomy'        => 'destinatari_circolari',
			'name'     => 'destinatari',
			'id'       => 'destinatari',
			'selected' => filter_var ( $_POST['destinatari'], FILTER_SANITIZE_STRING)
		) );
		?><br />
		<?php
		} ?>
		Titolo: <input type="text" name="titolo" value="<?php echo $titolo; ?>" />
		<input type="submit" value="Cerca">
</fieldset>
	</form>

	<?php
	if ( $wp_query->have_posts() ) {

		$circolariPostTypeClass->createTable();
	}
madisoft_scuola_crea_struttura_inferiore();

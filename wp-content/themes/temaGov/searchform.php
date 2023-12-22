<?php
if (!isset($args)) {
    $args = [];
}
if (!isset($args['id'])) {
    $id = 'searchForm';
} else {
	 $id =$args['id'];
}
// se $s non è settata la setto: evito i notice
if( !isset($s) ){
	$s ='';
}
?>
<form method="get" id="<?php echo $id ?>" action="<?php home_url(); ?>/">
	<div class="input-group">
		<label class="screen-reader-text" for="s">Cerca:</label>
		<input type="text" class="form-control" value="<?php echo esc_html( $s, 1 ); ?>" name="s" id="s<?php echo $id; ?>" placeholder="Cerca nel sito..." />
	<span class="input-group-addon no-padding"><button title="Cerca"  type="submit" id="searchsubmit2<?php echo $id; ?>" value="cerca" >  <span class="fa fa-search" aria-hidden="true"></span></button></span>
	</div>
</form>

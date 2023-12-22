<div class="text-center">
<h2>Servizi</h2>
<div class="row">
<?php
$args  = [
    'post_type'     => 'servizio_online',
    'numberposts'   => -1
];
$inizioRicerca = strtotime(date('d-m-Y'));

$querys  = get_posts( $args );
foreach ($querys as $servizio) {
    $metas =  get_post_meta($servizio->ID);
	$title = get_the_title($servizio->ID);
    echo '<div class="col-md-12 col-xs-24 col-lg-12 servizioOnline">
	<div class="card">
  <img src="' . wp_get_attachment_url( get_post_thumbnail_id($servizio->ID) ). '" class="card-img-top" alt="' . $servizio->post_title . '">
  <div class="card-body">
    <h5 class="card-title" style="color: #06c;">' . $title . '</h5>
    <p class="card-text">' . $metas['servizio_descrizione'][0] . '</p>
    <a href="' . $metas['servizio_link'][0] . '" target="_blank" class="btn btn-primary">Vai al servizio</a>
  </div>
</div></div>';
}
?>
</div>
</div>

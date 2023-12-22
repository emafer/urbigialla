<?php
ugialla_get_top_template();
?>
    <div class="container-fluid">
        <div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-3 col-md-3 col-xs-12 text-center">
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );?>
                        <img src="<?php echo $image[0];?>" style="max-width: 100%; height: auto"/>
                    </div>
                    <div class="col-sm-9 col-md-9 col-xs-12 text-center">
                        <h1 class="titolo_attivita"><?php the_title();?></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-3 col-xs-12 ">
                        <?php print_categorie_attivita($post); ?>
                        <?php print_contatti_attivita($post); ?>
                    </div>
                    <div class="col-sm-9 col-md-9 col-xs-12">
                        <div class="container-fluid">
                            <div class="row">
                                <div id="theContentBox"> <?php the_content();?></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 map leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom"
                                     id="map_1" tabindex="0" style="position: relative; outline: none; height: 150px"></div>
                            </div>
                        </div>


                        <script>

                            jQuery(function() {
                                var mymap = L.map('map_1', {
                                    zoomControl: true,
                                    scrollWheelZoom: true
                                }).setView([44.6948437, 10.6123969], 15);

                                // add the OpenStreetMap tiles
                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '',
                                    maxZoom: 18,
                                }).addTo(mymap);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
ugialla_get_bottom_template();

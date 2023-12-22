<footer>
    <div id="footer">
        <?php
        if (madisoft_get_theme_option('madisoft_scuola_numero_footer_widget_mostra', 'on') == 'off') {
            get_template_part('include/templates/footer/footer-stile-1');
        } else {
            get_template_part('include/templates/footer/footer-stile-standard');
        }
        ?>
        <script>
            jQuery(document).ready(function(){
                jQuery('[data-toggle="tooltip"]').tooltip();
                jQuery('a[target="_blank"]').attr('rel', 'noopener');
		        jQuery('.gototop').hide();
                jQuery(document).scroll(function() {
                    let y = jQuery(this).scrollTop();
                    if (y > jQuery(window).height()) {
                        jQuery('.gototop').fadeIn();
                    } else {
                        jQuery('.gototop').fadeOut();
                    }
                });
            });
            jQuery('.post_evidence_img').click(function(){
                window.location.href = jQuery(this).attr('data-target');
            })
        </script>
        <div class="gototop" style="text-align: center;height: 50px;width: 50px;padding-top: 5px;position: fixed;bottom: 40px;z-index: 100;font-size: 2em;right: 0;color: white;border: 1px solid white;background: #30373d; border-radius: 100%;">
            <p>
                <a href="#header" rel="nofollow" style="color: white;"><i class="fas fa-arrow-up"></i></a>
            </p>
        </div>
    </div>
    <!--
    CercaModale
    -->
    <!-- Modal -->
    <div class="modal fade" id="ricercami" tabindex="-1" role="dialog" aria-labelledby="ricercaLabel" aria-hidden="true" style="z-index: 1050!important; position: absolute !important; left: 30% !important; height: auto!important;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ricercaLabel">Cerca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    get_template_part('searchform', null, ['id' => 'topsearch']);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="servizi" style="display: none; width: 100%; background: white; position: fixed; top: 0; left: 0; z-index: 999999; height: 100%;">
        <div class="closeme">
            <a href="#"  class="btn btn-primary" id="chiudiServizi" style="
            color: white;
            position: absolute; top: 15px; right: 15px; z-index: 9;
text-decoration: none">X</a>
        </div>
        <div class="container-fluid" style="
    height: 100%;
">
            <div class="row align-items-center" style="
height: 100%;
    overflow: scroll;
background: rgb(1,128,195);
background: linear-gradient(90deg, rgba(0,128,195,1) 0%, rgba(1,128,195,1) 49%, rgba(255,255,255,1) 49%, rgba(255,255,255,1) 100%);
">
                <div class="col-md-12 col-xs-24 col-lg-12 ">
                    <?php
                    get_template_part('include/templates/servizi');
                    ?>
                </div>
                <div class="col-md-12 col-xs-24 col-lg-12 " style="
    color: #0066cc;
	background: #ffffff;
">
                    <?php
                    get_template_part('include/templates/login');
                    ?>

                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery('.arearis-header-link').click(function (event){
            event.preventDefault();
            jQuery('#servizi').show('slow');
            jQuery('#contenuto').hide('slow');
        })
        jQuery('#chiudiServizi').click(function (event){
            event.preventDefault();
            jQuery('#contenuto').show();
            jQuery('#servizi').hide('slow');
        })
    </script>
</footer>
<?php wp_footer();
madisoft_scuola_codice_custom_js();?>
<!--[if IE 8]>
<script src="<?php echo getThemepath(true); ?>/webtoolkit/respond.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>>/webtoolkit/rem.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/webtoolkit/selectivizr.js"></script>
<script src="<?php bloginfo('template_url'); ?>/webtoolkit/slice.js"></script>
<script src="<?php bloginfo('template_url'); ?>/webtoolkit/slice.js"></script>
<![endif]-->
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->

<script src="<?php bloginfo('template_url'); ?>/include/assets/js/jquery.sticky.js"></script>
<script src="<?php echo madisoft_scuola_get_assets_directory('js', true, 'bootstrap.min.js'); ?>"></script>
<script src="<?php echo madisoft_scuola_get_assets_directory( 'js', true ) . 'popper-2023.min.js'; ?>"></script>
<!--[if lte IE 9]>
<script src="<?php bloginfo('template_url'); ?>/webtoolkit/polyfill.min.js"></script>
<![endif]-->

<script>__PUBLIC_PATH__ = '<?php bloginfo('template_url'); ?>/webtoolkit/'</script>

<script>
    <?php
    if (is_admin_bar_showing()) {
        $topFixed = 40;
    } else {
        $topFixed = 0;
    }
    ?>
    $(document).ready(function(){
		
        var $topFixed = 0;
        if ($('#wpadminbar').length > 0) {
            $topFixed =parseFloat($('#wpadminbar').css('height'));
        }
        $(".menu-principale-position").sticky({topSpacing: $topFixed,zIndex:100});

    });
</script>
</body>
</html>

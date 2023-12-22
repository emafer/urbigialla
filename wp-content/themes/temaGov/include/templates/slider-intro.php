<?php

    $slides = madisoft_get_theme_option( 'madisoft_scuola_intro_slider_immagini', array() );
    creaSliderDiv($slides, false, 'flexslider-intro');
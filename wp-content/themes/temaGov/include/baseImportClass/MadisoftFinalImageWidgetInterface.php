<?php

interface  MadisoftFinalImageWidgetInterface {
    function __construct ();

    /**
     * @return string Link per il collegamento
     */
    function prepareLink();

    /**
     * @return MadisoftImageClass L'immagine da mostrare
     */
    function prepareImage();
}
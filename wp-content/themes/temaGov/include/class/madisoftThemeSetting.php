<?php

class madisoftThemeSetting
{
    var $sectionTemporanee = [];
    var $settingsTemportanei = [];
    function __construct ()
    {
    }

    function aggiungiSezione($id, $titolo){
        if (!isset ($this->sectionTemporanee[$id])) {
            $this->sectionTemporanee[$id] = $titolo;
        }

        return true;
    }

    function aggiungiOpzione(array $opzione){
      $this->settingsTemportanei = $opzione;
    }

}
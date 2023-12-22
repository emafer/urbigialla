<?php
class MadisoftThemeOptionClass{
    protected $settings;
    protected $sections;
    protected $sezioniFinali;
    protected $impostazioniFinali;

    function __construct()
    {

    }

    function aggiungiSezione($posizione, $id, $titolo){
        if (!isset($this->sections[$posizione])){
            $this->sections[$posizione] = [];
        }
        $this->sections[$posizione][] = [
           'id' => $id,
           'title' => $titolo
        ];
    }

    function aggiungiImpostazione($sezioneId, $opzione, $posizione = '', $classe = ''){
        if (!isset($this->settings[$sezioneId])){
            $this->settings[$sezioneId] = [];
        }
        if ($posizione != ''){
            if (!isset($this->settings[$sezioneId][$posizione])){
                $this->settings[$sezioneId][$posizione] = [];
            }
        } else {
            $posizione = count($this->settings[$sezioneId]);
            $this->settings[$sezioneId][$posizione] = [];
        }
        if ($classe) {
            $opzione['class'] = $opzione['class'] . " " . $classe;
        }
        $this->settings[$sezioneId][$posizione][] = $opzione;
    }

    function generaSezioni(){
        ksort($this->sections);
        foreach ($this->sections as $posizione => $sezioni) {
            foreach ($sezioni as $sezione){
                $this->sezioniFinali[] = $sezione;
            }
        }
    }

    function generaImpostazioni(){
        foreach ($this->settings as $sezione => $impostazioniArray) {
            ksort($impostazioniArray);
            foreach( $impostazioniArray as $posizione=>$impostazioni){
                foreach ($impostazioni as $impostazione){
                    $this->impostazioniFinali[] = $impostazione;
                }
            }
        }
    }

    function generaThemeOptions(){


        return $custom_settings = [
            'contextual_help' => [
                'sidebar' => ''
            ],
            'sections'        => $this->getSezioniFinali(),
            'settings'        =>  $this->getImpostazioniFinali()
        ];
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return mixed
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param mixed $sections
     */
    public function setSections($sections)
    {
        $this->sections = $sections;
    }

    /**
     * @return mixed
     */
    public function getSezioniFinali()
    {
        if (!$this->sezioniFinali){
            $this->generaSezioni();
        }
        return $this->sezioniFinali;
    }

    /**
     * @param mixed $sezioniFinali
     */
    public function setSezioniFinali($sezioniFinali)
    {
        $this->sezioniFinali = $sezioniFinali;
    }

    /**
     * @return mixed
     */
    public function getImpostazioniFinali()
    {
        if (!$this->impostazioniFinali){
            $this->generaImpostazioni();
        }
        return $this->impostazioniFinali;
    }

    /**
     * @param mixed $impostazioniFinali
     */
    public function setImpostazioniFinali($impostazioniFinali)
    {
        $this->impostazioniFinali = $impostazioniFinali;
    }

}
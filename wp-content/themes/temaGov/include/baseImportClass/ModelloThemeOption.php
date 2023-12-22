<?php
class ModelloThemeOption{
    var $id;
    var $label;
    var $desc;
    var $std;
    var $type;
    var $section;
    var $rows;
    var $post_type;
    var $taxonomy;
    var $min_max_step;
    var $class;
    var $condition;
    var $operator;
    var $choices;

    function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ModelloThemeOption
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return ModelloThemeOption
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     * @return ModelloThemeOption
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStd()
    {
        return $this->std;
    }

    /**
     * @param mixed $std
     * @return ModelloThemeOption
     */
    public function setStd($std)
    {
        $this->std = $std;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return ModelloThemeOption
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param mixed $section
     * @return ModelloThemeOption
     */
    public function setSection($section)
    {
        $this->section = $section;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @param mixed $rows
     * @return ModelloThemeOption
     */
    public function setRows($rows)
    {
        $this->rows = $rows;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostType()
    {
        return $this->post_type;
    }

    /**
     * @param mixed $post_type
     * @return ModelloThemeOption
     */
    public function setPostType($post_type)
    {
        $this->post_type = $post_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxonomy()
    {
        return $this->taxonomy;
    }

    /**
     * @param mixed $taxonomy
     * @return ModelloThemeOption
     */
    public function setTaxonomy($taxonomy)
    {
        $this->taxonomy = $taxonomy;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMinMaxStep()
    {
        return $this->min_max_step;
    }

    /**
     * @param mixed $min_max_step
     * @return ModelloThemeOption
     */
    public function setMinMaxStep($min_max_step)
    {
        $this->min_max_step = $min_max_step;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     * @return ModelloThemeOption
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param mixed $condition
     * @return ModelloThemeOption
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param mixed $operator
     * @return ModelloThemeOption
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param mixed $choices
     * @return ModelloThemeOption
     */
    public function setChoices($choices)
    {
        $this->choices = $choices;
        return $this;
    }

    public function aggiungiScelta(array $scelta){
        $this->choices[] = $scelta;
    }

    function getOpzioneCompleta(){
        return [
            'id'           => $this->getId(),
            'label'        => $this->getLabel(),
            'desc'         => $this->getDesc(),
            'std'          => $this->getStd(),
            'type'         => $this->getType(),
            'section'      => $this->getSection(),
            'rows'         => $this->getRows(),
            'post_type'    => $this->getPostType(),
            'taxonomy'     => $this->getTaxonomy(),
            'min_max_step' => $this->getMinMaxStep(),
            'class'        => $this->getClass(),
            'condition'    => $this->getCondition(),
            'operator'     => $this->getOperator(),
            'choices'     => $this->getChoices()
        ];
    }
}

class ModelloThemeOptionOnOff extends ModelloThemeOption {
    function __construct($idSezione, $default = 'on')
    {
        $this->setSection($idSezione);
        $this->setStd($default);
        $this->setType('on-off');
    }
}

class ModelloThemeOptionText extends ModelloThemeOption {
    function __construct($idSezione, $default = '')
    {
        $this->setSection($idSezione);
        $this->setStd($default);
        $this->setType('text');
    }
}
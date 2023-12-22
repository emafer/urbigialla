<?php

    function madisoft_theme_aggiungi_colonna_immagine($columns)
    {
        if (get_post_type() != 'post'){
            return $columns;
        }
        $new_columns = array(
            'img_evi' => 'Immagine',
        );
        return array_merge($columns,$new_columns);
    }

    add_action('manage_posts_columns', 'madisoft_theme_aggiungi_colonna_immagine', 10, 2);
    add_action('manage_posts_custom_column', 'madisoft_theme_valore_colonne_immagine', 10, 2);

    function madisoft_theme_valore_colonne_immagine($column, $post_id)
    {
        if (get_post_type($post_id) != 'post'){
            return '';
        }
        switch ($column) {
            case 'img_evi':
                $post_check = get_post($post_id);
                $inEvidenza = madisoft_scuola_get_immagine_in_evidenza($post_check);
                if ($inEvidenza){
                    echo '<img src="' . $inEvidenza . '" width="50">';
                }
                break;
        }
    }
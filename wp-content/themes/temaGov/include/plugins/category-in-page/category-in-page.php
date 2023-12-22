<?php

class madisoftThemeCategoryInPage extends madisoftThemePluginClass implements madisoftThemePluginInterface
{

    function initFunction()
    {
        add_action('add_meta_boxes', [$this, 'UsrLo_meta_box_add_PaginaCategoria']);
        add_action('save_post', [$this, 'UsrLo_meta_box_save_PaginaCategoria']);
    }

    function UsrLo_meta_box_add_PaginaCategoria()
    {
        add_meta_box(
            'usrlo-meta-box-id',
            'Elenco Categorie',
            [$this, 'UsrLo_meta_box_PaginaCategoria'],
            'page',
            'side',
            'core');
    }

    function UsrLo_meta_box_PaginaCategoria($post)
    {

        $values = get_post_custom($post->ID);

        $selected = isset($values['usrlo_pagina_categoria']) ? esc_attr($values['usrlo_pagina_categoria'][0]) : '';

        wp_nonce_field('usrlo_pagina_categoria_nonce', 'usrlo_pagina_categoria_meta_box_nonce');

        $selezionata = '';

        if (get_post_meta($post->ID, 'usrlo_pagina_categoria', true)) : $selezionata = get_post_meta($post->ID, 'usrlo_pagina_categoria', true); endif; ?>

        <p>

            <label for="usrlo_pagina_categoria"><strong>Categorie</strong></label><br/>
            <em>seleziona una delle seguenti categorie per mostrare il suo contenuto in questa pagina</em>
            <?php
            $args = array('id' => 'usrlo_pagina_categoria', 'name' => 'usrlo_pagina_categoria', 'hide_empty' => 0, 'orderby' => 'name', 'order' => 'ASC', 'hierarchical' => 1, 'show_option_none' => '- Pagina senza Categoria', 'selected' => $selezionata);
            wp_dropdown_categories($args);
            if (get_post_meta($post->ID, 'page_stile_categoria', true)) {
                $selezionata = get_post_meta($post->ID, 'page_stile_categoria', true);
            } else {
                $selezionata = '99';
            }
			if (get_post_meta($post->ID, 'page_numero_articoli', true)) {
                $selezionataN = get_post_meta($post->ID, 'page_numero_articoli', true);
            } else {
                $selezionataN = '99';
            }
            ?>
            <br/>
            <label for="stile-categoria">Stile</label><br/>
            <select name="page_stile_categoria" id="stile-categoria">
                <option value="99"<?php if ($selezionata == '99') {echo ' selected="selected"';} ?>> Auto</option>
                <option value="categoria"<?php if ($selezionata == 'categoria') {echo ' selected="selected"';} ?>>Categoria</option>
                <option value="archivio-categoria"<?php if ($selezionata == 'archivio-categoria') {echo ' selected="selected"';} ?>>Archivio Categoria</option>
            </select>
            <br/>
            <label for="numero_articoli">Numero articoli</label><br/>
            <select name="page_numero_articoli" id="numero_articoli">
			<option value="99"<?php if ($selezionataN == '99') {echo ' selected="selected"';} ?>>auto</option>
			<?php
			for ($i =1;$i<=20; $i++) {
				if ($selezionataN == $i) {$classeN = ' selected="selected"';}
				else {
					$classeN = '';
				}
			echo '<option value="' . $i . '"' . $classeN . '>' . $i. '</option>';
			}
			?>
            </select>
        </p>
        <?php
    }

    function UsrLo_meta_box_save_PaginaCategoria($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (!isset($_POST['usrlo_pagina_categoria_meta_box_nonce']) || !wp_verify_nonce($_POST['usrlo_pagina_categoria_meta_box_nonce'], 'usrlo_pagina_categoria_nonce')) {
            return;
        }
        if (!current_user_can('edit_post')) {
            return;
        }
        if (isset($_POST['usrlo_pagina_categoria'])) {
            update_post_meta($post_id, 'usrlo_pagina_categoria', esc_attr($_POST['usrlo_pagina_categoria']));
            update_post_meta($post_id, 'page_stile_categoria', esc_attr($_POST['page_stile_categoria']));
            update_post_meta($post_id, 'page_numero_articoli', esc_attr($_POST['page_numero_articoli']));
        }
    }

}


$madisoftThemeCategoryInPage = new madisoftThemeCategoryInPage();




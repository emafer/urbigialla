<?php
ugialla_get_top_template();
?>
    <div class="container-fluid">
        <div>
            <div class="container searchDiv">
                <div class="row">
                    <div class="col-sm-2 d-xs-none"></div>
                    <div class="col-xs-10 col-sm-8">
                        <form>
                            <div class="input-group input-group-sm mb-3">
                                <input class="form-control  form-control-lg" name="s"/>
                                <span class="input-group-text" id="inputGroup-sizing-lg">
                                <button class="btn btn-search-att">
                                    <span class="fa fa-search"></span>
                                </button>
                            </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-2 d-xs-none"></div>
                </div>
            </div>
        </div>
        <div>
            <div class="container">
                <div class="row">
                    <?php
                    $cat = get_categories(
                        [
                            'taxonomy' => 'att_categorie'
                        ]);
                    $categorie = [];
                    /** @var WP_Term $categoria */
                    foreach ($cat as $categoria) {
                        $meta = recuperaMetaCategoriaDaId($categoria->term_id);
                        if ($categoria->parent == 0) {
                            $categorie[] = [
                                'title' => $categoria->name,
                                'img' => $meta['img'],
                                'color' => $meta['color'],
                                'link' => get_category_link($categoria->term_id)
                            ];
                        }
                    }

                    foreach ($categorie as $categoria) {
                        ?>
                        <div class="col-xs-12 col-sm-6 col-md-3 show-categoria_att" >
                            <div class="card position-relative" style="background-color: <?php echo $categoria['color'];?>">
                                <img src="<?php echo $categoria['img'] ?>" class="card-img" alt="...">
                                <div class="card-img-overlay position-absolute top-50 start-0">
                                    <div class="card-title card-title_att">
                                        <div class="card-title_title">
                                            <h5>
                                                <a style="color: #fcca4f" href="<?php echo $categoria['link'];?>">
                                                    <?php echo $categoria['title'];?></a></h5></div>
                                        <div class="card-title_background"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>
<?php
ugialla_get_bottom_template();

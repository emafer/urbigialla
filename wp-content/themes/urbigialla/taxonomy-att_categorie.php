<?php
ugialla_get_top_template();
?>
    <div class="container-fluid">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <h1> <?php single_term_title('', true); ?></h1>
                    </div>
                </div>
                <div class="row">
                    <?php
    while (have_posts()) {
        the_post();

        $categoriaTerm = get_term_by('name', single_term_title('', false), 'att_categorie');
        $categoria = recuperaMetaCategoriaDaId($categoriaTerm->term_id);
        ?>
        <div class="col-xs-12 col-sm-6 col-md-3 show-attivita-preview">
            <div class="card position-relative" style="background-color: <?php echo $categoria['color']; ?>">
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );?>
                <img src="<?php echo $image[0] ?>" class="card-img" alt="<?php echo $post->post_title; ?>">
                <div class="card-img-overlay position-absolute top-50 start-0">
                    <div class="card-title card-title_att">
                        <div class="card-title_title">
                            <h5>
                                <a style="color: #fcca4f" href="<?php echo get_permalink($post); ?>">
                                    <?php echo $post->post_title; ?></a></h5></div>
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

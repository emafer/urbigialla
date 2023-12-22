<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php //TODO qui short description ?>">
    <meta name="author" content="Urbigialla">
    <meta name="generator" content="Wordpress">
    <title>Urbigialla</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo get_template_directory_uri() . '';?>/vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() . '';?>/vendor/components/font-awesome/css/all.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() . '';?>/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" href="<?php echo getAssetFile('images', 'favicon.png'); ?>" sizes="150x150">
    <?php wp_head(); ?>
</head>
<body>
<header>
    <div class="row" style="margin-bottom: 5px">
        <div class="col">
            <a class="navbar-brand" href="/"><img alt="urbigialla" src="/wp-content/uploads/2022/03/logo-300x70.png" style="height: 40px"></a></div>
        <div class="col textright">
            <a class="btn" href="/wp-admin/" style="color: #fcca4f" title="Accedi" type="button">
                <span class="fa fa-user"></span>
            </a>

        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <?php
                    get_template_part ( 'menu' );
                ?>
        </div>
    </nav>
</header>
<div id="contenuto-principale" class="container">
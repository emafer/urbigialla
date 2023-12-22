<!DOCTYPE html>
<!--[if IE 8]><html class="no-js ie89 ie8" lang="it"><![endif]-->
<!--[if IE 9]><html class="no-js ie89 ie9" lang="it"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="it">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
	<meta name="referrer" content="same-origin">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php //TODO gestione keyword ?>">
    <meta name="description" content="<?php  echo madisoft_get_theme_option('madisoft_scuola_generale_descrizione_istituto', '') ; ?>">
    <meta name="author" content="<?php  echo trim( madisoft_get_theme_option('madisoft_scuola_istituto_nome', '') ) ; ?>">
    <link rel="icon" href="<?php echo madisoft_theme_favicon() ; ?>">
    <title> <?php bloginfo( 'name' ); if( wp_title('&raquo;', false)) {  wp_title(); } ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php madisoft_scuola_codice_custom_head(); ?>
    <link media="all" rel="stylesheet" href="<?php echo madisoft_scuola_get_assets_directory('font-awesome', true, 'css/all.css');?>">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
    <?php wp_head(); ?>
    <!-- HTML5shim per Explorer 8 -->
    <script src="<?php bloginfo('template_url'); ?>/webtoolkit/modernizr.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/webtoolkit/jquery.min.js"></script>
    <style>
	.aligncenter {
    display: block;
    float: none;
    margin: 0 auto;
}
    @media only screen and (max-width: 600px) {
			.mobileHidden{
				display: none;
			}
			.mobile20{
				max-width: 20%;
			}
			.logo_text, 
			.centermobile {
				text-align: center;
				padding-left: 30px;
			}
		}
        .post_evidence_img:hover {
            cursor: pointer;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .navbar-brand img {
            display: none;
        }
        .is-sticky .navbar-brand img {
            display: block;
        }
        .container-fluid.menu {padding: 0;}
        .container-fascia.pari .contenuto-fascia {
            background-color: #ffffff !important;
        }
        .card {
            border: none !important;;
        }
		#solomobile {
       height: 100%;
       width: 0;
       position: fixed;
       z-index: 101;
       top:0;
       left:0;
       background-color: <?php echo madisoft_get_theme_option( 'madisoft_scuola_grafica_colore_principale', '#0066cc' );?>;
       overflow-x: hidden;
       transition: 0.5s;
       padding-top: 60px;
   }
   #solomobile a {
       padding: 8px 8px 8px 32px;
       text-decoration: none;
       font-size: 1em;
       color: <?php echo madisoft_get_theme_option( 'madisoft_scuola_grafica_colore_carattere_principale', '#ffffff' ) ?>;
       display: block;
       transition: 0.3s;
   }
   #solomobile a:hover {
       color: #f1f1f1;
   }
   #solomobile ul {
       list-style: none;
   }
   #solomobile .closeButton {
       position: absolute;
       top: 35px;
       right: 25px;
       font-size: 36px;
       margin-left: 50px;
   }
        #loginformHeader label {
            display: block;
            font-weight: bolder;
            margin-bottom: 0;
            color: #000;
        }
    </style>
</head>
<?php
$bodyClass = 'pagina-' . get_the_ID();
if( is_front_page()) {$bodyClass .=' homepage';}
if (madisoft_get_theme_option('madisoft_scuola_usa_bordi', 'on') == 'off') {
    $bodyClass .= ' nobordi';
}
?>
<body class="<?php echo $bodyClass; ?>">
<div>
    <header id="header-website">
        <?php
        get_template_part('include/templates/rapidcontact');
        ?>
        <div class="testata">
            <?php
            $classelarghezza = madisoft_get_theme_option('madisoft_scuola_testata_larghezza', 'container-fluid')
                . ottieniClasseNoPaddingLeft();

            ?>
			<div class="<?php echo $classelarghezza; ?>">
				<h1 class="screen-reader-text"><?php bloginfo( 'name' );?></h1>
				<?php
				//todo rimuovere madisoft_scuola_testata_template
				get_template_part ( 'include/templates/headers/header' );
				?>
			</div>
        </div>
        <div class="container-fluid menu">
            <?php
            get_template_part ( 'menu' );
            ?>
        </div>
    </header>
</div>
    <!-- chiusura testata -->

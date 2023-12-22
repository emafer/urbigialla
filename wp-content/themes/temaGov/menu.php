<div class="row menu-principale-position">
    <div class="container-fluid">
<?php
$id = 'menu-orizzontale-principale';
$menu = 'menu-2';
$themeLocation = 'menu-2';
madisoftThemeCreaMenu($id, $menu, $themeLocation, true, 'menu-mobile');
?>
    </div>
</div>
    <div id="solomobile" class="solomobile">
        <?php
        $id = 'menu-mobile';
        $menu = 'menu-2';
        $themeLocation = 'menu-2';
        madisoftThemeCreaMenu($id, $menu, $themeLocation, false);
        ?>
    </div>
<?php
if (!isset($args)) {
    $args =[];
}
if (!isset($args['class'])) {
    $args['class'] = 'social_footer';
}
    $class_icon = $args['class'] . '_icon';
    $class_div = $args['class'];
if (attivareMenuSocial()) { ?>
    <div class="<?php echo $class_div; ?> text-right">
        <div class="<?php echo $class_div; ?>_text">
            <p>Seguici su:</p>
        </div>
        <?php echo printFacebook($class_icon); ?>
        <?php echo printYoutube($class_icon); ?>
        <?php echo printTwitter($class_icon); ?>
        <?php echo printFlickr($class_icon); ?>
        <?php echo printSlideShare($class_icon); ?>
        <?php echo printInstagram($class_icon); ?>
    </div>
<?php }
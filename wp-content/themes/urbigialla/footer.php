</div> <!-- chiusura corpo centrale -->
<footer>
    <?php
    wp_register_script( 'bootstrapjs', get_template_directory_uri() . '/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js', array( 'jquery' ) );
    wp_enqueue_script('bootstrapjs');
    wp_footer();
    ?>
</footer>
</body>
</html>
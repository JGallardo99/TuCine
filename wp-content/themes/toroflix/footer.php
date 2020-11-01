<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Toroflix
 */

?>
    </div>
    <!--</Body>-->

    <!--<Footer>-->
    <footer class="Footer">
        <?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
        <div class="Top">
            <div class="Container">
                <div class="Rows DF D04"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
            </div>
        </div>
        <?php } ?>
        <div class="Bot">
            <div class="Container">
                <p><?php echo tp_link_footer(); ?></p>
            </div>
        </div>
    </footer>
    <!--</Footer>-->

</div>
<!--</Tf-Wp>-->

<?php wp_footer(); ?>
<!--[ToroThemes]><CSS Framework v6.0><[contacto@torothemes.com]-->

</body>
</html>
<?php
/**
 * Toroflix widgets
 * @package Toroflix
 */
if ( class_exists('WP_Widget') ) {  

    require get_template_directory().'/inc/widgets/widget-trpost.php';
    require get_template_directory().'/inc/widgets/widget-trabc.php';
    require get_template_directory().'/inc/widgets/widget-trsearch.php';
    require get_template_directory().'/inc/widgets/widget-trads.php';
    require get_template_directory().'/inc/widgets/widget-trtextfooter.php';
    
    if ( !function_exists('toroflix_theme_register_widgets') ) {
        function toroflix_theme_register_widgets() {
            register_widget('WP_Widget_Tr_Posts');
            register_widget('WP_Widget_Tr_Abc');
            register_widget('WP_Widget_Tr_Search');
            register_widget('WP_Widget_Tr_Ads');
            register_widget('WP_Widget_Tr_Textfooter');
        }
    }

    add_action('widgets_init', 'toroflix_theme_register_widgets'); 

}
?>
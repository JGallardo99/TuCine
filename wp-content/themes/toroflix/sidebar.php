<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Toroflix
 */

if ( is_active_sidebar( 'sidebar-1' ) and toroflix_config('sidebar', 3)!=2 ) {
?>
<!--<Aside>-->
<aside>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
<!--</Aside>-->
<?php } ?>
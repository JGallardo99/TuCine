<?php 
/*Toggle Menu*/
if ( ! function_exists( 'header_container_MenuBtn' ) ) {
    function header_container_MenuBtn() { ?>
        <span class="MenuBtn AATggl CXHd" data-tggl="Tf-Wp"><i></i><i></i><i></i></span>
    <?php }
}
add_action( 'header_container', 'header_container_MenuBtn', 10 );


/*Search Form*/
if ( ! function_exists( 'header_container_Search' ) ) {
	function header_container_Search() { ?>
        <div class="Search">
            <?php get_search_form(); ?>
        </div>
		
	<?php }
}
add_action( 'header_container', 'header_container_Search', 20 );


/*Logotype*/
if ( ! function_exists( 'header_container_Logo' ) ) {
	function header_container_Logo() { ?>              
        <figure class="Logo">
            <?php if(get_custom_logo()) { 
                the_custom_logo();
            } else { ?>
                <a href="<?php echo esc_url( home_url() ); ?>">
                    <img src="<?php echo TOROFLIX_DIR_URI; ?>public/img/toroflix-logo.svg" alt="GoldregisterFlix">
                </a>
            <?php } ?>
        </figure>
	<?php }
}
add_action( 'header_container', 'header_container_Logo', 30 );


/*Navigation*/
if ( ! function_exists( 'header_container_Menu' ) ) {
    function header_container_Menu() { ?>
        <nav class="Menu">
            <?php if ( has_nav_menu( 'header' ) ) {
                wp_nav_menu(
                    array(
                        'menu'              =>  'Menuh', 
                        'theme_location'    =>  'header',
                        'container'         =>  false,
                        'items_wrap'        =>  '<ul>%3$s</ul>',
                    )
                );
            } ?>
        </nav>
    <?php }
}
add_action( 'header_container', 'header_container_Menu', 40 );
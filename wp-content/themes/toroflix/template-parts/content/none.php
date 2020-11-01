<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroflix
 */

?>     
<section class="error-404 not-found AAIco-sentiment_very_dissatisfied">
    <header class="Top">
        <h1 class="Title"><?php esc_html_e( 'Oops! Essa página pode ser encontrada.', 'toroflix' ); ?></h1>
        <p><?php esc_html_e( 'Parece que nada foi encontrado neste local. Talvez tente um dos links abaixo ou uma pesquisa?', 'toroflix' ); ?></p>
    </header><!-- .page-header -->
    <div class="page-content">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

            <p><?php printf( __( 'pronto para publicar seu primeiro post? <a href="%1$s">Comece aqui</a>.', 'toroflix' ), esc_url( admin_url( 'admin.php?page=tr-movies-movie&action=add' ) ) ); ?></p>

        <?php elseif ( is_search() ) : ?>

            <p><?php _e( 'Desculpe, mas nada corresponde aos seus termos de pesquisa. Por favor, tente novamente com algumas palavras-chave diferentes.', 'toroflix' ); ?></p>
            <?php get_search_form(); ?>

        <?php else : ?>

            <p><?php _e( 'Parece que não podemos encontrar o que você está procurando. Talvez a pesquisa possa ajudar.', 'toroflix' ); ?></p>
            <?php get_search_form(); ?>

        <?php endif; ?>
    </div><!-- .page-content -->
</section>                		    
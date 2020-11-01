<section class="error-404 not-found AAIco-sentiment_very_dissatisfied">
    <header class="Top">
        <h1 class="Title"><?php esc_html_e( 'Ops! Essa página pode ser encontrada.', 'toroflix' ); ?></h1>
        <p><?php esc_html_e( 'Parece que nada foi encontrado neste local. Talvez tente um dos links abaixo ou uma pesquisa?', 'toroflix' ); ?></p>
    </header><!-- .page-header -->
    <aside class="page-content">
         <?php the_widget( 'WP_Widget_Tr_Search', array( 'show_geners' => true, 'show_cast' => true, 'show_countries' => true, 'show_directors' => true, 'show_years' => true, 'show_quality' => true, 'show_lang' => true, 'show_server' => true ), array( 'before_widget' => '<div class="Wdgt tr_search">', 'before_title' => '<div class="Title">', 'after_title' => '</div>' ) ); ?> 
    </aside><!-- .page-content -->
</section><!-- .error-404 -->      
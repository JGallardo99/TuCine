<?php
/**
 * The template for displaying taxonomy letters page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroflix
 */
get_header(); ?>

<!--<Main>-->
<div class="Main Container">
    
    <?php tr_banners('ads_hd_bt'); ?>

    <article>
        <div class="Top AAIco-sort_by_alpha">
            <?php tr_title('letters', 'Title'); ?>
        </div>
        
        <?php
        if ( function_exists( 'tr_alphabet' ) ) :
            tr_alphabet();
        endif;
        ?>
        
        <?php
            $current = $wp_query->queried_object;
            $paged = ( get_query_var( 'trpage' ) ) ? get_query_var( 'trpage' ) : 1;

            $args = array(

                'post_type' => 'post',
                'letters' => '',
                '_name__like' => $current->slug,
                'posts_per_page' => toroflix_config('posts_per_alphabet', 20),
                'paged' => $paged,
                'orderby' => 'name',
                'order' => 'asc',
                'ignore_sticky_posts' => 1

            );
            query_posts($args);
            if ( have_posts() ) :

            global $wp_query;
        ?>

        <!--<TPTblCn>-->
        <div class="TPTblCn TPTblCnMvs">
            <table>
                <thead>
                    <tr>
                        <th><?php _e('#', 'toroflix'); ?></th>
                        <th colspan="2"><?php printf( __('%s Results', 'toroflix'), $wp_query->found_posts ); ?></th>
                        <th><?php _e('YEAR', 'toroflix'); ?></th>
                        <th><?php _e('Quality', 'toroflix'); ?></th>
                        <th><?php _e('Duration', 'toroflix'); ?></th>
                        <th><?php _e('Genres', 'toroflix'); ?></th>
                        <?php if(function_exists('the_ratings')){ ?><th><?php _e('VOTES', 'toroflix'); ?></th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                   
                    <?php
                        $i=1;
                        // Start the loop.
                        while ( have_posts() ) : the_post();
                        $trmovieslinks = unserialize(ntr_config('field_link'));
                        if(isset($trmovieslinks[0]['quality'])){
                            $quality = get_term_by( 'id', $trmovieslinks[0]['quality'], 'quality' );
                        }
                        if(isset($trmovieslinks[0]['lang'])){
                            $lang = get_term_by( 'id', $trmovieslinks[0]['lang'], 'language' );
                        }
                        if($i<=9){ $zero='0'; }else{ $zero=''; }
                    
                        $date_field = get_post_meta($post->ID, TR_MOVIES_FIELD_DATE, true);
                        $date_field_year = $date_field;
                        if($date_field!=''){
                            $date_field = explode('-', $date_field);
                            $date_field_year = $date_field['0'] == '' ? __('Unknown', 'toroflix') : $date_field['0'];
                        }
                    
                        $runtime_field = get_post_meta($post->ID, TR_MOVIES_FIELD_RUNTIME, true);
                        if(tr_check_type($post->ID)==2 and is_array($runtime_field)){
                            $runtime_field = implode('m, ', $runtime_field).'m ';
                        }elseif(tr_check_type($post->ID)==2 and !is_array($runtime_field)){
                            $runtime_field = implode('m, ', explode(',', $runtime_field)).'m';
                        }else{
                            $runtime_field = $runtime_field;
                        }
                    ?>
                    
                    <tr>
                        <td><span class="Num"><?php echo $zero.$i; ?></span></td>
                        <td class="MvTbImg">
                            <a href="<?php the_permalink(); ?>" class="MvTbImg">
                                <?php echo tr_theme_img(get_the_ID(), 'img-mov-xsm', get_the_title()); ?>
                                <?php if(tr_check_type(get_the_ID())==2){ echo'<span class="TpTv BgA">'.__('TV', 'toroflix').'</span>'; } ?>
                            </a>
                        </td>
                        <td class="MvTbTtl">
                            <a href="<?php the_permalink(); ?>" class="MvTbImg">
                                <strong><?php the_title(); ?></strong> 
                            </a>
                        </td>
                        <td><?php echo $date_field_year; ?></td>
                        <td>
                            <p class="Info">
                                <span class="Qlty"><?php if(isset($quality->name)){ echo $quality->name; }else{ _e('Unknown', 'toroflix'); } ?></span>
                            </p>
                        </td>
                        <td><?php echo $runtime_field; ?></td>
                        <td>
                            <?php
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) {
                                    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                                }
                            ?>
                        </td>
                        <?php if(function_exists('the_ratings')){ ?><td><?php the_ratings(); ?></td><?php } ?>
                    </tr>
                    
                    <?php
                        $i++;
                        // End the loop.
                        endwhile;
                    ?>

                </tbody>
            </table>
        </div>
        <!--</TPTblCn>-->
    </article>

    <?php
        if(function_exists('tr_pagination')) :
            tr_pagination();
        endif;
    ?>
    
    <?php
        // If no content, include the "No posts found" template.
        else :
            get_template_part( 'template-parts/content/none' );

        endif;
    ?>

</div>
<!--</Main>-->   

<?php get_footer(); ?>
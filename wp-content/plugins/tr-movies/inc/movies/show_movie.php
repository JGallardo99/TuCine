<?php
if ( !defined('NONCE_KEY') ) die('Die!');

    $ok = '';

    if(isset($_GET['action']) and $_GET['action']=='del' and isset($_GET['id']) and intval($_GET['id'])){

        wp_delete_post(intval($_GET['id']));
        
        echo '
            <script type="text/javascript">
                window.location = "'.admin_url('admin.php?page=tr-movies-movie&action=tr-movies-movie&msjdel=1').'";
            </script>
        ';
        
    }
                                               
    if(isset($_GET['msjdel'])){
        
        $ok='<p class="msjadm-ok">'.__('The movie was successfully deleted.', TRMOVIES).'</p>';
                    
    }

    $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
    $s = isset($_GET['s']) ? esc_html($_GET['s']) : '';
    $cat = isset($_GET['cat']) ? intval($_GET['cat']) : '';
    $per_page = 20;

    if( isset($_GET['abc']) ) {

        $args = array(

            'posts_per_page' => $per_page,
            'post_type' => 'post',
            's' => $s,
            'cat' => $cat,
            'paged' => $paged,
            '_name__like' => wp_strip_all_tags( $_GET['abc'] ),
            'meta_query' => array(
            'relation' => 'OR',

            array(
                'key' => 'tr_post_type',
                'value' => false,
                'type' => 'BOOLEAN'
            ),
            array(
                'key' => 'tr_post_type',
                'compare' => 'NOT EXISTS'
            )
            ),

        );

    }else{

        $args = array(

            'posts_per_page' => $per_page,
            'post_type' => 'post',
            'paged' => $paged,
            's' => $s,
            'cat' => $cat,
            'meta_query' => array(
            'relation' => 'OR',

            array(
                'key' => 'tr_post_type',
                'value' => false,
                'type' => 'BOOLEAN'
            ),
            array(
                'key' => 'tr_post_type',
                'compare' => 'NOT EXISTS'
            )
            ),

        );

    }

    $query_movies = new WP_Query( $args );
    $number = $query_movies->found_posts;
    $pagination = '';
?>
<section>

    <div class="Top">
        <h1><?php _e('Movies List', TRMOVIES); ?></h1>
        <?php tr_movies_menu(); ?>
    </div>    

    <?php echo $ok; ?>

    <?php
    if ( $query_movies->have_posts() ) {
    ?>
    <?php
    
        $big = 999999999;

        $pagination = '<div class="wp-pagenavi">'.paginate_links(array(
            'base' => 'admin.php?paged='.str_replace($big, '%#%', $big),
            'format' => '?paged=%#%',
            'current' => $paged,
            'total' => ceil($number / $per_page)
        )).'</div>';
        
        echo $pagination;
        
    ?>
   
    <div class="Wdgt">
        <div class="TPTblCn TPTblCnMvs">
            <div class="SrchTop Clfx">
                <!--<AZList>-->
                <div class="SrchAz">
                    <span><?php _e('Search by letter', TRMOVIES); ?> <i class="dashicons dashicons-arrow-down-alt2"></i></span>
                    <ul class="AZList">
                        <li<?php if(!isset($_GET['abc'])){ echo' class="Current"'; } ?>><a href="admin.php?page=tr-movies-movie"><?php _e('All', TRMOVIES); ?></a></li>
                        <li<?php if(isset($_GET['abc']) and $_GET['abc']=='0-9'){ echo' class="Current"'; } ?>><a href="admin.php?page=tr-movies-movie&abc=0-9">#</a></li>
                        <?php
                            for($i=65; $i<=90; $i++) {  
                                $letters = chr($i);
                                if(isset($_GET['abc']) and $_GET['abc']==$letters){ $class=' class="Current"'; }else{ $class=''; }
                                echo '<li'.$class.'><a href="admin.php?page=tr-movies-movie&abc='.$letters.'">'.$letters.'</a></li>';  
                            }
                        ?>
                    </ul>
                </div>
                <!--</AZList>-->
                
                <div class="SrchFm">
                    <form action="admin.php?page=tr-movies-movie" method="get">
                        <div class="FltrCats">
                            <select name="cat">
                                <option value=""><?php _e('All', TRMOVIES); ?></option>
                                <?php
                                    $categories = get_categories( array(
                                        'orderby' => 'name',
                                        'hide_empty' => false
                                    ) );
                                    foreach ( $categories as $category ) {
                                        echo '<option '.selected( $category->term_id, intval($_GET['cat']), false ).' value="'.$category->term_id.'">'.$category->name.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <input value="<?php if(isset($_GET['s'])){ echo esc_attr(apply_filters( 'get_search_query', $_GET['s'] )); } ?>" name="s" type="text" placeholder="<?php _e('Search...', TRMOVIES); ?>">
                        <input type="hidden" name="page" value="tr-movies-movie">
                        <button type="submit"><i class="dashicons dashicons-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="TblCnAdm">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="ThClA" colspan="2"><?php echo $query_movies->found_posts.' '.__('Results', TRMOVIES); ?></th>
                            <th><?php _e('YEAR', TRMOVIES); ?></th>
                            <th><?php _e('Duration', TRMOVIES); ?></th>
                            <th><?php _e('Options', TRMOVIES); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i=1;
                       
                        while ( $query_movies->have_posts() ) {
                        $query_movies->the_post();

                        if($i<=9){ $zero='0'; }else{ $zero=''; }
                    ?>
                        <tr>
                            <td><span class="Num"><?php echo $zero.$i; ?></span></td>
                            <td class="MvTbImg TdClA">
                                <a href="admin.php?page=tr-movies-movie&action=edit&id=<?php echo get_the_ID(); ?>" class="MvTbImg"><?php echo trmovies_img(get_the_ID(), 'img-mov-xsm', get_the_title()); ?></a>
                            </td>
                            <td class="MvTbTtl TdClB">
                                <a href="admin.php?page=tr-movies-movie&action=edit&id=<?php echo get_the_ID(); ?>" class="MvTbImg">
                                    <strong><?php the_title(); ?></strong> 
                                </a>
                            </td>
                            <td>
                            <?php 
                                if(ntr_config('field_date_year')!=''){ echo ntr_config('field_date_year'); }else{ _e('Unknown', TRMOVIES); }
                            ?>
                            </td>
                            <td>
                            <?php if(ntr_config('field_runtime')!=''){ echo ntr_config('field_runtime'); }else{ _e('Unknown', TRMOVIES); } ?> </td>
                            <td class="td1ln"><a class="edtlnk" href="admin.php?page=tr-movies-movie&action=edit&id=<?php echo get_the_ID(); ?>"><i class="dashicons dashicons-edit"></i><?php _e('Edit', TRMOVIES); ?></a><a onclick="return confirm('<?php _e('Are you sure?', TRMOVIES); ?>')" class="dltlnk" href="admin.php?page=tr-movies-movie&action=del&id=<?php echo get_the_ID(); ?>"><i class="dashicons dashicons-trash"></i><?php _e('Delete', TRMOVIES); ?></a></td>
                        </tr>

                    <?php
                        $i++;

                        }
                    ?>

                    </tbody>
                </table>
            </div>
            <?php
            wp_reset_postdata();
            }else{
            ?>
            <p class="trnocontent msjadm-error"><a href="admin.php?page=tr-movies-movie&action=add"><?php _e('No movie has been published, click here to start publishing.', TRMOVIES); ?></a></p>
            
            <?php } ?>

        </div>
    </div>

    <?php
    
        echo $pagination;
        
    ?>
</section>
<?php
/**
 * TR Posts widget.
 */
class WP_Widget_Tr_Posts extends WP_Widget {

	/**
	 * Sets up a new Tr Posts widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_postlist',
			'description' => __( 'List of posts with different designs and order.', 'toroflix' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'tr-posts', __( 'Tr Posts', 'toroflix' ), $widget_ops );
		$this->alt_option_name = 'widget_postlist';
	}

	/**
	 * Outputs the content for the current Tr Posts widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'toroflix' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
        
		$order = isset( $instance['order'] ) ? $instance['order'] : 1;
        $filter = $instance['filter'];
		$design = isset( $instance['design'] ) ? $instance['design'] : 0;
        
        if($order==1){

            $args_query=array(

                'posts_per_page'      => $number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true,
                'cat' => $filter,
                'order' => 'DESC',
                'orderby' => 'date',

            );

        }elseif($order==2){

            $args_query=array(

                'posts_per_page'      => $number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true,
                'cat' => $filter,
                'meta_key' => 'views',
                'orderby' => 'meta_value_num',

            );

        }elseif($order==3){


            $args_query=array(

                'posts_per_page'      => $number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true,
                'cat' => $filter,
                'meta_key' => 'ratings_average',
                'orderby' => 'meta_value_num',

            );

        }else{

            $args_query=array(

                'posts_per_page'      => $number,
                'no_found_rows'       => true,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true,
                'cat' => $filter,
                'orderby' => 'rand',

            );

        }

		/**
		 * Filters the arguments for the Tr Posts widget.
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
        if ( false === ( $r = get_transient( 'trposts'.$order.$number.$filter.'_query_results' ) ) and $order!=1 ) {

            $r = new WP_Query( apply_filters( 'widget_posts_args', $args_query ) );
            set_transient( 'trposts'.$order.$number.$filter.'_query_results' , $r, 12 * HOUR_IN_SECONDS );
            
        }
        
        if($order==1){
            $r = new WP_Query( apply_filters( 'widget_posts_args', $args_query ) );            
        }

		if ($r->have_posts()) :
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<?php if($design==1){ ?>
		<ul class="MovieList">
		<?php }else{ ?>
        <div class="TpSbList">
            <ul class="MovieList Rows AF A04">
		<?php } ?>
		<?php $i=1; while ( $r->have_posts() ) : $r->the_post(); ?>
            <?php if($design==1){ ?>
            <li>
                <div class="TPost C">
                    <a href="<?php the_permalink(); ?>">
                        <span class="Top"><?php echo $i; ?></span>
                        <div class="Image"><figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo tr_theme_img(get_the_ID(), 'img-mov-sm', get_the_title()); ?></figure></div>
                        <div class="Title"><?php the_title(); ?><?php if(tr_check_type(get_the_ID())==2){ echo' <span class="TpTv BgA">'.__('TV', 'toroflix').'</span>'; } ?></div>
                    </a>
                    <div class="Info">
                        <?php toroflix_entry_header(); ?>
                    </div>
                </div>
            </li>
            <?php }else{ ?>
            <li>
                <div class="TPost B">
                    <a href="<?php the_permalink(); ?>">
                        <div class="Image"><figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo tr_theme_img(get_the_ID(), 'img-mov-sm', get_the_title()); ?></figure><?php if(tr_check_type(get_the_ID())==2){ echo' <span class="TpTv BgA">'.__('TV', 'toroflix').'</span>'; } ?></div>
                        <div class="Title"><?php the_title(); ?></div>
                    </a>
                </div>
            </li>
            <?php } ?>
		<?php $i++; endwhile; ?>
		<?php if($design==1){ ?>
        </ul>
        <?php }else{ ?>
        </ul></div>
        <?php } ?>
		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
	}

	/**
	 * Handles updating the settings for the current Tr Posts widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['order'] = isset( $new_instance['order'] ) ? (int) $new_instance['order'] : false;
        $instance['filter'] = strip_tags(implode(',', $new_instance['filter']));
		$instance['design'] = isset( $new_instance['design'] ) ? (int) $new_instance['design'] : 0;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Tr Posts widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$order = isset( $instance['order'] ) ? (int) $instance['order'] : false;
		$filter = isset($instance['filter']) ? $instance['filter'] :false;
		$design = isset( $instance['design'] ) ? absint($instance['design']) : 0;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'toroflix' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'toroflix' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order', 'toroflix'); ?></label>
            <select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
                <option<?php selected($order, 1 ); ?> value="1"><?php _e('Latest', 'toroflix'); ?></option>
                <option<?php selected($order, 2 ); ?> value="2"><?php _e('Views (Require WP-PostViews)', 'toroflix'); ?></option>
                <option<?php selected($order, 3 ); ?> value="3"><?php _e('Best rated (Require WP-PostRatings)', 'toroflix'); ?></option>
                <option<?php selected($order, 4 ); ?> value="4"><?php _e('Random', 'toroflix'); ?></option>
            </select>                
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'design' ); ?>"><?php _e( 'Design', 'toroflix' ); ?></label>
            <select id="<?php echo $this->get_field_id( 'design' ); ?>" name="<?php echo $this->get_field_name( 'design' ); ?>">
                <option value="0" <?php selected( $design, 0 ); ?>>
                    <?php _e('List', 'toroflix'); ?>
                </option>
                <option value="1" <?php selected( $design, 1 ); ?>>
                    <?php _e('Box', 'toroflix'); ?>
                </option>
            </select>
        </p>
        
		<p><?php _e('Filter categories', 'toroflix'); ?></p>
		<ul>
            <?php
            $lst=''; $ar='';
        
                $ar=explode(',', $filter);
                foreach ($ar as &$value) {
                    $lst[$value] = $value;
                }
                $categories = get_categories('hide_empty=0');
                foreach ($categories as $category) {
            ?>
		    <li>
		        <input <?php if(isset($lst[$category->term_id])){checked( $lst[$category->term_id], $category->term_id); } ?> type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('filter'); ?>[]" value="<?php echo $category->term_id; ?>"  />
		        <label><?php echo $category->cat_name ?></label><br />
		    </li>
		    <?php
                }
            ?>
		</ul>
<?php
	}
}
<?php
/**
 * TR Text Footer widget.
 */
class WP_Widget_Tr_Textfooter extends WP_Widget {

	/**
	 * Sets up a new Tr Text Footer widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_textfot',
			'description' => __( 'Add text in footer.', 'toroflix' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'tr-textfooter', __( 'Tr Text Footer', 'toroflix' ), $widget_ops );
		$this->alt_option_name = 'widget_textfot';
	}

	/**
	 * Outputs the content for the current Tr Abc widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        
		$widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';
        
		$facebook = ( ! empty( $instance['facebook'] ) ) ? $instance['facebook'] : '';
		$googleplus = ( ! empty( $instance['googleplus'] ) ) ? $instance['googleplus'] : '';
		$twitter = ( ! empty( $instance['twitter'] ) ) ? $instance['twitter'] : '';
        
		echo $args['before_widget'];
    ?>
        <figure class="Logo">
            <?php
                if(!get_custom_logo()){
                    echo '<img src="'.get_template_directory_uri().'/img/toroflix-logo.svg" alt="'.get_bloginfo( 'name' ).'" class="custom-logo">';
                }else{
                    the_custom_logo();
                }
            ?>
        </figure>
        <?php echo wpautop( $widget_text ); ?>
        <?php if($facebook!='' or $twitter !='' or $googleplus!=''){ ?>
        <ul class="SocialList">
            <?php if($facebook){ ?>
            <li><a rel="nofollow" target="_blank" href="<?php echo $facebook; ?>" class="fa-facebook"></a></li>
            <?php } ?>
            <?php if($twitter){ ?>
            <li><a rel="nofollow" target="_blank" href="<?php echo $twitter; ?>" class="fa-twitter"></a></li>
            <?php } ?>
            <?php if($googleplus){ ?>
            <li><a rel="nofollow" target="_blank" href="<?php echo $googleplus; ?>" class="fa-google-plus"></a></li>
            <?php } ?>
        </ul>
        <?php } ?>
    <?php
        echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Tr Text Footer widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['facebook'] = sanitize_text_field( $new_instance['facebook'] );
		$instance['googleplus'] = sanitize_text_field( $new_instance['googleplus'] );
		$instance['twitter'] = sanitize_text_field( $new_instance['twitter'] );
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = wp_kses_post( stripslashes( $new_instance['text'] ) );
		return $instance;
	}

	/**
	 * Outputs the settings form for the Tr Text Footer widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title          = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$facebook       = isset( $instance['facebook'] ) ? esc_attr( $instance['facebook'] ) : '';
		$googleplus     = isset( $instance['googleplus'] ) ? esc_attr( $instance['googleplus'] ) : '';
		$twitter        = isset( $instance['twitter'] ) ? esc_attr( $instance['twitter'] ) : '';
        $text           = isset($instance['text']) ? esc_textarea( $instance['text'] ) : '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'toroflix' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook:', 'toroflix' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo $facebook; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter:', 'toroflix' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo $twitter; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e( 'Google+:', 'toroflix' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" type="text" value="<?php echo $googleplus; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Footer Text:', 'toroflix' ); ?></label>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
        </p>
<?php
	}
}
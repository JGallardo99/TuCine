<?php
/**
 * TR Search widget.
 */
class WP_Widget_Tr_Search extends WP_Widget {

	/**
	 * Sets up a new Tr Search widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'tr_search',
			'description' => __( 'Advanced search widget.', 'toroflix' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'tr-search', __( 'Tr Search', 'toroflix' ), $widget_ops );
		$this->alt_option_name = 'tr_search';
	}

	/**
	 * Outputs the content for the current Tr Search widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Search', 'toroflix' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        
		$show_geners = isset( $instance['show_geners'] ) ? $instance['show_geners'] : false;
		$show_cast = isset( $instance['show_cast'] ) ? $instance['show_cast'] : false;
		$show_countries = isset( $instance['show_countries'] ) ? $instance['show_countries'] : false;
		$show_directors = isset( $instance['show_directors'] ) ? $instance['show_directors'] : false;
		$show_years = isset( $instance['show_years'] ) ? $instance['show_years'] : false;
		$show_quality = isset( $instance['show_quality'] ) ? $instance['show_quality'] : false;
		$show_lang = isset( $instance['show_lang'] ) ? $instance['show_lang'] : false;
		$show_server = isset( $instance['show_server'] ) ? $instance['show_server'] : false;
        
		echo $args['before_widget'];
		
        if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} 
        ?>
        <div class="SearchMovies">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" id="trfilter" autocomplete="off">
                <input type="hidden" name="s" value="trfilter">
                <input type="hidden" name="trfilter" value="1">
                <?php if($show_years){ ?>
                <!--<select>-->
                <div class="Frm-Slct">
                    <label class="AAIco-date_range"><?php _e('Ano', 'toroflix'); ?></label>
                    <div class="Form-Group">
                        <select class="Select-Md" name="years[]" multiple="multiple">
                            <?php 
                                for ($iyear = 1888; $iyear <= date('Y'); $iyear++) {
                                    echo '<option>'.$iyear.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                
                <?php if($show_directors){ ?>
                <!--<select>-->
                <div class="Frm-Slct" id="trfilterdirectors">
                    <label class="AAIco-videocam"><?php _e('Diretores', 'toroflix'); ?></label>
                    <div class="Form-Group">
                        <?php
                            $directors = get_categories( array(
                                'orderby' => 'name',
                                'taxonomy' => 'Diretores'
                            ) );
                        ?>                       
                        <script type="text/javascript">
                        <?php
                        echo 'var tr_arr_directors = [';
                        foreach ( $directors as $director ) {

                        echo '"'.strtolower($director->name).'|'.$director->term_id.'",';
                        }
                        echo '];';
                        ?>

                        </script>
                        <ul class="trsrclst"></ul>
                        <label class="Form-Icon Right"><input class="tpsuggets tpsuggets_directors" data-name="trdirectors" type="text" placeholder="<?php _e('Write the name', 'toroflix'); ?>"></label>
                        <div style="display:none" class="trsrcbx"><div></div></div>
                    </div>
                </div>
                <!--</select>-->
                <?php }else{ echo '<script type="text/javascript">var tr_arr_directors = [] ;</script>'; } ?>
                
                <?php if($show_cast){ ?>
                <!--<select>-->
                <div class="Frm-Slct" id="trfiltercast">
                    <label class="AAIco-person"><?php _e('Elenco', 'toroflix'); ?></label>
                    <div class="Form-Group">
                        <?php
                            $casts = get_categories( array(
                                'orderby' => 'name',
                                'taxonomy' => 'Elenco'
                            ) );
                        ?>                       
                        <script type="text/javascript">
                            
                        <?php
                        echo 'var tr_arr_casts = [';
                        foreach ( $casts as $cast ) {

                        echo '"'.str_replace('"', '', strtolower($cast->name)).'|'.$cast->term_id.'",';
                        }
                        echo '];';
                        ?>
                        </script>
                        <ul class="trsrclst"></ul>
                        <label class="Form-Icon Right"><input class="tpsuggets tpsuggets_casts" data-name="casts" type="text" placeholder="<?php _e('Write the name', 'toroflix'); ?>"></label>
                        <div style="display:none" class="trsrcbx"><div></div></div>
                    </div>
                </div>
                <!--</select>-->
                <?php }else{ echo '<script type="text/javascript">var tr_arr_casts = [] ;</script>'; } ?>
                
                <?php if($show_countries){ ?>
                <!--<select>-->
                <div class="Frm-Slct" id="trfiltercountries">
                    <label class="AAIco-videocam"><?php _e('Países', 'toroflix'); ?></label>
                    <div class="Form-Group">
                        <?php
                            $countries = get_categories( array(
                                'orderby' => 'name',
                                'taxonomy' => 'country'
                            ) );
                        ?>                       
                        <script type="text/javascript">
                        <?php
                        echo 'var tr_arr_countries = [';
                        foreach ( $countries as $country ) {

                        echo '"'.strtolower($country->name).'|'.$country->term_id.'",';
                        }
                        echo '];';
                        ?>

                        </script>
                        <ul class="trsrclst"></ul>
                        <label class="Form-Icon Right"><input class="tpsuggets tpsuggets_countries" data-name="countries" type="text" placeholder="<?php _e('Write the name', 'toroflix'); ?>"></label>
                        <div style="display:none" class="trsrcbx"><div></div></div>
                    </div>
                </div>
                <!--</select>-->
                <?php }else{ echo '<script type="text/javascript">var tr_arr_countries = [] ;</script>'; } ?>
                
                <?php if($show_geners){ ?>
                <!--<select>-->
                <div class="Frm-Slct">
                    <label class="AAIco-movie_creation"><?php _e('Gêneros', 'toroflix'); ?></label>
                    <div class="Form-Group">
                        <?php
                            $categories = get_categories( array(
                                'orderby' => 'name',
                            ) );
                        ?>
                        <select name="geners[]" class="Select-Md" multiple="multiple">
                            <?php
                                foreach ( $categories as $category ) {
                            ?>
                                <option value="<?php echo $category->term_id; ?>"><?php echo esc_html( $category->name ); ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                
                <?php if($show_quality){ ?>
                <!--<select>-->
                <div class="Frm-Slct">
                    <label class="AAIco-equalizer"><?php _e('Qualidade', 'toroflix'); ?></label>
                    <div class="Form-Group">
                        <?php
                            $qualitys = get_categories( array(
                                'orderby' => 'name',
                                'taxonomy' => 'Qualidade'
                            ) );
                        ?>
                        <select class="Select-Md" name="qualitys[]" multiple="multiple">
                            <?php
                                foreach ( $qualitys as $quality ) {
                                    echo '<option value="'.$quality->term_id.'">'.$quality->name.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                
                <?php if($show_lang){ ?>
                <!--<select>-->
                <div class="Frm-Slct">
                    <label class="AAIco-language"><?php _e('Idioma', 'toroflix'); ?></label>
                    <div class="Form-Group">
                        <?php
                            $languages = get_categories( array(
                                'orderby' => 'name',
                                'taxonomy' => 'language'
                            ) );
                        ?>
                        <select class="Select-Md" name="langs[]" multiple="multiple">
                            <?php
                                foreach ( $languages as $lang ) {
                                    echo '<option value="'.$lang->term_id.'">'.$lang->name.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                
                <?php if($show_server){ ?>
                <!--<select>-->
                <div class="Frm-Slct">
                    <label class="AAIco-storage"><?php _e('Servidor', 'toroflix'); ?></label>
                    <div class="Form-Group">
                        <?php
                            $servers = get_categories( array(
                                'orderby' => 'name',
                                'taxonomy' => 'server'
                            ) );
                        ?>
                        <select class="Select-Md" name="servers[]" multiple="multiple">
                            <?php
                                foreach ( $servers as $server ) {
                                    echo '<option value="'.$server->term_id.'">'.$server->name.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <!--</select>-->
                <?php } ?>
                <button class="Button" type="submit"><?php _e('SEARCH', 'toroflix'); ?></button>
            </form>
        </div>
        <?php
        echo $args['after_widget'];        
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
		$instance['show_geners'] = isset( $new_instance['show_geners'] ) ? (bool) $new_instance['show_geners'] : false;
		$instance['show_cast'] = isset( $new_instance['show_cast'] ) ? (bool) $new_instance['show_cast'] : false;
		$instance['show_countries'] = isset( $new_instance['show_countries'] ) ? (bool) $new_instance['show_countries'] : false;
		$instance['show_directors'] = isset( $new_instance['show_directors'] ) ? (bool) $new_instance['show_directors'] : false;
		$instance['show_years'] = isset( $new_instance['show_years'] ) ? (bool) $new_instance['show_years'] : false;
		$instance['show_quality'] = isset( $new_instance['show_quality'] ) ? (bool) $new_instance['show_quality'] : false;
		$instance['show_lang'] = isset( $new_instance['show_lang'] ) ? (bool) $new_instance['show_lang'] : false;
		$instance['show_server'] = isset( $new_instance['show_server'] ) ? (bool) $new_instance['show_server'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Tr Posts widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$show_geners = isset( $instance['show_geners'] ) ? (bool) $instance['show_geners'] : true;
		$show_cast = isset( $instance['show_cast'] ) ? (bool) $instance['show_cast'] : true;
		$show_countries = isset( $instance['show_countries'] ) ? (bool) $instance['show_countries'] : true;
		$show_directors = isset( $instance['show_directors'] ) ? (bool) $instance['show_directors'] : true;
		$show_years = isset( $instance['show_years'] ) ? (bool) $instance['show_years'] : true;
		$show_quality = isset( $instance['show_quality'] ) ? (bool) $instance['show_quality'] : true;
		$show_lang = isset( $instance['show_lang'] ) ? (bool) $instance['show_lang'] : true;
		$show_server = isset( $instance['show_server'] ) ? (bool) $instance['show_server'] : true;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'toroflix' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_geners ); ?> id="<?php echo $this->get_field_id( 'show_geners' ); ?>" name="<?php echo $this->get_field_name( 'show_geners' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_geners' ); ?>"><?php _e( 'Display filter gener?', 'toroflix' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_cast ); ?> id="<?php echo $this->get_field_id( 'show_cast' ); ?>" name="<?php echo $this->get_field_name( 'show_cast' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_cast' ); ?>"><?php _e( 'Display filter cast?', 'toroflix' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_countries ); ?> id="<?php echo $this->get_field_id( 'show_countries' ); ?>" name="<?php echo $this->get_field_name( 'show_countries' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_countries' ); ?>"><?php _e( 'Display filter countries?', 'toroflix' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_directors ); ?> id="<?php echo $this->get_field_id( 'show_directors' ); ?>" name="<?php echo $this->get_field_name( 'show_directors' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_directors' ); ?>"><?php _e( 'Display filter directors?', 'toroflix' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_years ); ?> id="<?php echo $this->get_field_id( 'show_years' ); ?>" name="<?php echo $this->get_field_name( 'show_years' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_years' ); ?>"><?php _e( 'Display filter year?', 'toroflix' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_quality ); ?> id="<?php echo $this->get_field_id( 'show_quality' ); ?>" name="<?php echo $this->get_field_name( 'show_quality' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_quality' ); ?>"><?php _e( 'Display filter quality?', 'toroflix' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_lang ); ?> id="<?php echo $this->get_field_id( 'show_lang' ); ?>" name="<?php echo $this->get_field_name( 'show_lang' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_lang' ); ?>"><?php _e( 'Display filter language?', 'toroflix' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_server ); ?> id="<?php echo $this->get_field_id( 'show_server' ); ?>" name="<?php echo $this->get_field_name( 'show_server' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_server' ); ?>"><?php _e( 'Display filter server?', 'toroflix' ); ?></label></p>
<?php
	}
}
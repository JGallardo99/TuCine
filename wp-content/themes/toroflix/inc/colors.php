<?php

if (!class_exists('tp_color_scheme')) {
class tp_color_scheme {
	public function __construct() {
		add_action( 'customize_register', array( $this, 'customizer_register' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_js' ) );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'color_scheme_template' ) );
		add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
		add_action( 'wp_head', array( $this, 'output_css' ), 200 );
	}

	public $options = array(
        'tp_color_1',
        'tp_color_2',
        'tp_color_3',
        'tp_color_4',
        'tp_color_5',
        'tp_color_6',
        'tp_color_7',
        'tp_color_8',
        'tp_color_9',
        'tp_color_10',
        'tp_color_11',
        'tp_color_12',
        'tp_color_13',
        'tp_color_14',
        'tp_color_15',
        'tp_color_16',
        'tp_color_17',
        'tp_color_18',
        'tp_color_19',
        'tp_color_20',
        'tp_color_21',
        'tp_color_22',
        'tp_color_23',
        'tp_color_24',
        'tp_color_25',
        'tp_color_26',
        'tp_color_27',
        'tp_color_28',
        'tp_color_29',
        'tp_color_30',
        'tp_color_31',
        'tp_color_32',
        'tp_color_33',
        'tp_color_34',
        'tp_color_35',
        'tp_color_36',
        'tp_color_37',
        'tp_color_38',
        'tp_color_39',
        'tp_color_40',
        'tp_color_41',
        'tp_color_42',
        'tp_color_43',
        'tp_color_44',
        'tp_color_45',
        'tp_color_46',
        'tp_color_47',
        'tp_color_48',
	);

	public function get_color_schemes() {
    
    return array(
		'default' => array(
			'label'  => __( 'Default', 'toroflix' ),
			'colors' => array(
                '#de1212',
                '#1a191f',
                '#818083',
                '#fff',
                '#fff',
                '#000',
                '#fff',
                '#fff',
                '#de1212',
                '#1a191f',
                '#818083',
                '#fff',
                '#fff',
                '#1a191f',
                '#e0e0e0',
                '#e0e0e0',
                '#e0e0e0',
                '#de1212',
                '#de1212',
                '#fff',
                '#fff',
                '#2a292f',
                '#fff',
                '#212026',
                '#19181d',
                '#fff',
                '#818083',
                '#fff',
                '#de1212',
                '#de1212',
                '#fff',
                '#26252a',
                '#313036',
                '#818083',
                '#fff',
                '#de1212',
                '#313036',
                '#de1212',
                '#fff',
                '#fff',
                '#151419',
                '#818083',
                '#fff',
                '#de1212',
                '#1a191f',
                '#818083',
                '#fff',
                '#de1212',
			),
		),
    );
	}

	public function customizer_register( WP_Customize_Manager $wp_customize ) {

		$wp_customize->add_section( 'tr_colors', array(
	       'title' => __( 'Colors', 'toroflix' ),
		) );

        $color_schemes = $this->get_color_schemes();
        
		$wp_customize->add_setting( 'color_scheme', array(
	        'default' => 'default',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
            'capability'     => 'edit_theme_options',
		) );
                                
		$wp_customize->add_control( 'color_scheme', array(
            'label'   => __( 'Color scheme', 'toroflix' ),
            'section' => 'tr_colors',
            'type'    => 'select',
            'choices' => __('Default', 'toroflix'),
		) );

		$options = array(
            'tp_color_1' => __( 'Main Color', 'toroflix' ),
            'tp_color_2' => __( 'Body Background', 'toroflix' ),
            'tp_color_3' => __( 'General - Text Color', 'toroflix' ),
            'tp_color_4' => __( 'General - Links Color', 'toroflix' ),
            'tp_color_5' => __( 'General - Titles - Color', 'toroflix' ),
            'tp_color_6' => __( 'Header - Background', 'toroflix' ),
            'tp_color_7' => __( 'Menu Links Color', 'toroflix' ),
            'tp_color_8' => __( 'Menu Links Color Hover', 'toroflix' ),
            'tp_color_9' => __( 'Menu Icons Color', 'toroflix' ),
            'tp_color_10' => __( 'Submenus Brackground', 'toroflix' ),
            'tp_color_11' => __( 'Submenus Text Color', 'toroflix' ),
            'tp_color_12' => __( 'Submenus Links Color', 'toroflix' ),
            'tp_color_13' => __( 'Submenus Links Color Hover', 'toroflix' ),
            'tp_color_14' => __( 'Banner Top Background', 'toroflix' ),
            'tp_color_15' => __( 'Banner Top Links Color', 'toroflix' ),
            'tp_color_16' => __( 'Banner Top Links Color Hover', 'toroflix' ),
            'tp_color_17' => __( 'Banner Top Text Color', 'toroflix' ),
            'tp_color_18' => __( 'Buttons Background', 'toroflix' ),
            'tp_color_19' => __( 'Buttons Background Hover', 'toroflix' ),
            'tp_color_20' => __( 'Buttons Text Color', 'toroflix' ),
            'tp_color_21' => __( 'Buttons Text Color Hover', 'toroflix' ),
            'tp_color_22' => __( 'Form controls Background', 'toroflix' ),
            'tp_color_23' => __( 'Form controls Text Color', 'toroflix' ),
            'tp_color_24' => __( 'Widget - Backgorund', 'toroflix' ),
            'tp_color_25' => __( 'Widget Title - Backgorund', 'toroflix' ),
            'tp_color_26' => __( 'Widget Title - Color', 'toroflix' ),
            'tp_color_27' => __( 'Widget Text Color', 'toroflix' ),
            'tp_color_28' => __( 'Widget Links Color', 'toroflix' ),
            'tp_color_29' => __( 'Widget Links Color Hover', 'toroflix' ),
            'tp_color_30' => __( 'Table Title Background', 'toroflix' ),
            'tp_color_31' => __( 'Table Title Text', 'toroflix' ),
            'tp_color_32' => __( 'Table Cell Background', 'toroflix' ),
            'tp_color_33' => __( 'Table Cell Background Hover', 'toroflix' ),
            'tp_color_34' => __( 'Table Cell Text', 'toroflix' ),
            'tp_color_35' => __( 'Table Cell Links', 'toroflix' ),
            'tp_color_36' => __( 'Table Cell Links Hover', 'toroflix' ),
            'tp_color_37' => __( 'Pagination Links Background', 'toroflix' ),
            'tp_color_38' => __( 'Pagination Links Background Hover', 'toroflix' ),
            'tp_color_39' => __( 'Pagination Links Color', 'toroflix' ),
            'tp_color_40' => __( 'Pagination Links Color Hover', 'toroflix' ),
            'tp_color_41' => __( 'Footer Top - Background', 'toroflix' ),
            'tp_color_42' => __( 'Footer Top - Text Color', 'toroflix' ),
            'tp_color_43' => __( 'Footer Top - Links Color', 'toroflix' ),
            'tp_color_44' => __( 'Footer Top - Links Color Hover', 'toroflix' ),
            'tp_color_45' => __( 'Footer Bot - Background', 'toroflix' ),
            'tp_color_46' => __( 'Footer Bot - Text Color', 'toroflix' ),
            'tp_color_47' => __( 'Footer Bot - Links Color', 'toroflix' ),
            'tp_color_48' => __( 'Footer Bot - Links Color Hover', 'toroflix' ),
		);
        
        $i=0;
		foreach ( $options as $key => $label ) {
            $i++;
            $subtract=$i-1;
            $wp_customize->add_setting( $key, array(
                'sanitize_callback' => 'sanitize_hex_color',
                'transport' => 'postMessage',
                'default' => $color_schemes['default']['colors'][$subtract],
                'capability'     => 'edit_theme_options',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
                'label' => $label,
                'section' => 'tr_colors',
            ) ) );
		}

	}

	public $is_custom = false;

	public function get_color_scheme() {
        $color_schemes = $this->get_color_schemes();
        $color_scheme  = get_theme_mod( 'trcolor_scheme' );
        $color_scheme  = isset( $color_schemes[$color_scheme] ) ? $color_scheme : 'default';

        if ( 'default' != $color_scheme ) {
          $this->is_custom = true;
        }

        $colors = array_map( 'strtolower', $color_schemes[$color_scheme]['colors'] );

        foreach ( $this->options as $k => $option ) {
          $color = get_theme_mod( $option );
          if ( $color && strtolower( $color ) != $colors[$k] ) {
            $colors[$k] = $color;
            $this->is_custom = true;
          }
        }
        return $colors;
	}

	public function output_css() {
        $colors = $this->get_color_scheme();
        echo '
        <style id="tp_style_css" type="text/css">
            '.$this->get_css( $colors ).'
        </style>
        ';
	}

	public function get_css( $colors ) {
        
        $css = '
        /**************************/
        /*          General
        ***************************/
        /*(Main Color)*/a:hover,.SearchBtn>i,.Top:before,.TpMvPlay:before,.TPost.B .TPMvCn .TPlay:before,.SrtdBy li a:before,.Clra,.ShareList>li>a,.PlayMovie:hover,.VideoPlayer>span,.OptionBx p:before,.comment-reply-link:before,section>.Top>.Title>span,.widget_categories>ul li:hover>a:before,.Frm-Slct>label:before,.widget span.required,.comment-notes:before,.TPost .Description .CastList li:hover:before,.error-404:before,.widget_recent_comments li:before,.widget_recent_entries li:before,.widget_views li:before,.widget_rss li:before,.widget_meta li:before,.widget_pages li:before,.widget_archive li:before{color: %1$s }
        .Tf-Wp.open .MenuBtn i,.owl-dots>div.active>span,#Tf-Wp.open .MenuBtn i,.TpTv,.TPost.C .Top,.TPost.C .Image,.Bgra,.VideoOptions.open+.BtnOptions,.lgtbx-on .VideoPlayer>span.BtnLight{background-color: %1$s }
        .widget_nav_menu>div>ul>li[class*="current"],.widget_categories>ul>li:hover,.comment-list .children,blockquote{border-color: %1$s }
        .menu-item-has-children>a:after,.SrtdBy:after{border-top-color: %1$s }
        @media screen and (max-width:62em){
            .Menu{border-top-color: %1$s }
        }
        @media screen and (min-width:62em){
            ::-webkit-scrollbar-thumb{background-color: %1$s }
            .menu-item-has-children:hover>.sub-menu{border-top-color: %1$s }
            .menu-item-has-children:after{border-bottom-color: %1$s }
        }
        ::selection{background-color: %1$s ;color:#fff}
        ::-moz-selection{background-color: %1$s ;color:#fff}

        /*(Body Background)*/body{background-color: %2$s }
        /*(Text Color)*/body{color: %3$s }
        /*(Links Color)*/a,.ShareList.Count .numbr{color: %4$s }
        /*(Titles - Color)*/.Top>.Title,.Title.Top,.comment-reply-title,#email-notes,.Description h1,.Description h2,.Description h3,.Description h4,.Description h5,.Description h6,.Description legend{color: %5$s }

        /**************************/
        /*          Header
        ***************************/
        /*Background*/.Header:after{background-color: %6$s }
        .BdGradient .Header:after{background:linear-gradient(to bottom, %6$s  0|,rgba(0,0,0,0) 100|)}
        /*Menu*/
        /*(Menu Links Color)*/.Menu a,.SearchBtn{color: %7$s }
        .MenuBtn i{background-color: %7$s }
        /*(Menu Links Color Hover)*/.Menu li:hover a{color: %8$s }
        @media screen and (min-width:62em){
            .Menu [class*="current"]>a,.Header .Menu>ul>li:hover>a{color: %8$s }
        }
        /*(Menu Icons Color)*/.Menu li:before,.menu li:before{color: %9$s }

        /*(Submenus Brackground)*/.Frm-Slct>label,.TPost.B .TPMvCn,.SrtdBy.open .List,.SearchMovies .sol-selection,.trsrcbx,.SearchMovies .sol-no-results,.OptionBx{background-color: %10$s }
        @media screen and (max-width:62em){
            .Menu{background-color: %10$s }
        }
        @media screen and (min-width:62em){
            .sub-menu{background-color: %10$s }
        }
        /*(Submenus Text Color)*/.Frm-Slct>label,.TPost.B .TPMvCn,.OptionBx{color: %11$s }
        /*(Submenus Links Color)*/.TPost.B .TPMvCn a,.OptionBx div,.sub-menu a,.Menu li:hover .sub-menu li>a{color: %12$s !important}
        @media screen and (max-width:62em){
            .Menu a{color: %12$s }
        }
        /*(Submenus Links Color Hover)*/.TPost.B .TPMvCn a:hover,.OptionBx a:hover,.sub-menu li:hover a,.Menu li:hover .sub-menu li:hover>a{color: %13$s !important}
        @media screen and (max-width:62em){
            .Menu li:hover a{color: %13$s }
        }

        /**************************/
        /*          Banner Top
        ***************************/
        /*(Banner Top Background)*/.TPost.A .Image:after,.TPost .Description .CastList:before{background:linear-gradient(to bottom,rgba(0,0,0,0) 0|, %14$s  100|)}
        /*(Banner Top Links Color)*/.MovieListSldCn .TPost.A .TPMvCn div a,.MovieListSldCn .TPost.A .TPMvCn .Title{color: %15$s }
        /*(Banner Top Links Color Hover)*/.MovieListSldCn .TPost.A .TPMvCn div a:hover,.MovieListSldCn .TPost.A .TPMvCn .Title:hover{color: %16$s }
        /*(Banner Top Text Color)*/.MovieListSldCn .TPost.A{color: %17$s }


        /**************************/
        /*          Forms
        ***************************/
        /*(Buttons Background)*/.Button,a.Button,a.Button:hover,button,input[type="button"],input[type="reset"],input[type="submit"],.BuyNow>a,.sol-selected-display-item,.trsrclst>li,.ShareList>li>a:hover,.TPost.B .Image .Qlty{background-color: %18$s }
        .ShareList>li>a{border-color: %18$s }
        /*(Buttons Background Hover)*/.Button:hover,.Button:hover,button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.BuyNow>a:hover{background-color: %19$s }
        /*(Buttons Text Color)*/.Button,a.Button,button,input[type="button"],input[type="reset"],input[type="submit"],.BuyNow>a,.sol-selected-display-item,.trsrclst>li,.ShareList>li>a:hover,.TPost.B .Image .Qlty{color: %20$s }
        /*(Buttons Text Color Hover)*/.Button:hover,.Button:hover,button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.BuyNow>a:hover{color: %21$s }
        /*(Form controls Background)*/input,textarea,select,.Form-Select label,.OptionBx p{background-color: %22$s }
        /*(Form controls Text Color)*/input,textarea,select,.Form-Select label,.OptionBx p{color: %23$s }


        /**************************/
        /*          Widgets
        ***************************/
        /*(Widget - Backgorund)*/aside .Wdgt{background-color: %24$s }
        /*(Widget Title - Backgorund)*/aside .Wdgt>.Title{background-color: %25$s }
        /*(Widget Title - Color)*/aside .Wdgt>.Title{color: %26$s }
        /*(Widget Text Color)*/aside .Wdgt{color: %27$s }
        /*(Widget Links Color)*/aside .Wdgt a{color: %28$s }
        /*(Widget Links Color Hover)*/aside .Wdgt a:hover{color: %29$s }


        /**************************/
        /*          Tables
        ***************************/
        /*(Table Title Background)*/thead tr{background-color: %30$s }
        /*(Table Title Text)*/thead tr{color: %31$s }
        /*(Table Cell Background)*/td{background-color: %32$s }
        .SeasonBx{border-bottom-color: %32$s }
        /*(Table Cell Background Hover )*/tr:hover>td,tr.Viewed td{background-color: %33$s }
        /*(Table Cell Text)*/td{color: %34$s }
        /*(Table Cell Links)*/td a,.TPTblCnMvs td:first-child,.TPTblCnMvs td:nth-child(2),.TPTblCnMvs td:nth-child(3){color: %35$s }
        /*(Table Cell Links Hover)*/td a:hover{color: %36$s }


        /**************************/
        /*          Pagination
        ***************************/
        /*Pagination Links Background*/.menu-azlist ul.sub-menu a,.AZList>li>a,.wp-pagenavi a,.wp-pagenavi span,.nav-links a,.nav-links span,.tagcloud a{background-color: %37$s }
        @media screen and (max-width:62em){
            .Menu>ul>li{border-bottom-color: %37$s }
            .Menu .sub-menu a{background-color: %37$s }
        }
        /*Pagination Links Background Hover*/.menu-azlist ul.sub-menu a:hover,.menu-azlist [class*="current"]>a,.AZList a:hover,.AZList .Current a,.wp-pagenavi a:hover,.wp-pagenavi span.current,.nav-links a:hover,.nav-links [class*="current"],.tagcloud a:hover{background-color: %38$s }
        @media screen and (max-width:62em){
            .Menu .sub-menu a:hover{background-color: %38$s }
        }
        /*Pagination Links Color*/.menu-azlist ul.sub-menu a,.AZList>li>a,.wp-pagenavi a,.wp-pagenavi span,.tagcloud a{color: %39$s !important}
        @media screen and (max-width:62em){
            .Menu .sub-menu a{color: %39$s !important}
        }
        /*Pagination Links Color Hover*/.Menu li.menu-azlist:hover ul.sub-menu a:hover,.menu-azlist [class*="current"]>a,.AZList a:hover,.AZList .Current a,.wp-pagenavi a:hover,.wp-pagenavi span.current,.nav-links a:hover,.nav-links [class*="current"],.tagcloud a:hover{color: %40$s !important}
        @media screen and (max-width:62em){
            .Menu li:hover .sub-menu li:hover a,.Menu .sub-menu li:hover:before{color: %40$s !important}
        }


        /**************************/
        /*          Footer
        ***************************/
        /*Top*/
        /*(Footer Top - Background)*/.Footer .Top{background-color: %41$s }
        /*(Footer Top - Text Color)*/.Footer .Top{color: %42$s }
        /*(Footer Top - Links Color)*/.Footer .Top a{color: %43$s }
        /*(Footer Top - Links Color Hover)*/.Footer .Top a:hover{color: %44$s }
        /*Bot*/
        /*(Footer Bot - Background)*/.Footer .Bot{background-color: %45$s }
        /*(Footer Bot - Text Color)*/.Footer .Bot{color: %46$s }
        /*(Footer Bot - Links Color)*/.Footer .Bot a{color: %47$s }
        /*(Footer Bot - Links Color Hover)*/.Footer .Bot a:hover{color: %48$s }

        /****************************  NO EDIT  ****************************/
        .Search input[type="text"]{background-color:rgba(255,255,255,.2);box-shadow:inset 0 0 0 1px rgba(255,255,255,.2);color:#fff}
        .Search input[type="text"]:focus{background-color:rgba(255,255,255,.3);box-shadow:0 0 5px rgba(0,0,0,.5),inset 0 0 0 1px rgba(255,255,255,.2)}
        .Button,a.Button,button,input[type="button"],input[type="reset"],input[type="submit"],.BuyNow>a,.wp-pagenavi .current,thead tr,.nav-links [class*="current"]{box-shadow:inset 0 -10px 20px rgba(0,0,0,.3)}
        .Button:hover,.Button:hover,button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.BuyNow>a:hover{box-shadow:none}
        .TPost.B .TPMvCn,aside .Wdgt,.SrtdBy.open .List,.sol-active.sol-selection-top .sol-selection-container,.trsrcbx,.sub-menu,.OptionBx,.wp-pagenavi a,.wp-pagenavi span,.nav-links a,.nav-links span,.tagcloud a{box-shadow:inset 0 0 70px rgba(0,0,0,.3),0 0 20px rgba(0,0,0,.5)}
        .widget_categories>ul li:hover,.sol-option:hover{box-shadow:inset 0 0 70px rgba(0,0,0,.2)}
        @media screen and (max-width:62em){
            .sub-menu{box-shadow:none}
        }
        ';
    
        return str_replace('|', '%', vsprintf( $css, $colors ));
	}

	public function color_scheme_template() {
        $colors = array(
            'tp_color_1' => '{{ data.tp_color_1 }}',
            'tp_color_2' => '{{ data.tp_color_2 }}',
            'tp_color_3' => '{{ data.tp_color_3 }}',
            'tp_color_4' => '{{ data.tp_color_4 }}',
            'tp_color_5' => '{{ data.tp_color_5 }}',
            'tp_color_6' => '{{ data.tp_color_6 }}',
            'tp_color_7' => '{{ data.tp_color_7 }}',
            'tp_color_8' => '{{ data.tp_color_8 }}',
            'tp_color_9' => '{{ data.tp_color_9 }}',
            'tp_color_10' => '{{ data.tp_color_10 }}',
            'tp_color_11' => '{{ data.tp_color_11 }}',
            'tp_color_12' => '{{ data.tp_color_12 }}',
            'tp_color_13' => '{{ data.tp_color_13 }}',
            'tp_color_14' => '{{ data.tp_color_14 }}',
            'tp_color_15' => '{{ data.tp_color_15 }}',
            'tp_color_16' => '{{ data.tp_color_16 }}',
            'tp_color_17' => '{{ data.tp_color_17 }}',
            'tp_color_18' => '{{ data.tp_color_18 }}',
            'tp_color_19' => '{{ data.tp_color_19 }}',
            'tp_color_20' => '{{ data.tp_color_20 }}',
            'tp_color_21' => '{{ data.tp_color_21 }}',
            'tp_color_22' => '{{ data.tp_color_22 }}',
            'tp_color_23' => '{{ data.tp_color_23 }}',
            'tp_color_24' => '{{ data.tp_color_24 }}',
            'tp_color_25' => '{{ data.tp_color_25 }}',
            'tp_color_26' => '{{ data.tp_color_26 }}',
            'tp_color_27' => '{{ data.tp_color_27 }}',
            'tp_color_28' => '{{ data.tp_color_28 }}',
            'tp_color_29' => '{{ data.tp_color_29 }}',
            'tp_color_30' => '{{ data.tp_color_30 }}',
            'tp_color_31' => '{{ data.tp_color_31 }}',
            'tp_color_32' => '{{ data.tp_color_32 }}',
            'tp_color_33' => '{{ data.tp_color_33 }}',
            'tp_color_34' => '{{ data.tp_color_34 }}',
            'tp_color_35' => '{{ data.tp_color_35 }}',
            'tp_color_36' => '{{ data.tp_color_36 }}',
            'tp_color_37' => '{{ data.tp_color_37 }}',
            'tp_color_38' => '{{ data.tp_color_38 }}',
            'tp_color_39' => '{{ data.tp_color_39 }}',
            'tp_color_40' => '{{ data.tp_color_40 }}',
            'tp_color_41' => '{{ data.tp_color_41 }}',
            'tp_color_42' => '{{ data.tp_color_42 }}',
            'tp_color_43' => '{{ data.tp_color_43 }}',
            'tp_color_44' => '{{ data.tp_color_44 }}',
            'tp_color_45' => '{{ data.tp_color_45 }}',
            'tp_color_46' => '{{ data.tp_color_46 }}',
            'tp_color_47' => '{{ data.tp_color_47 }}',
            'tp_color_48' => '{{ data.tp_color_48 }}',
        );
    ?>
    <script type="text/html" id="tmpl-tp-color-scheme">
      <?php echo $this->get_css( $colors ); ?>
    </script>
		<?php
	}

	public function customize_js() {
        
        wp_enqueue_script( 'tp-color-scheme', get_template_directory_uri() . '/js/color-scheme.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '1.0', true );
        wp_localize_script( 'tp-color-scheme', 'tpColorScheme', $this->get_color_schemes() );

	}

	public function customize_preview_js() {
        $myvars = array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        );
		wp_enqueue_script( 'tp-color-scheme-preview', get_template_directory_uri() . '/js/color-scheme-preview.js', array( 'customize-preview' ), '1.0', true );
        wp_localize_script( 'tp-color-scheme-preview', 'trColor', $myvars );
	}
}
}
new tp_color_scheme();
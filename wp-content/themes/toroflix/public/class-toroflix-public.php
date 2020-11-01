<?php

class TOROFLIX_Public {

    private $theme_name;
    private $version;
    //private $normalize;
    private $helpers;

    public function __construct( $theme_name, $version ) {
        $this->theme_name = $theme_name;
        $this->version    = $version;
        //$this->normalize  = new TOROFLIX_Normalize;
    }
    
    //Style public
    public function enqueue_styles() {
        wp_enqueue_style( $this->theme_name, TOROFLIX_DIR_URI . 'public/css/toroflix-public.css', array(), $this->version, 'all' );
    }

    public function enqueue_styles_footer() {
        wp_enqueue_style( 'font-awesome-public_css', TOROFLIX_DIR_URI . 'public/css/font-awesome.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'material-public-css', TOROFLIX_DIR_URI . 'public/css/material.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'font-source-sans-pro-public-css', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700', array(), $this->version, 'all' );
    }

    public function enqueue_scripts() {

        wp_enqueue_script( 'funciones_public_jquery', TOROFLIX_DIR_URI . 'public/js/jquery.js',  array(), '3.0.0', true );
        wp_enqueue_script( 'funciones_public_modernizr', TOROFLIX_DIR_URI . 'public/js/modernizr.js',  array(), $this->version, true );
        wp_enqueue_script( 'funciones_public_carousel', TOROFLIX_DIR_URI . 'public/js/owl.carousel.min.js',  array(), $this->version, true );
        wp_enqueue_script( 'funciones_public_sol', TOROFLIX_DIR_URI . 'public/js/sol.js',  array(), $this->version, true );
        wp_enqueue_script( 'funciones_public_functions', TOROFLIX_DIR_URI . 'public/js/functions.js',  array(), $this->version, true );
       
        #Comments
        if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
            wp_enqueue_script( 'comment-reply', 'wp-includes/js/comment-reply', array(), false, true );
        }

        if(is_singular()) {
            global $post;
            $trailer = get_post_meta( $post->ID, 'field_trailer', true );
        } else {
            $trailer = '';
        }

        #Localize Script
        $toroflixPublic = [
            'url'               => admin_url( 'admin-ajax.php' ),
            'nonce'             => wp_create_nonce( 'toroflix_seg' ),
            'trailer'           => $trailer,
            'noItemsAvailable'  => __('No entries found', 'toroflix'),
            'selectAll'         => __('Select all', 'toroflix'),
            'selectNone'        => __('Select none', 'toroflix'),
            'searchplaceholder' => __('Click here to search', 'toroflix'),
            'loadingData'       => __('Still loading data...', 'toroflix'),
        ];
        wp_localize_script( 'funciones_public_functions', 'toroflixPublic', $toroflixPublic );

        wp_localize_script( 'funciones_public_sol', 'toroflixPublic', $toroflixPublic );
        
    }
    
}
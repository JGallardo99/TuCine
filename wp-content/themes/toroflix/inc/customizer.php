<?php
/**
 * Toroflix Customizer functionality
 */

add_action('customize_register', 'tr_customize_register');

function tr_customize_register($wp_customize){
    $wp_customize->remove_section('title_tagline');
    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('color_scheme');

    $wp_customize->add_panel( 'tr_panel_options', array(
        'priority'       => 50,
        'capability'     => 'edit_theme_options',
        'title'          => __('Theme Options', 'toroflix'),
    ));
    
    $wp_customize->add_section(
        'tr_opt_general',
        array(
            'title'     => __('General','toroflix'),
            "panel"     => 'tr_panel_options'
        )
    );
        
    $wp_customize->add_setting('toroflix_theme_options[logo]', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
        'validate_callback' => 'tr_validate_image',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'toroflix_logo', array(
        'section' => 'tr_opt_general',
        'label' => __('Logo', 'toroflix'),
        'mime_type' => 'image',
        'settings' => 'toroflix_theme_options[logo]'
    )));
    
    $wp_customize->add_setting('toroflix_theme_options[favicon]', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url',
        'validate_callback' => 'tr_validate_image',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'toroflix_favicon', array(
        'section' => 'tr_opt_general',
        'label' => __('Favicon', 'toroflix'),
        'mime_type' => 'image',
        'settings' => 'toroflix_theme_options[favicon]'
    )));
        
    $wp_customize->add_setting('toroflix_theme_options[header]', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_header', array(
        'label'      => __('Header', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[header]',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Fixed', 'toroflix'),
            '2' => __('Static', 'toroflix'),
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[sidebar]', array(
        'default'        => '3',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_sidebar', array(
        'label'      => __('Sidebar', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[sidebar]',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Left', 'toroflix'),
            '2' => __('None', 'toroflix'),
            '3' => __('Right', 'toroflix'),
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[filter]', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_filter', array(
        'label'      => __('Filter list posts', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[filter]',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Enabled', 'toroflix'),
            '2' => __('Disable', 'toroflix'),
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[alphabet]', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_alphabet', array(
        'label'      => __('Alphabet', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[alphabet]',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Enabled', 'toroflix'),
            '2' => __('Disable', 'toroflix'),
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_quality]', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_show_quality', array(
        'label'      => __('Show Quality', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[show_quality]',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Yes, the last added.', 'toroflix'),
            '2' => __('Yes, the first added.', 'toroflix'),
            '3' => __('No', 'toroflix')
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_text_seo]', array(
        'default'        => '3',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_show_text_seo', array(
        'label'      => __('Show text SEO', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[show_text_seo]',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Top', 'toroflix'),
            '2' => __('Bottom', 'toroflix'),
            '3' => __('Disable', 'toroflix')
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_related]', array(
        'default'        => '2',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_show_related', array(
        'label'      => __('Show related', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[show_related]',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Top', 'toroflix'),
            '2' => __('Bottom', 'toroflix'),
            '3' => __('Disable', 'toroflix')
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[posts_per_home]', array(
        'default'        => '15',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_posts_per_home', array(
        'label'      => __('Number of posts on homepage', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[posts_per_home]',
        'type'       => 'text'
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[posts_per_category]', array(
        'default'        => '15',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_posts_per_category', array(
        'label'      => __('Number of posts on category', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[posts_per_category]',
        'type'       => 'text'
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[posts_per_tag]', array(
        'default'        => '15',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_posts_per_tag', array(
        'label'      => __('Number of posts on tag', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[posts_per_tag]',
        'type'       => 'text'
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[posts_per_alphabet]', array(
        'default'        => '20',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_posts_per_alphabet', array(
        'label'      => __('Number of posts on alphabet', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[posts_per_alphabet]',
        'type'       => 'text'
    ));

    $wp_customize->add_setting('toroflix_theme_options[posts_per_search]', array(
        'default'        => '15',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_posts_per_search', array(
        'label'      => __('Number of posts on search', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[posts_per_search]',
        'type'       => 'text'
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[posts_per_related]', array(
        'default'        => '8',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_posts_per_related', array(
        'label'      => __('Number of posts on related', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[posts_per_related]',
        'type'       => 'text'
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[hd_code]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_print',
		'transport'         => 'postMessage'
    ));
 
    $wp_customize->add_control('toroflix_hd_code', array(
        'label'      => __('Code in header', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[hd_code]',
        'type'       => 'textarea',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[ft_code]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_print',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_ft_code', array(
        'label'      => __('Code in footer', 'toroflix'),
        'section'    => 'tr_opt_general',
        'settings'   => 'toroflix_theme_options[ft_code]',
        'type'       => 'textarea',
    ));
    
    $wp_customize->add_section(
        'tr_opt_seo',
        array(
            'title'     => __('SEO','toroflix'),
            "panel"     => 'tr_panel_options'
        )
    );
    
    $wp_customize->add_setting('toroflix_theme_options[carrousel_seo]', array(
        'default'        => __('Mais popular', 'toroflix'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_carrousel_seo', array(
        'label'      => __('Carrousel', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[carrousel_seo]',
        'type'       => 'textarea',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[carrousel_seo_tag]', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
 
    $wp_customize->add_control('toroflix_carrousel_seo_tag', array(
        'label'      => __('Tag', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[carrousel_seo_tag]',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[h1_home_seo]', array(
        'default'        => __('Últimos filmes', 'toroflix'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_h1_home_seo', array(
        'label'      => __('H1 - Homepage', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[h1_home_seo]',
        'type'       => 'textarea',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[home_seo_tag]', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
 
    $wp_customize->add_control('toroflix_home_seo_tag', array(
        'label'      => __('Tag', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[home_seo_tag]',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[h1_category_seo]', array(
        'default'        => __('{title} Movies', 'toroflix'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_h1_category_seo', array(
        'label'      => __('H1 - Category', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[h1_category_seo]',
        'type'       => 'textarea',
        'description' => '{title} shows category name'
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[category_seo_tag]', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
 
    $wp_customize->add_control('toroflix_category_seo_tag', array(
        'label'      => __('Tag', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[category_seo_tag]',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[h1_tag_seo]', array(
        'default'        => __('{title} Movies', 'toroflix'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_h1_tag_seo', array(
        'label'      => __('H1 - Tag', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[h1_tag_seo]',
        'type'       => 'textarea',
        'description' => '{title} shows tag name'
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[tag_seo_tag]', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
 
    $wp_customize->add_control('toroflix_tag_seo_tag', array(
        'label'      => __('Tag', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[tag_seo_tag]',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[h1_search_seo]', array(
        'default'        => __('{title} Movies', 'toroflix'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_h1_search_seo', array(
        'label'      => __('H1 - Search', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[h1_search_seo]',
        'type'       => 'textarea',
        'description' => '{title} shows search'
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[search_seo_tag]', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
 
    $wp_customize->add_control('toroflix_search_seo_tag', array(
        'label'      => __('Tag', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[search_seo_tag]',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[h1_searchf_seo]', array(
        'default'        => __('Advanced Search', 'toroflix'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_h1_searchf_seo', array(
        'label'      => __('H1 - Search Filter', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[h1_searchf_seo]',
        'type'       => 'textarea',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[filter_seo_tag]', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
 
    $wp_customize->add_control('toroflix_filter_seo_tag', array(
        'label'      => __('Tag', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[filter_seo_tag]',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[h1_singlem_seo]', array(
        'default'        => __('{title}', 'toroflix'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_h1_singlem_seo', array(
        'label'      => __('H1 - Single Movie', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[h1_singlem_seo]',
        'type'       => 'textarea',
        'description' => '{title} shows title post'
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[singlem_seo_tag]', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
 
    $wp_customize->add_control('toroflix_singlem_seo_tag', array(
        'label'      => __('Tag', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[singlem_seo_tag]',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[h1_abc_seo]', array(
        'default'        => __('Movies By Letter', 'toroflix'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_h1_abc_seo', array(
        'label'      => __('H1 - Alphabet', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[h1_abc_seo]',
        'type'       => 'textarea',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[abc_seo_tag]', array(
        'default'        => 'h1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
 
    $wp_customize->add_control('toroflix_abc_seo_tag', array(
        'label'      => __('Tag', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[abc_seo_tag]',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[relatedm_seo]', array(
        'default'        => __('Related Movies', 'toroflix'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_relatedm_seo', array(
        'label'      => __('Related', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[relatedm_seo]',
        'type'       => 'textarea',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[related_seo_tag]', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
 
    $wp_customize->add_control('toroflix_related_seo_tag', array(
        'label'      => __('Tag', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[related_seo_tag]',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[links_seo]', array(
        'default'        => __('Links', 'toroflix'),
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_links_seo', array(
        'label'      => __('Links', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[links_seo]',
        'type'       => 'textarea',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[links_seo_tag]', array(
        'default'        => 'div',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ));
 
    $wp_customize->add_control('toroflix_links_seo_tag', array(
        'label'      => __('Tag', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[links_seo_tag]',
        'type'       => 'select',
        'choices'    => array(
            'div' => 'div',
            'h1' =>  'h1',
            'h2' =>  'h2',
            'h3' =>  'h3',
            'h4' =>  'h4',
        ),
    ));
        
    $wp_customize->add_setting('toroflix_theme_options[description_homepage]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'tr_sanitize_text_html',
		'transport'         => 'postMessage',
    ));
 
    $wp_customize->add_control('toroflix_description_homepage', array(
        'label'      => __('Description for frontpage', 'toroflix'),
        'section'    => 'tr_opt_seo',
        'settings'   => 'toroflix_theme_options[description_homepage]',
        'type'       => 'textarea',
    ));
        
    $wp_customize->add_section(
        'tr_opt_hover',
        array(
            'title'     => __('Info hover','toroflix'),
            "panel"     => 'tr_panel_options'
        )
    );
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover]', array(
        'default'        => '2',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover', array(
        'label'      => __('Show', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover]',
        'type'       => 'radio',
        'choices'    => array(
            '1' => __('Over', 'toroflix'),
            '2' => __('In the right', 'toroflix'),
            '3' => __('Disable', 'toroflix'),
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover_title]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover_title', array(
        'label'      => __('Show title', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover_title]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover_year]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover_year', array(
        'label'      => __('Show year', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover_year]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover_rating]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover_rating', array(
        'label'      => __('Show rating', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover_rating]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover_quality]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover_quality', array(
        'label'      => __('Show quality', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover_quality]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover_duration]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover_duration', array(
        'label'      => __('Show duration', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover_duration]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover_views]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover_views', array(
        'label'      => __('Show views', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover_views]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover_description]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover_description', array(
        'label'      => __('Show description', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover_description]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover_categories]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover_categories', array(
        'label'      => __('Show categories', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover_categories]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover_director]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover_director', array(
        'label'      => __('Show director', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover_director]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover_cast]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover_cast', array(
        'label'      => __('Show cast', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover_cast]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_hover_tags]', array(
        'default'        => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_hover_tags', array(
        'label'      => __('Show cast', 'toroflix'),
        'section'    => 'tr_opt_hover',
        'settings'   => 'toroflix_theme_options[show_hover_tags]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_section(
        'tr_opt_slider',
        array(
            'title'     => __('Slider','toroflix'),
            "panel"     => 'tr_panel_options'
        )
    );
    
    $wp_customize->add_setting('toroflix_theme_options[show_slider]', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_slider', array(
        'label'      => __('Show', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[show_slider]',
        'type'       => 'radio',
        'choices'    => array(
            '1' => __('Enabled', 'toroflix'),
            '2' => __('Disable', 'toroflix'),
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[posts_per_slider]', array(
        'default'        => '4',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    ));
 
    $wp_customize->add_control('toroflix_posts_per_slider', array(
        'label'      => __('Number of posts', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[posts_per_slider]',
        'type'       => 'text'
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[slider_orderby]', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    ));
 
    $wp_customize->add_control('toroflix_slider_orderby', array(
        'label'      => __('Order by', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[slider_orderby]',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Random', 'toroflix'),
            '2' => __('Last', 'toroflix'),
            '3' => __('Best rated (Required WP-PostRatings)', 'toroflix'),
            '4' => __('Most views (Required WP-PostViews)', 'toroflix'),
            '5' => __('Post sticky', 'toroflix'),
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[slider_autoplay]', array(
        'default'        => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_slider_autoplay', array(
        'label'      => __('Autoplay', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[slider_autoplay]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_geners_slider]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_geners_slider', array(
        'label'      => __('Show geners', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[show_geners_slider]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_directors_slider]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_directors_slider', array(
        'label'      => __('Show director', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[show_directors_slider]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_cast_slider]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_cast_slider', array(
        'label'      => __('Show cast', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[show_cast_slider]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_rating_slider]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_rating_slider', array(
        'label'      => __('Show rating', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[show_rating_slider]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_quality_slider]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_quality_slider', array(
        'label'      => __('Show quality', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[show_quality_slider]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_year_slider]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_year_slider', array(
        'label'      => __('Show year', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[show_year_slider]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_views_slider]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_views_slider', array(
        'label'      => __('Show views', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[show_views_slider]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_duration_slider]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_duration_slider', array(
        'label'      => __('Show duration', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[show_duration_slider]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_tag_slider]', array(
        'default'        => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_tag_slider', array(
        'label'      => __('Show tag', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[show_tag_slider]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_description_slider]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_description_slider', array(
        'label'      => __('Show description', 'toroflix'),
        'section'    => 'tr_opt_slider',
        'settings'   => 'toroflix_theme_options[show_description_slider]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_section(
        'tr_opt_carrousel',
        array(
            'title'     => __('Carrousel','toroflix'),
            "panel"     => 'tr_panel_options'
        )
    );
    
    $wp_customize->add_setting('toroflix_theme_options[show_carrousel]', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));
    
    $wp_customize->add_control('toroflix_show_carrousel', array(
        'label'      => __('Show', 'toroflix'),
        'section'    => 'tr_opt_carrousel',
        'settings'   => 'toroflix_theme_options[show_carrousel]',
        'type'       => 'radio',
        'choices'    => array(
            '1' => __('Enabled', 'toroflix'),
            '2' => __('Disable', 'toroflix'),
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[posts_per_carrousel]', array(
        'default'        => '12',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    ));
 
    $wp_customize->add_control('toroflix_posts_per_carrousel', array(
        'label'      => __('Número de posts', 'toroflix'),
        'section'    => 'tr_opt_carrousel',
        'settings'   => 'toroflix_theme_options[posts_per_carrousel]',
        'type'       => 'text'
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[carrousel_orderby]', array(
        'default'        => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    ));
 
    $wp_customize->add_control('toroflix_carrousel_orderby', array(
        'label'      => __('Ordenado por', 'toroflix'),
        'section'    => 'tr_opt_carrousel',
        'settings'   => 'toroflix_theme_options[carrousel_orderby]',
        'type'       => 'select',
        'choices'    => array(
            '1' => __('Aleatório', 'toroflix'),
            '2' => __('Últimos', 'toroflix'),
            '3' => __('Melhores avaliações', 'toroflix'),
            '4' => __('Mais visualizados', 'toroflix'),
            '5' => __('Post sticky', 'toroflix'),
        ),
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[carrousel_autoplay]', array(
        'default'        => false,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_carrousel_autoplay', array(
        'label'      => __('Autoplay', 'toroflix'),
        'section'    => 'tr_opt_carrousel',
        'settings'   => 'toroflix_theme_options[carrousel_autoplay]',
        'type'       => 'checkbox',
    ));
    
    $wp_customize->add_setting('toroflix_theme_options[show_quality_carrousel]', array(
        'default'        => true,
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
		'transport'         => 'postMessage'
    ));

    $wp_customize->add_control('toroflix_show_quality_carrousel', array(
        'label'      => __('Show quality', 'toroflix'),
        'section'    => 'tr_opt_carrousel',
        'settings'   => 'toroflix_theme_options[show_quality_carrousel]',
        'type'       => 'checkbox',
    ));
    
}

function tr_sanitize_text_html( $input ) {
    $allowed = array(
        'a' => array(
            'href' => array(),
            'title' => array(),
            'target' => array(),
            'class' => array()
        ),
        'em' => array(),
        'strong' => array(),
        'b' => array(),
        'h1' => array(),
        'h2' => array(),
        'h3' => array(),
        'h4' => array(),
        'h5' => array(),
        'h6' => array(),
        '<p>' => array(),
    );

    return wp_kses( $input, $allowed );
}

function tr_sanitize_print ( $input ) {
    
    return stripslashes( wp_specialchars_decode( $input ) );
    
}

function tr_validate_image( $validity, $value ) {

  /*
  * Array of valid image file types.
  *
  * The array includes image mime types that are included in wp_get_mime_types()
  */
  $mimes = array(
      'jpg|jpeg|jpe' => 'image/jpeg',
      'gif'          => 'image/gif',
      'png'          => 'image/png',
      'bmp'          => 'image/bmp',
      'tif|tiff'     => 'image/tiff',
      'ico'          => 'image/x-icon',
      'svg'          => 'image/svg+xml'
  );

  // Return an array with file extension and mime_type.
  $file = wp_check_filetype( $value, $mimes );
  
  if ($value!='' and !$file['ext'] ) {
    // If a valid image file extension is not found, instruct user to choose appropriate image
    $validity->add( 'not_valid', __( 'Please choose a valid image type', 'toroflix' ) );
  }
  return $validity;
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 */
function tr_customize_preview_js() {
	wp_enqueue_script( 'tr-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), TR_THEMEVERSION, true );
}
add_action( 'customize_preview_init', 'tr_customize_preview_js' );

?>
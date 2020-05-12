<?php
    if ( ! defined( 'ABSPATH' ) ) {
        die;
    }

    function learn_get_post_title(){
            
        $learn_post_type_query  = new WP_Query(  
            array ( 
                'post_type' => array ('post','page')
                // 'title_li'     => __(''),
                // 'sort_column' => 'post_title'
                // 'posts_per_page' => -1  
            )  
        );   
        $learn_post_type_arr = $learn_post_type_query->posts;   
        $learn_post_arr_name = wp_list_pluck( $learn_post_type_arr, 'post_title' );
        return $learn_post_arr_name;
        
    }

    function learn_is_social(){
        $learn_is_social = get_option('learn_is_social');
        return $learn_is_social;
    }
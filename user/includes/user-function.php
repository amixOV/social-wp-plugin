<?php
 if ( ! defined( 'ABSPATH' ) ) {
    die;
}

function learn_is_this_page_selected(){
    $learn_get_what_page_arr = get_option('learn_what_page');
    if(!$learn_get_what_page_arr){
        $learn_get_what_page_arr = array();
    }
    foreach($learn_get_what_page_arr as $learn_get_what_page){
        if($learn_get_what_page === 'all'){
            return true;
        }
        if($learn_get_what_page === 'is_front_page'){
            $learn_is_this_page = is_front_page();
            if($learn_is_this_page){
                return true;
            }
        }
        if($learn_get_what_page === 'post'){
            $learn_is_this_page = is_singular('post');
            if($learn_is_this_page){
                return true;
            }
           
        }
        if($learn_get_what_page === 'page'){
            $learn_is_this_page = is_singular('page');
            if($learn_is_this_page){
                return true;
            }
        }
        $learn_is_this_page = get_the_title();
        if($learn_get_what_page === $learn_is_this_page){
            return true;
        }
    }
    return false;
}

function learn_is_social(){
    $learn_is_social = get_option('learn_is_social');
    return $learn_is_social;
}
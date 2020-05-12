<?php

if ( ! defined( 'ABSPATH' ) ) {
    die;
}


function get_my_learn_soc_array(){ // get social names include new user social
    if(!get_option('learn_soc_name_array')){
        // build array soc names for first time
        $my_learn_soc_array = ["faceBook", "whatsApp", "instegram", "twitter", "youTube", "phone", "telegram", "Email"];
        foreach ($my_learn_soc_array as $soc_name ) {
            $learn_social_icon = plugin_dir_url(__FILE__) . 'icons/logo_' . $soc_name . '.png' ;
            $learn_soc_arr = learn_build_array($soc_name, $learn_social_icon);
            $learn_soc_array[$soc_name] =  $learn_soc_arr;
        }
        update_option('learn_soc_name_array', $learn_soc_array);
    }
    $my_learn_soc_array = get_option('learn_soc_name_array');
    
    return $my_learn_soc_array;
}

function learn_build_array($soc_name, $learn_social_icon = false){
    $learn_social_name = "learn_my_" . $soc_name ;
    $learn_social_name_chek = "learn_my_chek_" . $soc_name ;
    $learn_social_val_chek = (isset($soc_name['the_social_val'])) ? $soc_name['the_social_val'] : ''  ;
    $learn_social_val = (isset($soc_name['the_social_val'])) ? $soc_name['the_social_val'] : ''  ;

    $learn_soc_arr = array(
        'social_name' => $soc_name,
        'the_social_name_for_name'=> $learn_social_name,
        'the_social_val'=> $learn_social_val,
        'the_social_name_chek' => $learn_social_name_chek,
        'learn_social_val_chek' => $learn_social_val_chek,
        'learn_social_icon' => $learn_social_icon
    );
   
    return $learn_soc_arr;
}

function learn_update_option(){
    $learn_arr_from_post = $_POST;
    $learn_soc_array = get_option('learn_soc_name_array'); //AAA BBB CCC
    foreach($learn_soc_array as $learn_soc_var){
        // the name of the social
        $learn_soc_name = $learn_soc_var['social_name']; //AAA
        
        // the name of the social name for the value
        $learn_soc_name_for_name = $learn_soc_var['the_social_name_for_name'];
        $learn_social_val_chek = $learn_soc_var['the_social_name_chek'];
       
        // data from post
        $learn_val_from_post = $learn_arr_from_post[$learn_soc_name_for_name];
        $learn_check_val_from_post = (isset($learn_arr_from_post[$learn_social_val_chek])) ? $learn_arr_from_post[$learn_social_val_chek] : '';
       
        //insert new data to array
        $learn_soc_array[$learn_soc_name]['the_social_val'] =  $learn_val_from_post;
        $learn_soc_array[$learn_soc_name]['learn_social_val_chek'] =  $learn_check_val_from_post;
    }
    update_option('learn_soc_name_array', $learn_soc_array);
}
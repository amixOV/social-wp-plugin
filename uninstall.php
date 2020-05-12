<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
$learn_option_name_arr = array('learn_is_social', 
                                'learn_soc_name_array',
                                'learn_what_page'
                        ) ;
 foreach($learn_option_name_arr as $option_name){
     delete_option($option_name);
 }
 
